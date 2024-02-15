<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Category;
class ViewServiceProvider extends ServiceProvider
{

        public function boot()
        {
            View::composer('*', function ($view) {
                $view->with('categories', Category::with('products')->get());
            });
        }
    
    
}
