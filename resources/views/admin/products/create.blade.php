@extends('admin.layout.app')
@inject('categories' , 'App\Category')
@section('title', 'Products')
@include('admin.partials.validation_errors')


@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7">
                    <div class="card">


                        <div class="content">


                            <h2>Add products</h2>
                            <div id="validation-errors"></div>
                            <p id="msg" class="alert alert-success"></p>
                            <input type="hidden" value="{{csrf_token()}}" id="token"/>

                            <br>
                            @include('admin.partials.validation_errors')
                            <label>Product Name</label>
                            <input type="text" id="pro_name" class="form-control"/>

                            <br>

                            <label>Product Code</label>
                            <input type="text" id="pro_code" class="form-control"/>

                            <br>

                            <label>Product Price</label>
                            <input type="number" id="pro_price" class="form-control"/>

                            <br>
                            <label>Product Information</label>
                            <textarea id="pro_info" cols="5" rows="5" class="form-control"></textarea>

                            <br>

                            <label>Category</label>
                            <select id="cat_id" class="custom-select-lg form-control">
                                <option value="">Please select category</option>
                                @foreach($categories->all() as $category)
                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                            <br>
                            <br>
                            <input type="submit" class="btn btn-success btn-fill" value="Submit" id="btn"/>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card">
                        <table class="table table-hover table-striped">
                            <tr>
                                <td colspan="5" style="text-align:right"><b>Total : </b>{{App\Product::count()}}</td>
                            </tr>

                            <tr style="border-bottom: 1px solid #ccc">
                                <th style="padding: 10px">Product Name</th>
                                <th style="padding: 10px">Product Code</th>
                                <th style="padding: 10px">Category</th>
                                <th style="padding: 10px">Price</th>
                                <th>Update</th>
                            </tr>
                        </table>

                        <div class="content" style="height: 400px;overflow-y: scroll">
                            <div id="products">
                                <img src="{{asset('img/loading.gif')}}" alt="" style="width: 100%;text-align: center">
                            </div>
                            <div class="footer">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#msg').hide();

                $("#btn").click(function () {
                    $("#msg").show();

                    var pro_name = $("#pro_name").val();
                    var pro_code = $("#pro_code").val();
                    var pro_price = $("#pro_price").val();
                    var pro_info = $("#pro_info").val();
                    var cat_id = $("#cat_id").val();
                    var token = $("#token").val();

                    $.ajax({
                        type: "post",
                        data: "product_name=" + pro_name + "&product_code=" + pro_code + "&product_price=" + pro_price
                            + "&product_info=" + pro_info + "&category_id=" + cat_id + "&_token=" + token,
                        url: "{{url(route('products.store'))}}",
                            success:function(data){
                                $("#pro_name").val('');
                                $("#pro_code").val('');
                                $("#pro_price").val('');
                                $("#pro_info").val('');
                                $("#cat_id").empty();
                                $("#cat_id").append('<option value="">Please select category</option>')
                                $('#validation-errors').html('');
                                $("#msg").html("Product has been inserted");
                                $("#msg").fadeOut(2000);
                        },
                        error : function (xhr) {
                            $('#validation-errors').html('');
                            $.each(xhr.responseJSON.errors, function (key, value) {
                                $('#validation-errors').append('<div class="alert alert-danger">' + value + '</div>');
                            });
                        },
                    });
                });

                var auto_refresh = setInterval(
                        function () {
                            $('#products').load("{{url('admin/products/show')}}").fadeIn("slow");
                        }, 4000)

            });

            $(document).ready(function () {
                $('#cat_id').select2();
            });
        </script>

    @endpush
@endsection

