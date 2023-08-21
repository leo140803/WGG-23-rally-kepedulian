<?php

namespace App\Database\Migrations\Absen;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class KegiatanPanitia extends Migration
{
    private $table = 'absen_kegiatan_panitia';

    public function up()
    {
        $fields = [
            'id' => [
                'type' => 'int',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type' => 'varchar',
                'constraint' => 64,
            ],
            'tanggal' => [
                'type' => 'date',
            ],
            'start_regis_in' => [
                'type' => 'time',
            ],
            'end_regis_in' => [
                'type' => 'time',
            ],
            'start_regis_out' => [
                'type' => 'time',
            ],
            'end_regis_out' => [
                'type' => 'time',
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
        ];
        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable($this->table);
    }

    public function down()
    {
        $this->forge->dropTable($this->table);
    }
}
