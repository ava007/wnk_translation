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
        $z=0;
        $wnk_translation = Configure::read('WnkTranslation');

        if (empty($wnk_translation['default_lang'])) {
           return 'Default Language not defined';
        }   
        
        $table = $wnk_translation['tablePrefix'] . 'wnk_translation';
        
        // Iterate through all languages defined in config
        foreach ($wnk_translation['trans_lang'] as $k):
            if ($k == $wnk_translation['default_lang']) continue;
                  
            $q = "delete from " . $table . " where locale = '" . $k . "' and msgid not in (";
            $q .= " select msgid from " . $table . " where locale='". $wnk_translation['default_lang'] . "') ";
            //$this->query($q);
            error_log("TranslationsTable::deleteunused: " . $q);
        
            $q = "delete from " . $table . " where locale = '" . $k . "'";
            $q .= " and last_used < current_timestamp - interval '365 days'";
            //$this->query($q);
            error_log("TranslationsTable::deleteunused: " . $q);
        endforeach;
        
        return 'Delete ended successfully.' . $z;
    }
}
