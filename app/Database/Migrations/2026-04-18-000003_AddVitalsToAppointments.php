<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddVitalsToAppointments extends Migration
{
    public function up()
    {
        $this->forge->addColumn('appointments', [
            'bp' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
                'after'      => 'reason',
            ],
            'pulse' => [
                'type'       => 'TINYINT',
                'constraint' => 3,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'bp',
            ],
            'spo2' => [
                'type'       => 'TINYINT',
                'constraint' => 3,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'pulse',
            ],
            'rr' => [
                'type'       => 'TINYINT',
                'constraint' => 3,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'spo2',
            ],
            'temperature' => [
                'type'       => 'DECIMAL',
                'constraint' => '4,1',
                'null'       => true,
                'after'      => 'rr',
            ],
            'weight' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,1',
                'null'       => true,
                'after'      => 'temperature',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('appointments', ['bp', 'pulse', 'spo2', 'rr', 'temperature', 'weight']);
    }
}
