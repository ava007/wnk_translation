<?php
namespace WnkTranslation\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use WnkTranslation\Model\Entity\Translation;
use Cake\Core\Configure;

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
            
        $this->table($table);
        $this->displayField('msgid');
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
}
