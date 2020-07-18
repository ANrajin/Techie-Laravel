<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use  App\Model\Brand;
use  App\Model\Category;
use  App\Model\ProductImages;

class Product extends Model
{
    protected $fillable = 
    [
        'product_name', 'product_sku', 'category_id', 'brand_id', 
        'quantity', 'price', 'slug', 'is_featured', 'status', 'details', 'main_thumbnail'
    ];

    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
}
