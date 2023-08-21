<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Item extends Migration
{
    public function up()
    {
        $fields = [
            'id' => [
                'type' => 'int',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'nama' => [
                'type' => 'varchar',
                'constraint' => 255,
            ],
            'scene' => [
                'type' => 'int',
                'constraint' => 1,
            ],
            'harga' => [
                'type' => 'int',
                'constraint' => 10,
            ],
            'repaired' => [
                'type' => 'int',
                'constraint' => 1,
            ],
            'shop_image' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true,
            ],
            'width' => [
                'type' => 'int',
                'constraint' => 3,
            ],
            'height' => [
                'type' => 'int',
                'constraint' => 3,
            ],
            'z-index' => [
                'type' => 'int',
                'constraint' => 3,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'deleted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('item');
    }

    public function down()
    {
        $this->forge->dropTable("item");
    }
}
