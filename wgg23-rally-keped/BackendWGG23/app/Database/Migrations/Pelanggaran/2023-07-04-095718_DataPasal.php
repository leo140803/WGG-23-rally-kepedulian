<?php

namespace App\Database\Migrations\Pelanggaran;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class DataPasal extends Migration
{
    private $table = 'datapasal';

    public function up()
    {
        $fields = [

            'id' => [
                'type' => 'int',
                'constraint' => 4,
                'auto_increment' => true,
            ],

            'Bab' => [
                'type' => 'varchar',
                'constraint' => 2,
            ],

            'Keterangan' => [
                'type' => 'varchar',
                'constraint' => 500,
            ],

            'JumlahPoin' => [
                'type' => 'int',
                'constraint' => 5,
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
        $this->forge->dropTable('datapasal');  
    }
}
