<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Product;


class ProductImages extends Model
{
    protected $fillable = [
        'product_id', 'images'
    ];

    public function images(){
        return $this->belongsTo(Product::class, 'Product_id');
    }
}
