<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trending_products = Product::where('trending', '1')->take(15)->get();
        $trending_categories = Category::where('popular', '1')->take(10)->get();
        $rating = Rating::all();
        $products = Product::all();

        return view('customer.index')->with([
            'trending_products' => $trending_products,
            'trending_categories' => $trending_categories,
            'ratings' => $rating,
            'products' => $products,
        ]);
    }

    public function allproducts()
    {
        $categories = Category::all();
        $products = Product::all();

        $rating = Rating::all();

        return view('customer.shop')->with([
            'products' => $products,
            'categories' => $categories,
            'ratings' => $rating
        ]);
    }

    public function about()
    {
        return view('customer.about');
    }

    public function contact()
    {
        return view('customer.contact');
    }

    public function categories()
    {
        $categories = Category::all();
        return view('customer.category')->with('categories', $categories);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function cat_products($slug)
    {
        if (Category::where('slug', $slug)->exists()) {

            $categories = Category::all();
            $rating = Rating::all();
            $category = Category::where('slug', $slug)->first();
            $products = Product::where('cat_id', $category->id)->where('status', 0)->get();
            return view('customer.products.cat_products')->with([
                'category' => $category,
                'products' => $products,
                'categories' => $categories,
                'ratings' => $rating
            ]);
        } else {
            return redirect('/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */

    public function categoryfilter($slug)
    {
        if (Category::where('slug', $slug)->exists()) {

            $category = Category::where('slug', $slug)->first();
            $products = Product::where('cat_id', $category->id)->where('status', 0)->get();
            return redirect::back()->with([
                'products' => $products
            ]);
        }
        /* else {
     
        $products = Product::all();
        return redirect('shop')->with('products', $products);
        } */
    }

    public function prod_details($prod_slug)
    {
        if (Product::where('slug', $prod_slug)->exists()) {

            $product = Product::where('slug', $prod_slug)->first();
            $ratings = Rating::where('prod_id', $product->id)->get();
            $rating_sum = Rating::where('prod_id', $product->id)->sum('stars_rated');
            $user_rating = Rating::where('prod_id', $product->id)->where('user_id', Auth::id())->first();
            $reviews = Review::where('prod_id',$product->id)->get();

            if ($ratings->count() > 0) {

                $rating_value = $rating_sum / $ratings->count();
            } else {

                $rating_value = 0;
            }

            return view('customer.products.prod_details')->with([
                'product' => $product,
                'rating' => $ratings,
                'rating_value' => $rating_value,
                'user_rating' => $user_rating,
                'reviews' => $reviews
            ]);
        } else {

            return redirect('/');
        }
    }

    public function productsearchlist()
    {
        $products = Product::select('name')->where('status','0')->get();

        $data = [];

        foreach ($products as $item) {
            $data[] = $item['name'];
        }

        return $data;
    }

    public function searchproduct(Request $request)
    {
        $searched_product = $request->product_name;

        if($searched_product != "")
        {
            $product = Product::where("name","LIKE","%$searched_product%")->first();
            if($product)
            {
                return redirect('shop/'.$product->slug);
            }
            else
            {
                return redirect()->back()->with("status","No Products Matched");
            }
        }
        else
        {
            return redirect()->back();
        }
    }

}
