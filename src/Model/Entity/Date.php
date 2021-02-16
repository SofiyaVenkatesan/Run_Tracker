<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Date Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate $date
 * @property int $week
 * @property string $month
 * @property int $year
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Date extends Entity
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
        'date' => true,
        'week' => true,
        'month' => true,
        'year' => true,
        'created' => true,
        'modified' => true,
    ];
}
