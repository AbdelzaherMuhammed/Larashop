@extends('admin.layout.app')
@section('title', 'Categories')
@include('admin.partials.validation_errors')

@section('content')


    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7">
                    <div class="card">

                        <div class="content">

                            <h2>Add category</h2>
                            <div id="validation-errors"></div>
                            <p id="msg" class="alert alert-success"></p>
                            <input type="hidden" value="{{csrf_token()}}" id="token"/>

                            <br>
                            @include('admin.partials.validation_errors')
                            <label>Category Name</label>
                            <input type="text" id="category_name" class="form-control"/>

                            <label>Parent id</label>
                            <input type="text" id="parent_id" class="form-control"/>

                            <br>

                            <input type="submit" class="btn btn-success btn-fill" value="Submit" id="btn"/>

                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card">

                        <table class="table table-hover table-striped">
                            <tr>
                                <td colspan="4" style="text-align:right"><b>Total : </b>{{App\Category::count()}}</td>
                            </tr>

                            <tr style="border-bottom: 1px solid #ccc">
                                <th style="padding: 10px">Category Name</th>
                                <th style="padding: 10px">Parent id</th>
                                <th style="padding: 10px">Edit</th>
                                <th style="padding: 10px">Delete</th>
                            </tr>
                        </table>

                        <div class="content" style="height: 400px;overflow-y: scroll">
                            <div id="categories">
                                <img src="{{asset('img/loading.gif')}}" alt="" style="width: 100%;text-align: center">
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

                    var cat_name = $("#category_name").val();
                    var parent_id = $("#parent_id").val();
                    var token = $("#token").val();

                    $.ajax({
                        type: "post",
                        data: "category_name=" + cat_name + '&parent_id=' + parent_id + "&_token=" + token,
                        url: " {{url(route('categories.store'))}} ",
                        success: function (data) {
                                $("#category_name").val('');
                                $("#parent_id").val('');
                                $('#validation-errors').html('');
                                $("#msg").html("category has been created successfully");
                                $("#msg").fadeOut(2000);

                        }, error: function (xhr) {
                            $('#validation-errors').html('');
                            $.each(xhr.responseJSON.errors, function (key, value) {
                                $('#validation-errors').append('<div class="alert alert-danger">' + value + '</div>');
                            });
                        },
                    });
                });


                var auto_refresh = setInterval(
                    function () {
                        $('#categories').load("{{url('admin/categories/show')}}").fadeIn("slow");
                    }, 4000)
            });
        </script>
    @endpush
@endsection
