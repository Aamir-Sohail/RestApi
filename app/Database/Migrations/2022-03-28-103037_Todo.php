<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Todo extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 31, 'auto_increment'=> true, 'unsinged'=>true,],
            'title'      => ['type' => 'varchar', 'constraint' => 31],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],

         
        ]);
        $this->forge->addKey('id',true);
        $this->forge->createTable('to-do-list');
    }

    public function down()
    {
        $this->forge->dropTable('to-do-list');
    }
}
