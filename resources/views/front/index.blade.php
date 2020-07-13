@extends('front.master')
@inject('products' , 'App\Product')
@section('content')

    <div class="container-fluid">

        <div class="home-content">
            <div class="row">
                <div class="banner">
                    <img src="{{asset('theme/images/banner1.jpg')}}" alt="" /></div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="home-text">
                        <h1 class="text-center">Nam tincidunt eros consectetur odio viverra fermentum</h1>
                        <p class="text-center">Pellentesque eu venenatis erat. Cras lacinia a orci sed faucibus. Vestibulum congue arcu vitae elit efficitur, quis mollis mauris posuere. In volutpat vestibulum diam, nec convallis nibh interdum non. Duis vestibulum laoreet dolor et gravida. Mauris nisi turpis, ultrices et arcu blandit, dictum volutpat est.</p>
                        <div class="blackbtn">READ MORE</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="yellowBg">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-4 text-center">
                                <div class="col-icon"><img src="{{asset('images/doshas.png')}}" alt="" /></div>
                                <h3>Ayurvedic Doshas</h3>
                                <div class="col-text">In Ayurveda, there are 3 doshas that make up one’s constitution: Vata (gas), Pitta (bile) and Kapha (mucus). Maintaining balance between these doshas ensures perfect health.</div>
                            </div>
                            <div class="col-sm-4 text-center">
                                <div class="col-icon"><img src="{{asset('images/gluten-allergy.png')}}" alt="" /></div>
                                <h3>Gluten Allergy</h3>
                                <div class="col-text">Found in wheat, rye and barley, gluten is a common allergen linked to 50+ diseases. If you too have gluten intolerance, allergy or sensitivity, don’t worry – we can help you cure it.</div>
                            </div>
                            <div class="col-sm-4 text-center">
                                <div class="col-icon"><img src="{{asset('images/diet.png')}}" alt="" /></div>
                                <h3>Ayurvedic Diet</h3>
                                <div class="col-text">We are probably the only company that doesn’t want you to come back to us again and again. Made with love, our Ayurvedic diet can surely help you be in good health always.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container hidden-xs">
                <div id="hdLine"><span><h1>Our Product Range</h1></span><hr></div>
                <div class="row">
                    @foreach($products->take(3)->get() as $product)
                    <div class="col-xs-6 col-sm-4">
                        <div class="itemBox bdr">
                            <div class="prod"><img src="{{asset('images/'.$product->product_image)}}" alt="" length="400" height="400" /></div>
                            <label>{{$product->product_name}}</label>
                            <span class="hidden-xs">{{$product->product_info}}</span>
                            <div class="addcart">
                                <div class="price">Rs {{$product->product_price}}</div>
                                <div class="cartIco hidden-xs"><a href="{{url('details' , $product->id)}}"></a></div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
                <div class="row hidden-xs">
                    <div class="col-sm-12">
                        <div class="topSell">
                            <h3>DISCOVER OUR TOP SELLERS PRODUCTS FOR BODYCARE</h3>
                            <span class="bttn"><a href="{{url('/products')}}">SHOP NOW</a></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 text-center">
                        <div class="helpIco">
                            <img src="{{asset('theme/images/free-shipping.png')}}" alt="" />
                        </div>

                        <h5>Free Shipping</h5>
                        <div class="helpText">Get your desirable product on your doorstep and  free delivery on all over india.</div>
                    </div>
                    <div class="col-sm-4 text-center">
                        <div class="helpIco"><img src="{{asset('theme/images/call-us.png')}}" alt="" /></div>
                        <h5>Call : {{$settings->whats_app}}</h5>
                        <div class="helpText">If you have any question feel free to contact us and we would be happy to help you</div>
                    </div>
                    <div class="col-sm-4 text-center">
                        <div class="helpIco"><img src="{{asset('theme/images/return-policy.png')}}" alt="" /></div>
                        <h5>Return Policy</h5>
                        <div class="helpText">If you want to return, feel free to contact our customer service</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
