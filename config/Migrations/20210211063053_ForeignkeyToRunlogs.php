<?php
use Migrations\AbstractMigration;

class ForeignkeyToRunlogs extends AbstractMigration
{ 
    public function change()
    {
        $table = $this->table('run_logs');
       // $table->changeColumn('users_id', 'integer')
        $table->addForeignKey('users_id', 'users', 'id')
            ->update();
        //$table->changeColumn('dates_id', 'integer')
        $table->addForeignKey('dates_id', 'dates', 'id')
            ->update();       
    }
    
}

