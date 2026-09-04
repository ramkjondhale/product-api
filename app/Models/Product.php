<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_type_id',
        'product_name',
        'product_detail',
        'product_image'
    ];

    public function product_type()
    {
        return $this->belongsTo(ProductType::class);
    }
}
