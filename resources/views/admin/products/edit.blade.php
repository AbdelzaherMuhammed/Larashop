@extends('admin.layout.app')
@section('title', 'Edit products')

@section('content')

    <script>

        $(document).ready(function () {
            $('#msg').hide();

            $("#btn").click(function () {
                $("#msg").show();

                var pro_name  = $("#pro_name").val();
                var pro_code  = $("#pro_code").val();
                var pro_price = $("#pro_price").val();
                var pro_info  = $("#pro_info").val();
                var id        = $("#id").val();
                var token = $("#token").val();


                $.ajax({
                    type: "put",
                    data: "id=" + id + "&product_name=" + pro_name + "&product_code=" + pro_code + "&product_price=" + pro_price +
                        "&_token=" + token + "&product_info=" + pro_info ,
                    url: " {{url(route('products.update' , $records->id))}} ",
                    success: function () {
                        $("#msg").html("product has been updated successfully");
                        $("#msg").fadeOut(2000);
                    }
                });
            });


            var auto_refresh = setInterval(
                function () {
                    $('#products').load("{{url('admin/products/show')}}").fadeIn("slow");
                },100);
        });
    </script>


    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">

                        <div class="content">

                            <h3> product image</h3>
                            <img src="{{asset('/images/' .$records->product_image)}}" width="100%">

                            <div class="footer">
                                <a href="{{url(route('image' , $records->id))}}" class="btn btn-fill btn-sm btn-primary">Change product image</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">

                        <div class="content">
                            <p id="msg" class="alert alert-success"></p>

                            <input type="hidden" value="{{$records->id}}" id="id" class="form-control">
                            <input type="hidden" value="{{csrf_token()}}" id="token"/>

                            <br>
                            @include('admin.partials.validation_errors')
                            <label>Product Name</label>
                            <input type="text" id="pro_name" value="{{$records->product_name}}" class="form-control"/>

                            <br>

                            <label>Product Code</label>
                            <input type="text" id="pro_code" value="{{$records->product_code}}" class="form-control"/>

                            <br>

                            <label>Product Price</label>
                            <input type="number" id="pro_price" value="{{$records->product_price}}" class="form-control"/>

                            <br>
                            <label>Product information</label>
                            <textarea id="pro_info" cols="5" rows="5" class="form-control">
                                {{$records->product_info}}
                            </textarea>

                            <br>

                            <input type="submit" class="btn btn-success btn-fill" value="Submit" id="btn"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    </div>


@endsection
