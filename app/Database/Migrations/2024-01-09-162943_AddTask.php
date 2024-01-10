<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTask extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'titulo' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'descripcion' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
                'unique' => false
            ],
            'estado' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
                'unique' => false
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('task');
    }

    public function down()
    {
        $this->forge->dropTable('task');
    }
}
