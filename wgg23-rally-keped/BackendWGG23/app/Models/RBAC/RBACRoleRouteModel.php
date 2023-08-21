<?php

namespace App\Models\RBAC;

use CodeIgniter\Model;

class RBACRoleRouteModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'rbac_role_route';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_role', 'id_route'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
