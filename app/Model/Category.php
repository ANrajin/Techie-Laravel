<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
    	'name', 'parent_id', 'status'
    ];

    //joining same table to get parent category by its id
    public function parent(){
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
