<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RBACRoute extends Migration
{
    public function up()
    {
        //
        $fields = [
            'id' => [
                'type' => 'int',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'nama' => [
                'type' => 'text',
                'null' => false
            ],
            'route' => [
                'type' => 'text',
                'null' => false
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
        $this->forge->createTable('rbac_route');
    }

    public function down()
    {
        //
        $this->forge->dropTable("rbac_route");
    }
}
