<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RBACRoleRoute extends Migration
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
            'id_role' => [
                'type' => 'int',
                'unsigned' => true
            ],
            'id_route' => [
                'type' => 'int',
                'unsigned' => true
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
        $this->forge->addForeignKey('id_role', 'rbac_role', 'id');
        $this->forge->addForeignKey('id_route', 'rbac_route', 'id');
        $this->forge->createTable('rbac_role_route');
    }

    public function down()
    {
        //
        $this->forge->dropTable("rbac_role_route");
    }
}
