<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $fillable = [
        'type_name',
        'slug',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
