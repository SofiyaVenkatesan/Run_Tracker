<?php
namespace App\Controller;

use App\Controller\AppController;


class DatesController extends AppController
{
   public function index()
    {
        $dates = $this->paginate($this->Dates);

        $this->set(compact('dates'));
    }

    public function view($id = null)
    {
        $date = $this->Dates->get($id, [
            'contain' => [],
        ]);

        $this->set('date', $date);
    }

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

    
    public function edit($id = null)
    {
        $date = $this->Dates->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $date = $this->Dates->patchEntity($date, $this->request->getData());
            if ($this->Dates->save($date)) {
                $this->Flash->success(__('The date has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The date could not be saved. Please, try again.'));
        }
        $this->set(compact('date'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $date = $this->Dates->get($id);
        if ($this->Dates->delete($date)) {
            $this->Flash->success(__('The date has been deleted.'));
        } else {
            $this->Flash->error(__('The date could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
