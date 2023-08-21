<?php

namespace App\Database\Migrations\Absen;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class AbsenPanitia extends Migration
{
    private $table = 'absen_panitia';

    public function up()
    {
        $fields = [
            'id' => [
                'type' => 'int',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_kegiatan' => [
                'type' => 'int',
                'unsigned' => true,
            ],
            'id_panitia' => [
                'type' => 'int',
                'unsigned' => true,
            ],
            'jam_regis_in' => [
                'type' => 'time',
                'null' => true,
            ],
            'jam_regis_out' => [
                'type' => 'time',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'deleted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'last_updated_by' => [
                'type' => 'int',
                'unsigned' => true,
            ]
        ];
        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_kegiatan', 'absen_kegiatan_panitia', 'id');
        $this->forge->addForeignKey('id_panitia', 'panitia', 'id');
        $this->forge->addForeignKey('last_updated_by', 'panitia', 'id');
        $this->forge->createTable($this->table);
    }

    public function down()
    {
        $this->forge->dropTable($this->table);
    }
}
