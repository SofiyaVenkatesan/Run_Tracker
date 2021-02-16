<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;


 
class User extends Entity
{
    
    protected $_accessible = [
        'name' => true,
        'username' => true,
        'password' => true,
        'mobile' => true,
        'created' => true,
        'modified' => true,
    ];

    
    protected $_hidden = [
        'password',
    ];

    
}
