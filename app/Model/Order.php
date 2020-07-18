<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_id',
        'customer_id',
        'shipping_details',
        'cart_details',
        'payment_method',
        'charge_id'
    ];

    //every user must have order
    public function user(){
        return $this->belongsTo('App\User', 'customer_id');
    }
}
