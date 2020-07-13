@extends('admin.layout.app')
@section('title', 'Change image')


@section('content')
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('#msg').hide();--}}

{{--            $('#btn').click(function () {--}}
{{--                $('#msg').show();--}}

{{--                var pro_image = $('#image').val();--}}
{{--                var token = $('#token').val();--}}

{{--                $.ajax({--}}
{{--                    "type": "post",--}}
{{--                    "url": "{{route('upload-image')}}",--}}
{{--                    "data": "product_image" + pro_image + "&_token=" + token,--}}
{{--                    success: function (data) {--}}
{{--                        $('#msg').html('Image has been updated successfully')--}}
{{--                        $('#msg').fadeOut(2000)--}}


{{--                    }--}}
{{--                });--}}
{{--            });--}}


{{--        })--}}
{{--    </script>--}}


    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">

                        <div class="content">
                            <h2>Change image</h2>
                            <form action="{{url(route('upload-image'))}}" enctype="multipart/form-data" method="post">
                                @include('admin.partials.validation_errors')
                                {{csrf_field()}}

                                <input type="text" value="{{request()->route('id')}}" name="id" class="form-control">

                                <input type="file" name="image">
                                <br>
                                <input type="submit" value="submit" class="btn btn-fill btn-success ">
                            </form>
                            <div class="footer">
                                <p>hasellus non imperdiet sem, vel posuere tellus</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">

                        <div class="content">
                            <p> Fusce quis dictum erat, ornare mattis quam. Pellentesque eget ipsum hendrerit, feugiat risus lacinia, accumsan eros. In fringilla volutpat elementum. Integer volutpat ex ut pharetra auctor. Vivamus turpis arcu, sollicitudin id est nec, imperdiet consectetur sapien. Integer quis volutpat velit, id auctor leo</p>
                            <div class="footer">
                                <p>Donec congue eleifend sapien, in molestie diam vulputate sit amet</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>


@endsection
