<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart_products extends Model
{

    use HasFactory;
    protected $guarded =[];
    protected $primaryKey = ['cart_id', 'product_id'];

    public $incrementing = false;

}
