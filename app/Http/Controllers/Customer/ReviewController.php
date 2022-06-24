<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
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
    public function create($product_slug)
    {
        $product = Product::where('slug', $product_slug)->where('status', '0')->first();

        if ($product) {

            $product_id = $product->id;
            $review = Review::where('user_id',Auth::id())->where('prod_id',$product_id)->first();

            if($review)
            {
                return view('customer.edit-review')->with('review',$review);
            }
            else
            {
                $verified_purchase = Order::where('orders.user_id', Auth::id())
                ->join('order_items', 'orders.id', 'order_items.order_id')
                ->where('order_items.prod_id', $product_id)->get();

                return view('customer.review')->with([
                    'product' => $product,
                    'verified_purchase' => $verified_purchase
                ]);
            }

            
        } else {

            return redirect()->back()->with('status', 'Link Broken');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product_id = $request->input('product_id');

        $product = Product::where('id', $product_id)->where('status', '0')->first();

        if($product)
        {
            $user_review = $request->input('user_review');
            $new_review = Review::create([
                'user_id' => Auth::id(),
                'prod_id' => $product_id,
                'user_review' => $user_review
            ]);

            $product_slug = $product->slug;
            if($new_review)
            {     
                return redirect('shop/'.$product_slug)->with('status',"Review added");
            }
        }
        else
        {
            return redirect()->back()->with('status','Link Broken');
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
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $product = Product::where('slug',$slug)->where('status','0')->first();
        if($product)
        {
            $product_id = $product->id;
            $review = Review::where('user_id',Auth::id())->where('prod_id',$product_id)->first();

            if($review)
            {
                return view('customer.edit-review')->with('review',$review);
            }
            else
            {
                return redirect()->back()->with('status','Link Broken');
            }
        }
        else
        {
            return redirect()->back()->with('status','Link Broken');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user_review = $request->input('user_review');

        if($user_review != '')
        {
            $review_id = $request->input('review_id');
            $review = Review::where('id',$review_id)->where('user_id',Auth::id())->first();
            if($review)
            {
                $review->user_review = $request->input('user_review');
                $review->update();
                return redirect('shop/'.$review->product->slug)->with('status',"Review Updated Successfully");
            }
            else
            {
                return redirect()->back()->with('status','Link Broken');
            }
        }
        else
        {
            return redirect()->back()->with('status','You cannot submit empty review');
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
        //
    }
}
