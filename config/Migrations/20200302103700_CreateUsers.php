<?php

use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('user');

        $table->addPrimaryKey('id');
        $table->addColumn('email', 'string', ['limit' => 255, 'default' => null, 'null' => false]);
        $table->addColumn('first_name', 'string', ['limit' => 255, 'default' => null, 'null' => false]);
        $table->addColumn('last_name', 'string', ['limit' => 255, 'default' => null, 'null' => false]);
        $table->addColumn('avatar', 'string', ['limit' => 255, 'default' => null, 'null' => false]);

        $table->create();
    }
}
