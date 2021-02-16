<?php
use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('name', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('username', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('password', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('mobile', 'biginteger', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addIndex([
            'username',
        ], [
            'name' => 'username_index',
            'unique' => true,
        ]);
        $table->addIndex([
            'mobile',
        ], [
            'name' => 'mobile_index',
            'unique' => true,
        ]);
        $table->create();
    }
}
