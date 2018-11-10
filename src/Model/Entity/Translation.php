<?php
namespace WnkTranslation\Model\Entity;

use Cake\ORM\Entity;

/**
 * Translation Entity.
 *
 * @property string $id
 * @property string $msgid
 * @property string $locale
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $last_used
 * @property string $status
 * @property string $msgstr
 */
class Translation extends Entity
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
        'created' => true,
        'last_used' => true,
        'status' => true,
        'msgstr' => true
    ];
}
