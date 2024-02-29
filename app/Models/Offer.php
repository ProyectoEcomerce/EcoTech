<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    public function product(){
        return $this->belongsToMany(Product::class, 'offer_product');
    }

    public function category(){
        return $this->belongsToMany(Category::class, 'offer_product');
    }
}
