<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAlunosTable extends Migration
{
    public function up()
    {
        $this->forge->addField('id');
        $this->forge->addField([
            'nome'     => ['type' => 'varchar', 'constraint' => 150],
            'endereco' => ['type' => 'varchar', 'constraint' => 250],
            'foto'     => ['type' => 'varchar', 'constraint' => 250],
        ]);
        //$this->forge->addKey('id', true);
        $this->forge->createTable('alunos');
    }

    public function down()
    {
        $this->forge->dropTable('alunos');
    }
}
