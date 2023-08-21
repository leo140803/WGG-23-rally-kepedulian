<?php

namespace App\Models\Rally;

use CodeIgniter\Model;

class FaqControllerModel extends Model
{
    protected $table            = 'faqrally';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id', 'question', 'answer'];

    public function show_data() {
        return $this
        ->db
        ->table($this->table)
        ->get()
        ->getResult();
    }

    public function search_data($keyword) {
        $builder = $this->table("faqrally");
        $arr_keyword = explode(" ", $keyword);
        for($x = 0; $x < count($arr_keyword); $x++) {
            $builder->orLike('question', $arr_keyword[$x]);
            $builder->orLike('answer', $arr_keyword[$x]);
        }
        return $builder;
    }

}
