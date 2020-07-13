@extends('admin.layout.app')
@section('title', 'Edit products')

@section('content')

    <script>

        $(document).ready(function () {
            $('#msg').hide();

            $("#btn").click(function () {
                $("#msg").show();

                var category_name  = $("#category_name").val();
                var parent_id  = $("#parent_id").val();
                var id        = $("#id").val();
                var token = $("#token").val();


                $.ajax({
                    type: "put",
                    data: "id=" + id + "&category_name=" + category_name + "&parent_id=" + parent_id +
                        "&_token=" + token  ,
                    url: " {{url(route('categories.update' , $records->id))}} ",
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

                            <h3>Change category</h3>
                            <p>Etiam et tellus sem. Etiam blandit sollicitudin lectus vitae faucibus. Donec et massa fringilla.</p>
                            <div class="footer">
                                <p>hasellus non imperdiet sem, vel posuere tellus</p>
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
                            <label>Category Name</label>
                            <input type="text" id="category_name" value="{{$records->category_name}}" class="form-control"/>

                            <br>

                            <label>Parent id</label>
                            <input type="text" id="parent_id" value="{{$records->parent_id}}" class="form-control"/>

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
