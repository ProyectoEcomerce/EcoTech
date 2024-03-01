<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'carts_products')->withPivot('amount');
    }

    public function getTotalAmount()
    {
        return $this->products->sum(function ($product) {
            $discountedPrice = $product->price;
            foreach ($product->offer as $offer){
                    if ($offer->product->contains($product->id)){
                        $discountedPrice = $product->price - ($product->price * $offer->discount / 100);
                        break;
                    }else{ 
                        foreach ($product->categories as $category){
                            if ($offer->category->contains($category->id)){
                                $discountedPrice = $product->price - ($product->price * $offer->discount / 100);
                                break;
                            }
                        }
                    }
            }
            return $discountedPrice * $product->pivot->amount;
        });
    }

}
