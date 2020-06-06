<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
//    function __construct(array $attributes = [])
//    {
//        parent::__construct($attributes);
//    }

    protected $fillable = [
        'id',
        'employee_id',
        'product_id',
        'print',
        'cut_paper',
        'heat_press',
        'cut_print',
        'edging',
        'pip_side',
        'cut_edge',
        'pip_strap',
        'lock_strap',
        'cut_strap',
        'pic_pack'
    ];

    public function products(){
        return $this->belongsTo(Product::class);
    }

    public function employees(){
        return $this->belongsTo(Employee::class);
    }

}
