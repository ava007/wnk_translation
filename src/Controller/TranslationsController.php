<?php
namespace WnkTranslation\Controller;

use WnkTranslation\Controller\AppController;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Utility\Text;

/**
 * Translations Controller
 *
 * @property \WnkTranslation\Model\Table\TranslationsTable $Translations
 */
class TranslationsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('WnkTranslation.Utltrans');
    }


    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {

        $where = array();
        if (!empty($this->request->query['locale']))
            $where['locale'] = $this->request->query['locale'];
        if (!empty($this->request->data['locale']))
            $where['locale'] = $this->request->data['locale'];
    
        if (!empty($this->request->query['msgstr']))
            $where['msgstr like'] = '%' . $this->request->query['msgstr'] . '%';
        if (!empty($this->request->data['msgstr']))
            $where['msgstr like'] = '%' . $this->request->data['msgstr'] . '%';

        if (!empty($this->request->query['status']))
            $where['status'] = $this->request->query['status'];
        if (!empty($this->request->data['status']))
            $where['status'] = $this->request->data['status'];
        
        $query = $this->Translations->find()->where($where);

        $this->set('translations', $this->paginate($query));
        $this->set('_serialize', ['translations']);
        $this->set('WnkTranslation', Configure::read('WnkTranslation'));
    }

    /**
     * Cockpit method
     *
     * @param 
     * @return void
     * @throws 
     */
    public function cockpit() 
    {
        $this->set('WnkTranslation', Configure::read('WnkTranslation'));

        $conn = ConnectionManager::get('default');
        
        $q = "select locale,status,count(*) as cnt from wnk_translation ";
        $q.= "where locale in (select distinct locale where status ='Original') ";
        $q.= "group by locale,status order by 1,2 ";
        $tset = $conn->execute($q)->fetchAll('assoc');
        $this->set('original', $tset);   
        
        $q = "select locale,status,count(*) as cnt from wnk_translation ";
        $q.= "where locale NOT in (select distinct locale where status ='Original') ";
        $q.= "group by locale,status order by 1,2 ";
        $tset = $conn->execute($q)->fetchAll('assoc');
        $this->set('tsets', $tset);   
    }


    /**
     * View method
     *
     * @param string|null $id Translation id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $translation = $this->Translations->get($id, [
            'contain' => []
        ]);
        $this->set('translation', $translation);
        $this->set('_serialize', ['translation']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $translation = $this->Translations->newEntity();
        if ($this->request->is('post')) {
            $translation = $this->Translations->patchEntity($translation, $this->request->data);
            if ($this->Translations->save($translation)) {
                $this->Flash->success(__('The translation has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The translation could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('translation'));
        $this->set('_serialize', ['translation']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Translation id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $translation = $this->Translations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $translation = $this->Translations->patchEntity($translation, $this->request->data);
            $translation->status = 'TranslatedByUser';
            if ($this->Translations->save($translation)) {
                $this->Flash->success(__('The translation has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The translation could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('translation'));
        $this->set('_serialize', ['translation']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Translation id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $translation = $this->Translations->get($id);
        if ($this->Translations->delete($translation)) {
            $this->Flash->success(__('The translation has been deleted.'));
        } else {
            $this->Flash->error(__('The translation could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }


    public function import() 
    {
        $this->autoRender = false;
        $rc = $this->Utltrans->import();
        $this->Flash->success(__('Import ended.') . ' ' . $rc);
        return $this->redirect(['action' => 'index']);
    }

    public function prepare() 
    {
        $this->autoRender = false;
        $rc = $this->Utltrans->prepare();
        $this->Flash->success(__('Translate ended.'));
        return $this->redirect(['action' => 'index']);
    }

    public function export() 
    {
        $this->autoRender = false;
        $rc = $this->Utltrans->export();
        $this->Flash->success($rc);
        return $this->redirect(['action' => 'index']);
    }

    public function about() 
    {
    }
    
    public function googletranslate() {
        $this->set('WnkTranslation', Configure::read('WnkTranslation'));

        $conn = ConnectionManager::get('default');
        $q = "select locale, count(*) from wnk_translation where status = 'NotTranslated' group by locale having count(*) > 0";
        $tset = $conn->execute($q)->fetchAll('assoc');
        $this->set('lang', $tset);   
        
        if ($this->request->is('post')) {
            $this->log('Ctranslations:googletranslate: ' . print_r($this->request['data'],true));
            $this->Flash->success(__('The translation has been saved.'));
            return $this->redirect(['action' => 'index']);
        }
    }


}
