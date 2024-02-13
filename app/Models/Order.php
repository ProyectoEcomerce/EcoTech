<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable= ['total_price', 'status', 'user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function invoice(){
        return $this->hasOne(Invoice::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'orders_products', 'order_id', 'product_id');
    }



}
