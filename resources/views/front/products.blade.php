@extends('front.master')
@section('title', 'Products list')
@inject('categories' , 'App\Category')
@section('content')

    <div class="greyBg">
        <div class="container">
            <div class="wrapper">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="breadcrumbs">
                            <ul>
                                <li><a href="#">Home</a></li>
                                @if(count($records) == 0)
                                    <li><span class="dot">/</span> <b href="#">{{$cat}}</b></li>
                                @else
                                    <li><span class="dot">/</span> <a href="{{url('products')}}/{{$cat}}">{{$cat}}</a>
                                    </li>
                                @endif

                            </ul>
                        </div>
                    </div>
                </div>
                <h1 class="text-center">{{$cat}}</h1>
                @if(count($records) != 0)
                    <div class="row top25">



                        <div class="col-xs-6 col-sm-3">
                            <select id="catId">
                                <option value="">Select a Category</option>
                                @foreach($categories->all() as $category)
                                    <option class="option" value="{{$category->id}}">
                                        {{$category->category_name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-xs-6 col-sm-3">
                            <select id="price">
                                <option value="" >Select Price Range</option>
                                <option value="0-100">0-100</option>
                                <option value="100-300">100-300</option>
                                <option value="300-500">300-500</option>
                                <option value="500-1000">500-1000</option>
                            </select>
                        </div>

                        <div class="col-sm-6 hidden-xs">
                            <div class="col-sm-4 pull-right">
                                <button id="findBtn" class="btn btn-primary">Find</button>
                            </div>
                            <div class="styleNm">16 style(s)</div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="row top25">
                @if(count($records) == 0)
                    <div class="col-xs-12" align="center" style="margin: 20px">
                        <h1>No products found under <strong style="color: red">{{$cat}}</strong> category</h1>
                    </div>
                @else
                    <div id="productData">
                    @foreach($records as $record)
                        <div class="col-xs-6 col-sm-4">
                            <div class="itemBox">
                                <div class="prod"><img src="{{asset('/images/' .$record->product_image)}}"
                                                       height="300px" width="300px" alt=""/></div>
                                <label>{{$record->product_name}}</label>
                                <span class="hidden-xs">Code : {{$record->product_code}}</span>
                                <br>
                                <span class="hidden-xs">Information : {{$record->product_info}}</span>
                                <div class="addcart">
                                    <div class="price">Rs {{$record->product_price}}</div>
                                    <div class="cartIco hidden-xs"><a href="{{url('details' , $record->id)}}"></a></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                @endif

            </div>

        </div>

        @push('scripts')
            <script>
                $(document).ready(function () {

                    $("#findBtn").click(function () {
                        var cat = $("#catId").val();
                        var price = $("#price").val();
                        // alert(cat);
                    $.ajax({
                       type :'get',
                        dataType: 'html',
                       url  :'{{url('productCat')}}',
                       data : 'cat_id=' + cat + '&price=' + price,
                       success:function (response) {
                            console.log(response);
                            $("#productData").html(response);
                       }
                    });
                    });
                });
            </script>


    @endpush


@endsection
