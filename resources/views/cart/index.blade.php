@extends('front.master')

@section('content')
    <div class="greyBg">
        <div class="container">
            <div class="wrapper">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="breadcrumbs">
                            <ul>
                                <li><a href="{{url('/')}}">Home </a></li>


                                <li><span class="dot">/</span>
                                    <a href="">Cart</a>
                            </ul>
                        </div>
                    </div>
                </div>
                {{--    design of cart page          --}}

                <div class="row top20 hidden-xs">
                    <div class="col-sm-3">
                        <div class="blk-box">
                            <div class="blk-boxHd">Shopping Cart</div>
                            <div class="blk-boxTxt hidden-sm">Do you want to look on order?</div>
                            <div class="arrow-down"></div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="wht-box">
                            <div class="wht-boxHd">Billing &amp; Shipping</div>
                            <div class="wht-boxTxt hidden-sm">Where should we send this order?</div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="wht-box">
                            <div class="wht-boxHd">Order Review</div>
                            <div class="wht-boxTxt hidden-sm">How do you want to pay for your order?</div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="wht-box">
                            <div class="wht-boxHd">Confirmation</div>
                            <div class="wht-boxTxt hidden-sm">Confirm your order</div>
                        </div>
                    </div>
                </div>
                @if(Cart::count() != 0)
                <div class="row">
                    <div class="cart">
                        <div class="col-sm-12">
                            <h2>Shopping Basket</h2>
                                <div class="row">
                                    <div class="alert alert-info" id="CartMsg"></div>
                                    <div class="col-sm-8">

                                        @foreach($records as $record)
                                            <div class="cart-row">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-6 col-md-6 text-center">
                                                        <img
                                                            src="{{asset('images')}}/{{$record->options->image}}"
                                                            class="img-responsive pull-left" width="100px"/>
                                                        <span class="pull-left top20">
                                                          <a href="{{url('details')}}/{{$record->id}}">
                                                              <b>{{ucwords($record->name)}}</b>
                                                          </a>
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3 col-md-3">
                                                        <input type="hidden" value="{{$record->rowId}}" id="rowId{{$record->rowId}}">

                                                        <div class="cart-qty"><span>Qty : </span>
                                                            <input type="number" max="10" min="1" class="qty-fill"
                                                                   value="{{ $record->qty }}" id="upCart{{$record->id}}">
                                                        </div>
                                                        <a class="cart-remove btn btn-success">Update</a>
                                                        <a href="{{url('cart/remove')}}/{{$record->rowId}}"
                                                           class="cart-remove btn btn-danger">Remove</a>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3 col-md-3">
                                                        <h6>Unit Price</h6>
                                                        <p>EG {{$record->price}}</p>
                                                        <hr/>
                                                        <h6 class="redtext">
                                                            Sub Total: {{$record->subtotal}}
                                                            <br>
                                                            Total(included Tax): {{$record->total}}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="chk-coupon">
                                                <label>Coupon Code (if any)</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="couponId">
                                                    <span class="input-group-btn">
						                    <input type="button" class="btn fld-btn" id="couponBtn" value="Redeem Coupon"/>
						                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="cart-total" id="cartTotal">
                                            <h4>Total Amount</h4>
                                            <table>
                                                <tbody>
                                                <tr>
                                                    <td>Sub Total</td>
                                                    <td>EG {{Cart::subtotal()}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tax (%)</td>
                                                    <td>EG {{Cart::tax()}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Grand Total</td>
                                                    <td>EG {{Cart::total()}}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <input type="submit" class="btn update btn-block  "
                                                   value="Continue Shopping">
                                            <a href="{{url('checkout')}}" class="btn check_out btn-block">CheckOut</a>

                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md-2 col-md-offset-5 top25">
                                        <img src="{{asset('images/empty-cart.png')}}"
                                             class="img-response"/>
                                        <br><br>
                                        <p style="text-align:center">Nothing in the bag<br><br>
                                            <a href="{{url('products')}}"
                                               class="btn btn-fill btn-primary">Continue Shopping</a>
                                        </p>

                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                {{--    design of cart page end      --}}

            </div>
        </div>
    </div>

    @push('scripts')

        <script>
            $(document).ready(function () {
                $('#CartMsg').hide()
                @foreach($records as $record)
                $('#upCart{{$record->id}}').on('change keyup', function () {
                    var newQuantity = $('#upCart{{$record->id}}').val();
                    var rowId = $('#rowId{{$record->rowId}}').val();
                    // alert(rowId)
                    $.ajax({
                        type : 'get',
                        url  : '{{url('cart/update')}}' ,
                        data : 'newQty=' + newQuantity + '&rowId=' + rowId,
                        success:function (response) {
                            console.log(response);
                            $('#CartMsg').show(response)
                            $('#CartMsg').html(response)
                            $('#CartMsg').fadeOut(2000)

                        }
                    })
                })

                @endforeach
            })

            $('#couponBtn').click(function () {
                var couponId = $('#couponId').val();
                // alert(couponId)
                $.ajax({
                    url : '{{url('check-coupon')}}',
                    type: 'get',
                    data: 'coupon_code=' + couponId,
                    success:function (response) {
                        // alert(response);
                        $('#cartTotal').html(response);
                    }
                })


            })
        </script>

    @endpush
@endsection
