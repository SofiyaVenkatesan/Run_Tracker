<?php
namespace App\Controller;

use App\Controller\AppController;

class DatesController extends AppController
{

    /**
     * Index method 
     *
     * @return void.
     */
    public function index()
    {
    }

    /**
     * View method 
     *
     * @return void.
     */
    public function view()
    {
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $date = $this->Dates->newEntity();
        if ($this->request->is('post')) {
            $date = $this->Dates->patchEntity($date, $this->request->getData());
            if ($this->Dates->save($date)) {
                $this->Flash->success(__('The date has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The date could not be saved. Please, try again.'));
        }
        $this->set(compact('date'));
    }

    /**
     * Edit method 
     *
     * @return void.
     */
    public function edit()
    {
    }

    /**
     * Delete method 
     *
     * @return void.
     */
    public function delete()
    {
    }
}
