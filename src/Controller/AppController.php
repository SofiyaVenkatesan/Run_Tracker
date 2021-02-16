<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

class AppController extends Controller
{

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'loginRedirect' => [
                'controller' => 'Users',
                'action' => 'view'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login'
            ]
        ]);
        
        //$this->loadComponent('Security');
    }
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['add', 'view', 'display', 'edit', 'index', 'stats', 'statsview', 'rank', 'rankview']);
    }
}
