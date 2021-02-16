<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class RunLogsTable extends Table
{
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

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['users_id'], 'Users'));
        $rules->add($rules->existsIn(['dates_id'], 'Dates'));

        return $rules;
    }
}
