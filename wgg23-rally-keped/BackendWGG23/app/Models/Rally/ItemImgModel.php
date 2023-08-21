<?php

namespace App\Models\Rally;

use CodeIgniter\Model;

class ItemImgModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'item_img';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_item', 'image', 'created_at', 'updated_at', 'deleted_at'];

    public function get_item_img($items) {
        return $this->whereIn('id_item', $items)->findAll();
    }
}
