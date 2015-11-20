<?php
namespace WnkTranslation\Controller\Component;

use Cake\Controller\Component;
use Cake\Network\Email\Email;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Utility\Text;
use Cake\I18n\Time;
use Cake\Core\Configure;

use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

class UtltransComponent extends Component
{

   function import($filename = '') {

      $wnk_translation = Configure::read('WnkTranslation');

      // set the filename to read from
      $z_new = 0;
      $z_exist = 0;
      if (empty($filename)) $filename='default.pot';
      $filename = ROOT . DS . 'src' . DS. 'Locale' . DS . $filename;

      $filehandle = fopen($filename, "r");

      while (($row = fgets($filehandle)) !== FALSE) {
         if (substr($row,0,7) == 'msgid "') {
            // parse string in hochkomma:
            $msgid = substr($row, 7 ,(strpos($row,'"',6)-8));
            if (!empty($msgid)) {
               $row = fgets($filehandle);
               if (substr($row,0,8) == 'msgstr "') {
                  $msgstr = substr($row, 8 ,(strpos($row,'"',7)-9));
               }
               // check if exists
               $msgid = trim(substr($msgid,0,255));

               $translationsTable = TableRegistry::get('WnkTranslation.Translations');
               $translentry = $translationsTable->find('all')->
                   where(['msgid' => $msgid,"locale" => $wnk_translation['default_lang']])->first();

               if (empty($translentry)) {
                   $tl = $translationsTable->newEntity();

                   // prepare data for saving
                   $tl->id = Text::uuid();
                   $tl->msgid = $msgid;
                   $tl->msgstr = $msgid;
                   $tl->locale = $wnk_translation['default_lang'];
                   $tl->status = 'Original';
                   $translationsTable->save($tl);
                   $z_new++;
               } else {
                   $this->setLastUsed($translentry->id);
                   $z_exist++;
               }
            }
         }
      }
      fclose($filehandle);
      return 'New Records: ' . $z_new . ' Existing Records: ' . $z_exist;
   }

   function setLastUsed($id) {
        $connection = ConnectionManager::get('default');
 //     $connection->update('WnkTranslation.Translations', ['last_used' => Time::now()], ['id' => $id]);
   }


    function prepare() {
        $z=0;

        $wnk_translation = Configure::read('WnkTranslation');

        $this->log(print_r($wnk_translation,true));

        if (empty($wnk_translation['default_lang'])) {
           return 'Default Language not defined';
        }   

        $connection = ConnectionManager::get('default');
        $translationsTable = TableRegistry::get('WnkTranslation.Translations');

        // Step 2: translate to all languages defined in config

        foreach ($wnk_translation['trans_lang'] as $k):
            if ($k == $wnk_translation['default_lang']) continue;

            $q = "select * from wnk_translation where locale = '" . $wnk_translation['default_lang'] . "' and msgid not in (";
            $q .= " select msgid from wnk_translation where locale='". $k . "') limit 25";

            $results = $connection->execute($q)->fetchAll('assoc');

            foreach ($results as $trec):
                 $this->log('CTranslation::translate: ' . print_r($trec,true));
                 if (stripos($trec['msgid'],'php') == false) {   // don't translate cakephp internals
                     $z++;
                     $tl = $translationsTable->newEntity();
                     $tl->id = Text::uuid();
                     $tl->msgstr = $trec['msgid'];
                     $tl->msgid = $trec['msgid'];
                     $tl->locale = $k;
                     $tl->status = 'NotTranslated';
                     $this->log('CTranslation::translate done: '. print_r($trec,true). "\n". print_r($tl,true));
                     $translationsTable->save($tl);
                 }
             endforeach;
        endforeach;

        return 'Translation preparation successfully ended. Records generated: ' . $z;
    }

    function export() {

        // Step 3: export default.pot file to the relevant directory

        $wnk_translation = Configure::read('WnkTranslation');

        $filename= 'f' . gmdate('YmdHis');
        foreach ($wnk_translation['trans_lang'] as $k):
            if ($k == $wnk_translation['default_lang']) continue;

            $path = ROOT.DS.'src'.DS.'Locale'.DS.$k;
            $folder = new Folder();
            if (!file_exists($path)) {
                $folder->create($path);
            }

            $file = $path.DS.$filename;
            $file = new File($file, true, 0644);

            $data = TableRegistry::get('WnkTranslation.Translations')->find('all')->where(["locale" => $k])->all();

            foreach ($data as $rec):
                   $file->write('msgid "' .$rec->msgid .'"'."\n");
                   $file->write('msgstr "'.$rec->msgstr.'"'."\n");
            endforeach;
            $file->close();

            if (file_exists($path.DS.'default.po')) 
               unlink ($path.DS.'default.po');
            rename ($path.DS.$filename,$path.DS.'default.po');
        endforeach;
        return 'Export successful';
   }
   
  

   function google_translate($text, $from = '', $to = 'en') {

      // Google requires attribution for their Language API, please see: http://code.google.com/apis/ajaxlanguage/documentation/#Branding
      $wnk_translation = Configure::read('WnkTranslation');
      
      if (empty($wnk_translation['google_key'])) return 'google_key is not defined in bootstrap.php';

      $url = 'https://www.googleapis.com/language/translate/v2?key=' . $wnk_translation['google_key'];
      $url .= '&q=' . rawurlencode($text).'&source='. $from.'&target='.$to;

      $response = file_get_contents(
               $url,
               null,
               stream_context_create(
                  array('http'=>array('method'=>"GET",'header'=>"Referer: http://".$_SERVER['HTTP_HOST']."/\r\n"))
               )
            );

       $ra = json_decode($response, true);
       $this->log('Component google_translate: response from google:' . $ra['data']['translations'][0]['translatedText']);
               
       return $ra['data']['translations'][0]['translatedText'];
   } 

}
