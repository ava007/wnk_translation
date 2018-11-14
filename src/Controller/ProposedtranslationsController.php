<?php
namespace WnkProposedtranslation\Controller;

use WnkTranslation\Controller\AppController;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Utility\Text;

/**
 * Proposedtranslations Controller
 *
 * @property \WnkTranslation\Model\Table\TranslationsTable $Translations
 */
class ProposedtranslationsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('WnkTranslation.Utltrans');
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        $this->loadModel('Translations');
        $translation = $this->Translations->get($id, [
            'contain' => []
        ]);
        $this->set('translation', $translation);
        $this->set('_serialize', ['translation']);
     
        if ($this->request->is('post')) {
            $translation = $this->Proposedtranslations->newEntity();
            $translation = $this->Proposedtranslations->patchEntity($translation, $this->request->data);
            if ($this->Proposedtranslations->save($translation)) {
                $this->Flash->success(__('The translation has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The translation could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('translation'));
        $this->set('_serialize', ['translation']);
    }
}
