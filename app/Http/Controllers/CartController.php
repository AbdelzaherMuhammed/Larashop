<?php

namespace App\Http\Controllers;

use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $records =  Cart::content();
        return view('cart.index',compact('records'));
    }

    public function addItem($id)
    {
        $product =  Product::find($id);
         $add = Cart::add(['id' => $product->id, 'name' => $product->product_name, 'qty' => 1,
            'price' => $product->product_price
            , 'weight' => '550' , 'options'=>[
                'image' => $product->product_image
             ]]);
//        echo "added to cart successfully";
         if ($add)
         {
             return view('cart.index', [
                 'records' => Cart::content()
             ]);
         }
    }

    public function removeItem($id)
    {
       $remove =  Cart::remove($id);
       return back();

    }

    public function update(Request $request)
    {
        $newQuantity =  $request->newQty;
        $rowId = $request->rowId;

        //Updating cart

        Cart::update($rowId , $newQuantity);

        echo "Cart updated successfully";
    }

//    public function checkout(Request $request)
//    {
//        return view('front.checkout' , [
//            'records' => Cart::content(),
//        ]);
//        $order = auth()->user()->orders()->create();
//        $order->total = Cart::total();
//        $order->save();
//        foreach (Cart::content() as $cartData)
//        {
//            $order->products()->attach($cartData->id , [
//                'quantity' => $cartData->qty,
//                'total'    => $cartData->qty * $cartData->price
//            ]);
//        }
//        Cart::destroy();
//        return back();

//    }
}
