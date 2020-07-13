@extends('admin.layout.app')
@section('title', 'Users')

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">

                        <div class="content">
                            <h2>Users</h2>
                            <p>Etiam et tellus sem. Etiam blandit sollicitudin lectus vitae faucibus. Donec et massa
                                fringilla.</p>
                            <div class="footer">
                                <p>hasellus non imperdiet sem, vel posuere tellus</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">

                        <div class="content">
                            <table style="width:100%" class="table table-hover table-striped">
                                <tr>
                                    <th>#</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">E-mail</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Login</th>
                                </tr>
                                @foreach($records as $record)
                                    <tr>
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td class="text-center">{{$record->name}}</td>
                                        <td class="text-center">{{$record->email}}</td>
                                        <td class="text-center">{{$record->role}}</td>
                                        <td class="text-center">@if($record->status == 0)
                                                <b style="color: green">enabled</b>
                                            @else
                                                <b style="color: red">disabled</b>
                                            @endif
                                            <br>
                                            <button id="showSelectDiv{{$record->id}}" class="btn btn-primary btn-fill">
                                                Change Status</button>
                                            <div id="selectDiv{{$record->id}}">
                                                <input type="hidden" id="userId{{$record->id}}" value="{{$record->id}}">
                                                <select id="loginStatus{{$record->id}}" class="form-control">
                                                    <option value="">Select a status</option>
                                                    <option value="0">enabled</option>
                                                    <option value="1">disabled</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td class="text-center"><a href="" class="btn btn-fill btn-success">Actions</a>
                                        </td>

                                    </tr>
                                @endforeach
                            </table>
                            <div class="footer">
                                <p>Donec congue eleifend sapien, in molestie diam vulputate sit amet</p>
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

                @foreach($records as $user)
                $('#selectDiv{{$user->id}}').hide();
                $('#showSelectDiv{{$user->id}}').click(function () {
                    $('#selectDiv{{$user->id}}').show();
                });
                $("#loginStatus{{$user->id}}").change(function () {
                    var status = $('#loginStatus{{$user->id}}').val();
                    var userId = $('#userId{{$user->id}}').val();
                    if (status == "") {
                        alert('please select a status');
                    } else {
                        $.ajax({
                            url: '{{route('change-status')}}',
                            type: 'get',
                            data: 'status=' + status + '&userId=' + userId,
                            success: function (response) {
                                console.log(response);

                            }
                        });
                    }


                });
                @endforeach
            });
        </script>


    @endpush

@endsection
