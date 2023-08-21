<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RBACUserRole extends Migration
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
            'user' => [
                'type' => 'varchar',
                'constraint' => 50,
                'null' => false
            ],
            'id_role' => [
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
        $this->forge->createTable('rbac_user_role');
    }

    public function down()
    {
        //
        $this->forge->dropTable("rbac_user_role");
    }
}
