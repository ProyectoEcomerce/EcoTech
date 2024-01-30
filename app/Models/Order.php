<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function invoice(){
        return $this->hasOne(Invoice::class);
    }

    public function product(){
        return $this->belongsToMany(Product::class);
    }

}
