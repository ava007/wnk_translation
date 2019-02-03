<?php
namespace WnkTranslation\Model\Entity;

use Cake\ORM\Entity;

/**
 * WnkTranslationProposed Entity
 *
 * @property string $id
 * @property string $msgid
 * @property string $locale
 * @property string $status
 * @property \Cake\I18n\Time $created
 * @property string $createdbyip
 * @property string $msgstr
 */
class TranslationProposed extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'msgid' => true,
        'locale' => true,
        'status' => true,
        'created' => true,
        'createdbyip' => true,
        'msgstr' => true
    ];
}
