<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\ORM\Query;
use Cake\ORM\ResultSet;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\I18n\Time;
class RunLogsController extends AppController
{
    
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Dates'],
        ];
        $runLogs = $this->paginate($this->RunLogs);

        $this->set(compact('runLogs'));
    }

    public function view($id = null)
    {
        $runLog = $this->RunLogs->get($id, [
            'contain' => ['Users', 'Dates'],
        ]);

        $this->set('runLog', $runLog);
    }

    public function add()
    {
        if ($this->request->is('post')) {
            $datetable = TableRegistry::getTableLocator()->get('Dates');
            $date = $datetable->newEntity();
            $dateValue = $this->request->getData('date');
          
            $dateObject = \Cake\Database\Type::build('date')->marshal($this->request->getData('date'));

            $date->date = $dateObject;
            

            $date->week = ceil(($dateValue['day'] - $dateObject->format("N") - 1) / 7) + 1;
         
            $date->month = $dateValue['month'];
            $date->year = $dateValue['year'];
            $date->created = date("Y-m-d H:i:s");
            $date->modified = date("Y-m-d H:i:s");
                
            $datelist=$datetable->save($date);

            $runtable = TableRegistry::getTableLocator()->get('RunLogs');
            $usertable = TableRegistry::getTableLocator()->get('Users');


            $run = $runtable->newEntity();

            $userId = $usertable
                ->find()
                ->select(['id'])
                ->where(['username =' => $this->request->getData('username')]);
          
            $run->users_id = $userId;
            $run->distance = $this->request->getData('distance');
            $run->minutes = $this->request->getData('minutes');
            $run->dates_id = $datelist['id'];
            //echo $datelist['id'];
            $run->created = date("Y-m-d H:i:s");
            $run->modified = date("Y-m-d H:i:s");
            //print_r($runlog);
            
            if ($runtable->save($run)) {
                $this->Flash->success(__('The run log has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The run log could not be saved. Please, try again.'));

        }
    }

    public function edit($id = null)
    {
        $runLog = $this->RunLogs->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $runLog = $this->RunLogs->patchEntity($runLog, $this->request->getData());
            if ($this->RunLogs->save($runLog)) {
                $this->Flash->success(__('The run log has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The run log could not be saved. Please, try again.'));
        }
        $users = $this->RunLogs->Users->find('list', ['limit' => 200]);
        $dates = $this->RunLogs->Dates->find('list', ['limit' => 200]);
        $this->set(compact('runLog', 'users', 'dates'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $runLog = $this->RunLogs->get($id);
        if ($this->RunLogs->delete($runLog)) {
            $this->Flash->success(__('The run log has been deleted.'));
        } else {
            $this->Flash->error(__('The run log could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function stats(){
        if ($this->request->is('post')) {
            if (empty($this->request->getData('year'))){
                $this->Flash->error(__('Year is mandatory'));
            }
            else{
                $year = $this->request->getData('year');
                if (empty($this->request->getData('month'))){
                    if (!empty($this->request->getData('week'))){
                        $this->Flash->error(__('Month is mandatory for week statistics'));
                    }
                    else{
                        $week = 0;
                        $month = 0;
                    }
                }
                else{
                    $month = $this->request->getData('month');
                    if (empty($this->request->getData('week'))){
                        $week = 0;
                    }
                    else{
                        $week = $this->request->getData('week');
                    }   
                }
                $this->set(compact($year, $month, $week));
                return $this->redirect(['controller' => 'RunLogs', 'action' => 'statsview', $year, $month, $week]);
                    
            }
        }
    }

    public function statsview($year, $month, $week){
        $run_logs = TableRegistry::getTableLocator()->get('RunLogs');
        //debug($this->request->param('year'));
        if ($month == 0)
        {
            $query = $run_logs->find();
            $query->select(['username' =>'u.username', 'count' => $query->func()->count('*'), 'distanceSum' => $query->func()-> sum('distance'), 'minuteSum' => $query->func()-> sum('minutes')])
            ->join([
                'u' => ['table' => 'users', 
                        'type' => 'INNER', 
                        'conditions' => 'u.id = RunLogs.users_id',
                ],
                'd' => ['table' => 'dates', 
                        'type' => 'INNER', 
                        'conditions' => ['d.id = RunLogs.dates_id', 'd.year =' => $year]]], ['d.year' => 'integer'])
            ->group('u.id');
            $this->set(compact('query', 'year'));  
        }
        else if ($week == 0)
        {
            $query = $run_logs->find();
            $query->select(['username' =>'u.username', 'count' => $query->func()->count('*'), 'distanceSum' => $query->func()-> sum('distance'), 'minuteSum' => $query->func()-> sum('minutes')])
                ->join([
                    'u' => ['table' => 'users', 
                            'type' => 'INNER', 
                            'conditions' => 'u.id = RunLogs.users_id',
                    ],
                    'd' => ['table' => 'dates', 
                            'type' => 'INNER', 
                            'conditions' => ['d.id = RunLogs.dates_id', 'd.year =' => $year, 'd.month IS' => $month]]], ['d.year' => 'integer', 'd.month' => 'integer'])
                ->group('u.id');
            $this->set(compact('query', 'year', 'month'));
            
        }
        else{
            $query = $run_logs->find();
            $query->select(['username' =>'u.username', 'count' => $query->func()->count('*'), 'distanceSum' => $query->func()-> sum('distance'), 'minuteSum' => $query->func()-> sum('minutes')])
                ->join([
                    'u' => ['table' => 'users', 
                            'type' => 'INNER', 
                            'conditions' => 'u.id = RunLogs.users_id',
                    ],
                    'd' => ['table' => 'dates', 
                            'type' => 'INNER', 
                            'conditions' => ['d.id = RunLogs.dates_id', 'd.year =' => $year, 'd.month IS' => $month, 'd.week IS' => $week]]], ['d.year' => 'integer', 'd.month' => 'integer', 'd.week' => 'integer'])
                ->group('u.id');
                $this->set(compact('query', 'year', 'month', 'week'));
        } 
    }

    public function rank(){
        if ($this->request->is('post')) {
            $rankorder = $this->request->getData('rankorder');
            
            if (empty($this->request->getData('year'))){
                $this->Flash->error(__('Year is mandatory'));
            }
            else{
                $year = $this->request->getData('year');
                if (empty($this->request->getData('month'))){
                    if (!empty($this->request->getData('week'))){
                        $this->Flash->error(__('Month is mandatory for week statistics'));
                    }
                    else{
                        $week = 0;
                        $month = 0;
                    }
                }
                else{
                    $month = $this->request->getData('month');
                    if (empty($this->request->getData('week'))){
                        $week = 0;
                    }
                    else{
                        $week = $this->request->getData('week');
                    }   
                }
                $this->set(compact($year, $month, $week, $rankorder));
                return $this->redirect(['controller' => 'RunLogs', 'action' => 'rankview',$year, $month, $week, $rankorder]);
                    
            }
        }
    }
    public function rankview($year, $month, $week, $rankorder){
        //return $this -> render('/RunLogs/rankview');
        //debug($rankorder);
        if ($rankorder == 0){
            $rankorder = "count";
        }
        else if($rankorder == 1){
            $rankorder = "distanceSum";
        }
        else{
            $rankorder = "minuteSum";
        }
        $run_logs = TableRegistry::getTableLocator()->get('RunLogs');
        
        if ($month == 0){
            $query = $run_logs->find();
            $query->select(['username' =>'u.username', 'count' => $query->func()->count('*'), 'distanceSum' => $query->func()-> sum('distance'), 'minuteSum' => $query->func()-> sum('minutes')])
            ->join([
                'u' => ['table' => 'users', 
                        'type' => 'INNER', 
                        'conditions' => 'u.id = RunLogs.users_id',
                ],
                'd' => ['table' => 'dates', 
                        'type' => 'INNER', 
                        'conditions' => ['d.id = RunLogs.dates_id', 'd.year =' => $year]]], ['d.year' => 'integer'])
            ->group('u.id')
            ->order([$rankorder => 'DESC']);
            //debug($rankorder);
            $this->set(compact('query', 'year'));  
        }
        else if ($week == 0){
            $query = $run_logs->find();
            $query->select(['username' =>'u.username', 'count' => $query->func()->count('*'), 'distanceSum' => $query->func()-> sum('distance'), 'minuteSum' => $query->func()-> sum('minutes')])
                ->join([
                    'u' => ['table' => 'users', 
                            'type' => 'INNER', 
                            'conditions' => 'u.id = RunLogs.users_id',
                    ],
                    'd' => ['table' => 'dates', 
                            'type' => 'INNER', 
                            'conditions' => ['d.id = RunLogs.dates_id', 'd.year =' => $year, 'd.month IS' => $month]]], ['d.year' => 'integer', 'd.month' => 'integer'])
                ->group('u.id')
                ->order([$rankorder => 'DESC']);
                //debug($rankorder);
            $this->set(compact('query', 'year', 'month'));
            
        }
        else{
            $query = $run_logs->find();
            $query->select(['username' =>'u.username', 'count' => $query->func()->count('*'), 'distanceSum' => $query->func()-> sum('distance'), 'minuteSum' => $query->func()-> sum('minutes')])
                ->join([
                    'u' => ['table' => 'users', 
                            'type' => 'INNER', 
                            'conditions' => 'u.id = RunLogs.users_id',
                    ],
                    'd' => ['table' => 'dates', 
                            'type' => 'INNER', 
                            'conditions' => ['d.id = RunLogs.dates_id', 'd.year =' => $year, 'd.month IS' => $month, 'd.week IS' => $week]]], ['d.year' => 'integer', 'd.month' => 'integer', 'd.week' => 'integer'])
                ->group('u.id')
                ->order([$rankorder => 'DESC']);
                //debug($rankorder);
                $this->set(compact('query', 'year', 'month', 'week'));
        } 
    }
}
