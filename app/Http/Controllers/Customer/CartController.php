<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;
use illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart_items = Cart::where('user_id', Auth::id())->get();

        // dd($cart_items);
        return view('customer.cart')->with('cart_items', $cart_items);
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
        $product_id = $request->input('id');
        $product_qty = $request->input('quantity');

        if (Auth::check()) {

            $prod_chk = Product::where('id', $product_id)->first();

            if ($prod_chk) {

                if (Cart::where('prod_id', $product_id)->where('user_id', Auth::id())->exists()) {

                    return redirect()->back()->with('status', 'This item already exists in cart');
                } else {

                    $cart_items = Cart::create([
                        'prod_id' => $product_id,
                        'user_id' => Auth::id(),
                        'prod_qty' => $product_qty

                    ]);

                    return redirect()->back()->with('status', 'Product added to cart successfully');;
                }
            }
        } else {

            return response()->json(['status' => "Login to continue"]);
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

     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $product_id = $request->input('prod_id');
        $product_qty = $request->input('prod_qty');

        if (Auth::check()) {

            if (Cart::where('prod_id', $product_id)->where('user_id', Auth::id())->exists()) {
                $cart = Cart::where('prod_id', $product_id)->where('user_id', Auth::id())->first();
                $cart->prod_qty = $product_qty;
                $cart->update();
                return response()->json(['status' => "Quantiy Updated"]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::destroy($id);

        return redirect('cart');
    }
}
