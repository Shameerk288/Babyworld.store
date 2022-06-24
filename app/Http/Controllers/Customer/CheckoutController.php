<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

// use Mail;
use App\Mail\DemoMail;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $old_cartItems = Cart::where('user_id', Auth::id())->get();

        foreach ($old_cartItems as $item) {

            if (!Product::where('id', $item->prod_id)->where('qty', '>=', $item->prod_qty)->exists()) {

                $deleteItem = Cart::where('user_id', Auth::id())->where('prod_id', $item->prod_id)->first();
                $deleteItem->delete();
            }
        }
        $cartItems = Cart::where('user_id', Auth::id())->get();

        return view('customer.checkout')->with('cartItems', $cartItems);
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
        $order = new Order();
        $order->user_id = Auth::id();
        $order->name = $request->input('name');
        $order->phone = $request->input('phone');
        $order->email = $request->input('email');
        $order->address = $request->input('address');
        $order->country = $request->input('country');
        $order->city = $request->input('city');
        $order->state = $request->input('state');
        $order->code = $request->input('code');

        $total = 0;
        $cartItems_total = Cart::where('user_id', Auth::id())->get();
        foreach ($cartItems_total as $item) {

            $total = $total + $item->products->selling_price;
        }

        $order->total_price = $total;
        $order->tracking_no = 'Order' . rand(1111, 9999);
        $order->save();

        $cartItems = Cart::where('user_id', Auth::id())->get();
        foreach ($cartItems as $item) {

            OrderItems::create([
                'order_id' => $order->id,
                'prod_id' => $item->prod_id,
                'qty' => $item->prod_qty,
                'price' => $item->products->selling_price
            ]);

            $prod = Product::where('id', $item->prod_id)->first();
            $prod->qty = $prod->qty - $item->prod_qty;
            $prod->update();
        }

        if (Auth::user()->address == NULL) {

            $user = User::where('id', Auth::id())->first();
            $user->phone = $request->input('phone');
            $user->address = $request->input('address');
            $user->country = $request->input('country');
            $user->city = $request->input('city');
            $user->state = $request->input('state');
            $user->code = $request->input('code');
            $user->update();
        }

        $cartItems = Cart::where('user_id', Auth::id())->get();
        Cart::destroy($cartItems);



        // $mailData = [
        //     'title' => 'Mail from babyworld.store',
        //     'body' => 'Your Order has been placed'
        // ];

        // Mail::to('shameerk288@gmail.com')->send(new DemoMail($mailData));


        return redirect('/')->with('status', 'Order Placed Successfully');
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
