<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\ORM\Query;
use Cake\ORM\ResultSet;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\I18n\Time;

/**
 * RunLogs Controller
 *
 * @property \App\Model\Table\RunLogsTable $RunLogs
 *
 * @method \App\Model\Entity\RunLog[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */

class RunLogsController extends AppController
{
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Dates'],
        ];
        $runLogs = $this->paginate($this->RunLogs);
        $this->set(compact('runLogs'));
    }

    /**
     * View method
     *
     * @param string|null $id RunLog id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $runLog = $this->RunLogs->get($id, [
            'contain' => ['Users', 'Dates'],
        ]);
        $this->set('runLog', $runLog);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
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
                
            $datelist = $datetable->save($date);

            $runtable = TableRegistry::getTableLocator()->get('RunLogs');
            $usertable = TableRegistry::getTableLocator()->get('Users');
            $run = $runtable->newEntity();

            $run->users_id = $this->Auth->user('id');

            $run->distance = $this->request->getData('distance');
            $run->minutes = $this->request->getData('minutes');
            $run->dates_id = $datelist['id'];
            
            $run->created = date("Y-m-d H:i:s");
            $run->modified = date("Y-m-d H:i:s");
            
            if ($runtable->save($run)) {
                $this->Flash->success(__('The run log has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The run log could not be saved. Please, try again.'));
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id RunLog id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $runLog = $this->RunLogs->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $runLog = $this->RunLogs->patchEntity($runLog, $this->request->getData());
            $runLog->modified = date("Y-m-d H:i:s");
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

    /**
     * Delete method
     *
     * @param string|null $id RunLog id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
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

    /**
     * Method for validating info for stats
     *
     * @return Redirect URL to statistics/ranking view page 
     * @throws Error on invalid info for getting stats
     */
    public function stats()
    {
        if ($this->request->is(['post'])) {
            $action = 'statsview';
            $dateValidations = ['week', 'month'];
            $isValid = false;
            $date = ['month' => 0, 'week' => 0, 'userId' => $this->Auth->user('id')];
            $date['year'] = $this->request->getData('year');
            
            foreach ($dateValidations as $dateValidation) {
                if (!empty($this->request->getData($dateValidation))) {
                    $date[$dateValidation] = $this->request->getData($dateValidation);
                    $isValid = true;
                    continue;
                }
                if ($isValid) {
                    $this->Flash->error(__('Month is mandatory for week statistics'));
                    return $this->redirect($this->referer());
                }
            }
            if ($this->request->getData('rankOrder') != null) {
                $date['rankOrder'] = $this->request->getData('rankOrder');
                $action = 'rankview';
            }
            $dateObject = serialize($date);
            return $this->redirect(['controller' => 'RunLogs', 'action' => $action, $dateObject]); 
        }
    }
    
    /**
     * Statistics view method
     *
     * @param string|null $dateObject Date info.
     * @return \Cake\Http\Response|null
     */
    public function statsview($dateObject = null)
    {
        $date = array();
        $date = unserialize($dateObject);
        $runLogs = TableRegistry::getTableLocator()->get('RunLogs');
        $users = TableRegistry::getTableLocator()->get('Users');

        $query = $this->RunLogs->statsview($dateObject, $runLogs);

        $query->having(['user.id' => $date['userId']]);
        $this->set(compact('query'));
    }

    /**
     * Rank method 
     *
     * @return Renders view.
     */
    public function rank()
    {

    }

    /**
     * Ranking view method
     *
     * @param string|null $dateObject Date info.
     * @return \Cake\Http\Response|null
     */
    public function rankview($dateObject = null)
    {
        $date = array();
        $date = unserialize($dateObject);
        if ($date['rankOrder'] == 0) {
            $date['rankOrder'] = "count";
        } else if ($date['rankOrder'] == 1) {
            $date['rankOrder'] = "distanceSum";
        } else {
            $date['rankOrder'] = "minuteSum";
        }
        $runLogs = TableRegistry::getTableLocator()->get('RunLogs');

        $query = $this->RunLogs->statsview($dateObject, $runLogs);
        $query->order([$date['rankOrder'] => 'DESC']);
        $this->set(compact('query'));  
    }

    /**
     * Method for Authorizing
     *
     * @param $user Active user instance
     *
     * @return boolean indicating whether or not the user is authorized.
     */
    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        if (in_array($action, ['add', 'view', 'index', 'rank', 'rankview'])) {
            return true;
        }
        $id = $this->request->getParam('pass.0');
        if (!$id) {
            return false;
        }
        $RunLogs = TableRegistry::getTableLocator()->get('RunLogs');
        $runLog = $RunLogs->findById($id)->first();

        return $runLog->users_id === $user['id'];
    }
}
