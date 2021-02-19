<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class RunLogsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('run_logs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'users_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Dates', [
            'foreignKey' => 'dates_id',
            'joinType' => 'INNER',
        ]);
        
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->integer('distance')
            ->requirePresence('distance', 'create')
            ->notEmptyString('distance');

        $validator
            ->integer('minutes')
            ->requirePresence('minutes', 'create')
            ->notEmptyString('minutes');

        $validator
            ->date('dates')
            ->requirePresence('dates', 'create')
            ->notEmptyDate('dates');

        return $validator;
    }

    /**
     * Buildrules method
     *
     * @param object $rules is RulesChecker class object
     * @return \Cake\ORM\RulesChecker object
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['users_id'], 'Users'));
        $rules->add($rules->existsIn(['dates_id'], 'Dates'));

        return $rules;
    }

    /**
     * Query Building method for Statistics/Ranking 
     *
     * @param string|null $dateObject Date info, object $runLogs is the table object containing set of runLogs
     * @return Query Object $query
     */
    public function statsview($dateObject, $runLogs)
    {
        $date = array();
        $date = unserialize($dateObject);
        $query = $runLogs->find();
        $query->select(['username' =>'user.username', 'count' => $query->func()->count('*'), 'distanceSum' => $query->func()-> sum('distance'), 'minuteSum' => $query->func()-> sum('minutes')])
                ->join([
                    'user' => ['table' => 'users', 
                            'type' => 'INNER', 
                            'conditions' => 'user.id = RunLogs.users_id'
                    ],
                    'date' => ['table' => 'dates', 
                            'type' => 'INNER', 
                            'conditions' => 'date.id = RunLogs.dates_id']])
                ->where(['date.year' => $date['year']])
                ->group('user.id');
        if ($date['month'] != 0){
            $query->where(['date.month' => $date['month']]); 
        }
        if ($date['week'] != 0){
            $query->where(['date.week' => $date['week']]); 
        }
        
        return $query;
    }
}
