<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stars_rated = $request->input('product_rating');
        $product_id = $request->input('prod_id');

        $prod_check = Product::where('id', $product_id)->where('status', '0')->first();
        if ($prod_check) {

            $verified_purchase = Order::where('orders.user_id', Auth::id())
                ->join('order_items', 'orders.id', 'order_items.order_id')
                ->where('order_items.prod_id', $product_id)->get();

            if ($verified_purchase->count() > 0) {

                $user_existing_rating = Rating::where('user_id', Auth::id())->where('prod_id', $product_id)->first();

                if ($user_existing_rating) {

                    $user_existing_rating->stars_rated = $stars_rated;
                    $user_existing_rating->update();
                    return redirect()->back()->with('status', "Rating Updated successfully");
                } else {
                    Rating::create([
                        'user_id' => Auth::id(),
                        'prod_id' => $product_id,
                        'stars_rated' => $stars_rated
                    ]);
                    return redirect()->back()->with('status', "Rating Added Successfully");
                }
            } else {

                return redirect()->back()->with('status', "Sorry you cannot rate this product.Please Purchase the product first");
            }
        } else {

            return redirect()->back()->with('status', "Link Broken");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
