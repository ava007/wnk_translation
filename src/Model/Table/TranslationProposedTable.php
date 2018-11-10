<?php
namespace WnkTranslation\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * WnkTranslationProposed Model
 *
 * @method \WnkTranslation\Model\Entity\WnkTranslationProposed get($primaryKey, $options = [])
 * @method \WnkTranslation\Model\Entity\WnkTranslationProposed newEntity($data = null, array $options = [])
 * @method \WnkTranslation\Model\Entity\WnkTranslationProposed[] newEntities(array $data, array $options = [])
 * @method \WnkTranslation\Model\Entity\WnkTranslationProposed|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \WnkTranslation\Model\Entity\WnkTranslationProposed|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \WnkTranslation\Model\Entity\WnkTranslationProposed patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \WnkTranslation\Model\Entity\WnkTranslationProposed[] patchEntities($entities, array $data, array $options = [])
 * @method \WnkTranslation\Model\Entity\WnkTranslationProposed findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TranslationProposedTable extends Table
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

        $this->setTable('wnk_translation_proposed');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

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
            ->scalar('id')
            ->maxLength('id', 36)
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('msgid')
            ->maxLength('msgid', 255)
            ->requirePresence('msgid', 'create')
            ->notEmpty('msgid');

        $validator
            ->scalar('locale')
            ->maxLength('locale', 2)
            ->allowEmpty('locale');

        $validator
            ->scalar('status')
            ->maxLength('status', 24)
            ->allowEmpty('status');

        $validator
            ->scalar('createdbyip')
            ->maxLength('createdbyip', 41)
            ->allowEmpty('createdbyip');

        $validator
            ->scalar('msgstr')
            ->allowEmpty('msgstr');

        return $validator;
    }
}
