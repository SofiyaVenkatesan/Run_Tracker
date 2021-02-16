<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;


class RunLog extends Entity
{
    
    protected $_accessible = [
        'users_id' => true,
        'distance' => true,
        'minutes' => true,
        'dates_id' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'date' => true,
    ];
}
