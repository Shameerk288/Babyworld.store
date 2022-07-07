<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Cart;
use illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     * @param  string  $slug
     * @return void
     */
    public function boot()
    {

        /* if(config('APP_ENV') === 'production') {
            
        } */

        /* \URL::forceScheme('https'); */

        view()->composer('layouts.customer', function ($view) {

            if (Auth::check()) {

                $cartCount = Cart::where('user_id', Auth::user()->id)->count();
                $cart_items = Cart::where('user_id', Auth::user()->id)->get();

                //...with this variable
                $view->with([
                    'cartCount' => $cartCount,
                    'cart_items' => $cart_items
                ]);
            }
        });
    }
}
