<?php

namespace App\Database\Migrations\Pelanggaran;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Dataayat extends Migration
{
    private $table = 'dataayat';
    public function up()
    {
        $fields = [
            'ID' => [
                'type' => 'int',
                'constraint' => 4,
                'auto_increment' => true,
            ],

            'idPasal' => [
                'type' => 'int',
                'constraint' => 4,
            ],

            'Pasal' => [
                'type' => 'varchar',
                'constraint' => 2,
            ],

            'Keterangan' => [
                'type' => 'varchar',
                'constraint' => 500,
            ],

            'sistemTegur' => [
                'type' => 'int',
                'constraint' => 11,
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
        $this->forge->addPrimaryKey('ID');
        $this->forge->addForeignKey('idPasal', 'datapasal', 'id'); 
        //column tabel ini, tabel yg di refer, column di tabel yg di refer
        $this->forge->createTable($this->table);
    }

    public function down()
    {
        $this->forge->dropTable('dataayat');  
    }
}
