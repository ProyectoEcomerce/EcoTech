<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','price', 'offerPrice', 'voltage', 'guarantee', 'manufacturing_price', 'weigth', 'materials', 'description', 'dimensions', 'battery', 'engine', 'components', 'favouriteCounter'];

    public function image(){
        return $this->hasMany(Image::class);
    }

    public function order(){
        return $this->belongsToMany(Order::class);
    }

    public function cart(){
        return $this->belongsToMany(Cart::class, 'carts_products')->withPivot('amount');
    }

    public function wishlist(){
        return $this->belongsToMany(Wishlist::class, 'products_wishlists');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_products');
    }
    
    public function offer(){
        return $this->belongsTo(Offer::class, 'offer_product');
    }
}
