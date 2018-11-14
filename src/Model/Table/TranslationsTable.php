<?php
namespace WnkTranslation\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use WnkTranslation\Model\Entity\Translation;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;

/**
 * Translations Model
 *
 */
class TranslationsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        
        $wnkConf = Configure::read('WnkTranslation');
        if (isset($wnkConf['tablePrefix']))
            $table = $wnkConf['tablePrefix'] . 'wnk_translation';
        else
            $table = 'wnk_translation';
            
        $this->setTable($table);
        $this->setDisplayField('msgid');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('msgid', 'create')
            ->notEmpty('msgid');

        $validator
            ->allowEmpty('locale');

        $validator
            ->allowEmpty('last_used');

        $validator
            ->allowEmpty('status');

        $validator
            ->allowEmpty('msgstr');

        return $validator;
    }
    
    public function deleteunused() {
        
        $conn = ConnectionManager::get('default');
        
        $z=0;
        $wnk_translation = Configure::read('WnkTranslation');

        if (empty($wnk_translation['default_lang'])) {
           return 'Default Language not defined';
        }   
        
        $table = $wnk_translation['tablePrefix'] . 'wnk_translation';
        
        $r = $conn->execute("select count(*) as ca from " . $table)->fetchAll('assoc');;
        
        // update last used based on default language
        $q  = " update " . $table . " as t1 set last_used = t2.last_used from lr_wnk_translation t2 ";
        $q .= " where t2.locale = '" . $wnk_translation['default_lang'] . "' and t1.msgid = t2.msgid";
        error_log("TranslationsTable::deleteunused: " . $q);
        $this->query($q);
                
        // Iterate through all languages defined in config
        foreach ($wnk_translation['trans_lang'] as $k):
            if ($k == $wnk_translation['default_lang']) continue;
                  
            $q = "delete from " . $table . " where locale = '" . $k . "' and msgid not in (";
            $q .= " select msgid from " . $table . " where locale='". $wnk_translation['default_lang'] . "') ";
            error_log("TranslationsTable::deleteunused: " . $q);
            $this->query($q);
        
            $q = "delete from " . $table . " where locale = '" . $k . "'";
            $q .= " and last_used < current_timestamp - interval '365 days'";
            error_log("TranslationsTable::deleteunused: " . $q);
            $this->query($q);
        endforeach;
        
        $z = $conn->execute("select count(*) as ca from " . $table)->fetchAll('assoc');;
        error_log(print_r($z,true));
        
        return 'Delete ended successfully.' . $z;
    }
}
