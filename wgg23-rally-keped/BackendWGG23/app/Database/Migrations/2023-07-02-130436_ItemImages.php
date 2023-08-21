<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ItemImages extends Migration
{
    public function up()
    {
        $fields = [
            'id' => [
                'type' => 'int',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'id_item' => [
                'type' => 'int',
                'unsigned' => true,
            ],
            'image' => [
                'type' => 'varchar',
                'constraint' => 255,
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
        $this->forge->addForeignKey('id_item', 'item', 'id');
        $this->forge->createTable('item_img');
    }

    public function down()
    {
        $this->forge->dropTable("item_img");
    }
}
