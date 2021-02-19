<?php
use Migrations\AbstractMigration;

class ForeignkeyToRunlogs extends AbstractMigration
{ 
    public function change()
    {
        $table = $this->table('run_logs');
        $table->addForeignKey('users_id', 'users', 'id')
            ->update();
        $table->addForeignKey('dates_id', 'dates', 'id')
            ->update();       
    }
    
}

