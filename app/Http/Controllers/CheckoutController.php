<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Coupon;
use App\Total;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('front.checkout', [
            'records' => Cart::content(),
        ]);
    }

    public function placeOrder(Request $request)
    {
        $rules = [
            'full_name' => 'required|min:5|max:35',
            'email' => 'required|email',
            'phone' => 'required|numeric|min:11',
            'city' => 'required|min:5|max:25',
            'state' => 'required|min:5|max:25',
            'country' => 'required',
            'full_address' => 'required'
        ];

        $this->validate($request, $rules);

        $contact = auth()->user()->contacts()->create($request->all());

        $order = auth()->user()->orders()->create();
        $order->total = Cart::total();
        $order->save();
        foreach (Cart::content() as $cartData) {
            $order->products()->attach($cartData->id, [
                'quantity' => $cartData->qty,
                'total' => $cartData->qty * $cartData->price
            ]);
        }
        Cart::destroy();
        return redirect('thankyou');
    }

    public function checkCoupon(Request $request)
    {
        $code = $request->coupon_code;

        $check = Coupon::where('coupon_code', $code)->get();

        if (count($check) == 1) {
            $check_used = auth()->user()->coupons()->count();

            if ($check_used == 0) {
                auth()->user()->coupons()->attach($check[0]->id);
                 $insert_cart_total = Total::create([
                    'cart_total' => Cart::total(),
                    'discount' => $check[0]->discount,
                    'user_id' => auth()->user()->id,
                    'grand_total' => Cart::total() - (Cart::total() * $check[0]->discount)/100,
                ]);

                 $new_discount = $check[0]->discount;
                 $new_total = Cart::total() - (Cart::total() * $check[0]->discount)/100 ;

//                return 'applied';
                ?>
                <div class="cart-total">
                    <h4>Total Amount</h4>
                    <table>
                        <tbody>
                        <tr>
                            <td>Sub Total</td>
                            <td>EG <?php echo Cart::subtotal(); ?> </td>
                        </tr>
                        <tr>
                            <td>Tax (%)</td>
                            <td>EG <?php echo Cart::tax(); ?> </td>
                        </tr>
                        <tr>
                            <td>Grand Total</td>
                            <td>EG <?php echo Cart::total(); ?> </td>
                        </tr>

                        <tr><td colspan="2"><hr></td></tr>
                        <tr>
                            <td>Discount(%) </td>
                            <td> <?php echo $new_discount; ?></td>
                        </tr>

                        <tr>
                            <td>Grand Total (After discount) </td>
                            <td>EG <?php echo $new_total; ?></td>
                        </tr>

                        </tbody>
                    </table>

                    <a href="<?php url(route('checkout'))?>" class="btn check_out btn-block">CheckOut</a>

                </div>
                <?php
            } else {
                ?>
                <div class="alert alert-warning">you already used this coupon</div>
                 <div class="cart-total">
                    <h4>Total Amount</h4>
                    <table>
                        <tbody>
                        <tr>
                            <td>Sub Total</td>
                            <td>EG <?php echo Cart::subtotal(); ?> </td>
                        </tr>
                        <tr>
                            <td>Tax (%)</td>
                            <td>EG <?php echo Cart::tax(); ?> </td>
                        </tr>
                        <tr>
                            <td>Grand Total</td>
                            <td>EG <?php echo Cart::total(); ?> </td>
                        </tr>

                        </tbody>
                    </table>
                    <input type="submit" class="btn update btn-block  "
                           value="Continue Shopping">
                    <a href="<?php url('checkout')?>"' class="btn check_out btn-block">CheckOut</a>

                </div>
                <?php
            }
        } else {

            ?>
            <div class="alert alert-danger">You inserted a wrong coupon!</div>
            <div class="cart-total">
                <h4>Total Amount</h4>
                <table>
                    <tbody>
                    <tr>
                        <td>Sub Total</td>
                        <td>EG <?php echo Cart::subtotal(); ?> </td>
                    </tr>
                    <tr>
                        <td>Tax (%)</td>
                        <td>EG <?php echo Cart::tax(); ?> </td>
                    </tr>
                    <tr>
                        <td>Grand Total</td>
                        <td>EG <?php echo Cart::total(); ?> </td>
                    </tr>

                    </tbody>
                </table>
                <input type="submit" class="btn update btn-block  "
                       value="Continue Shopping">
                <a href="<?php url('checkout')?>" class="btn check_out btn-block">CheckOut</a>

            </div>
            <?php
        }
    }
}
