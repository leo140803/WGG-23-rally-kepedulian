<?php

namespace App\Database\Migrations\Pelanggaran;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Pelanggaran extends Migration
{
    private $table = 'pelanggaran';

    public function up()
    {
        $fields = [
            'id' => [
                'type' => 'int',
                'unsigned' => true,
                'auto_increment' => true,
            ],

            'nrp' => [
                'type' => 'varchar',
                'constraint' => 9,
            ],

            'idPasal' => [
                'type' => 'int',
                'constraint' => 4,
            ],

            'pasalTerlanggar' => [
                'type' => 'varchar',
                'constraint' => 2,
            ],

            'ayatTerlanggar' => [
                'type' => 'int',
                'constraint' => 4,
            ],

            'keterangan' => [
                'type' => 'varchar',
                'constraint' => 100,
            ],

            'poin' => [
                'type' => 'int',
                'constraint' => 11,
            ],

            'tanggalMelanggar' => [
                'type' => 'date',
            ],

            'nrpPerekap' => [
                'type' => 'varchar',
                'constraint' => 9,
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
        //column tabel ini, tabel yg di refer, column di tabel yg di refer
        $this->forge->addForeignKey('idPasal', 'datapasal', 'id'); 
        $this->forge->addForeignKey('ayatTerlanggar', 'dataayat', 'ID'); 
        $this->forge->createTable($this->table);
    }

    public function down()
    {
        $this->forge->dropTable('pelanggaran');  
    }
}
