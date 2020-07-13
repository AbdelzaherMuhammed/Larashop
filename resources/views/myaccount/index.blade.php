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
                                    <a href="{{url('/home')}}"> {{auth()->user()->name}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row top25">
                    <div class="panel panel-body">
                        <div class="prod"><h2 align="left" class="prod">My Account</h2></div>


                        <div class="panel-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif


                            @if(isset($link))
                                <div class="myContent">
                                    <ul class="nav nav-tabs">
                                        @if($link == 'profile')
                                            <li class="active"><a href="#profile" data-toggle="tab">My Profile</a></li>
                                            <li><a href="#myOrders" data-toggle="tab">My Orders</a></li>
                                            <li><a href="#changePassword" data-toggle="tab">Change Password</a></li>

                                        @elseif($link == 'myOrders')
                                            <li><a href="#profile" data-toggle="tab">My Profile</a></li>
                                            <li class="active"><a href="#myOrders" data-toggle="tab">My Orders</a></li>
                                            <li><a href="#changePassword" data-toggle="tab">Change Password</a></li>

                                        @elseif($link == 'changePassword')
                                            <li><a href="#profile" data-toggle="tab">My Profile</a></li>
                                            <li><a href="#myOrders" data-toggle="tab">My Orders</a></li>
                                            <li class="active"><a href="#changePassword" data-toggle="tab">Change
                                                    Password</a></li>

                                        @else
                                            something else

                                        @endif
                                    </ul>

                                    <div class="tab-content col-md-8">
                                        <div id="profile" class="tab-pane fade in active">
                                            Your {{$link}} data
                                        </div>

                                        <div id="myOrders" class="tab-pane fade in">
                                            My orders tab
                                        </div>

                                        <div id="changePassword" class="tab-pane fade in">
                                            Change Password tab
                                        </div>

                                    </div>
                                </div>
                            @else
                                <div class="myContent">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#profile" data-toggle="tab">My Profile</a></li>
                                        <li><a href="#myOrders" data-toggle="tab">My Orders</a></li>
                                        <li><a href="#changePassword" data-toggle="tab">Change Password</a></li>
                                    </ul>

                                    <div class="tab-content col-md-8">
                                        <div id="profile" class="tab-pane fade in active">
                                            @include('admin.partials.validation_errors')
                                            @include('flash::message')
                                            <form action="{{url(route('save-address' ,auth()->user()->id))}}" method="post" class="form-group">
                                                <input type="hidden" name="_method" value="put">
                                                {!! csrf_field() !!}
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" name="name"
                                                       value="{{auth()->user()->name}}">
                                                <br>
                                                <label for="email">Email</label>
                                                <input type="text" class="form-control" name="email"
                                                       value="{{auth()->user()->email}}"
                                                       readonly style="background-color: #cfcfcf">
                                                <br>
                                                <label for="city">City</label>
                                                <input type="text" class="form-control" name="city" value="">
                                                <br>
                                                <label for="county">Country</label>
                                                <input type="text" class="form-control" name="country" value="">
                                                <br>
                                                <label for="phone_number">phone Number</label>
                                                <input type="text" class="form-control" name="phone" value="">
                                                <br>
                                                <input type="submit" class="btn btn-primary" value="Update">
                                            </form>
                                        </div>

                                        <div id="myOrders" class="tab-pane fade in"
                                             style="height:400px; overflow-x:scroll">

                                            @foreach(App\order::where('user_id',auth()->user()->id)->orderBY('created_at','DESC')->get() as $records)
                                                <div class="row">
                                                    <p class="alert-info col-md-12">{{date('D, d F Y, h:i', strtotime($records->created_at))}}</p>
                                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                                        <img
                                                            src="{{asset('images/NoImageAvailable.jpg')}}"
                                                            width="100px"/>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                                        <h4> {{$records->status}}</h4>
                                                        <h5> $ {{$records->total}}</h5>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-xs-4" style="margin-top:10px">
                                                        <a href="{{url('order-details')}}/{{$records->id}}"
                                                           class="btn"><i class="fa fa-list"></i> Order Details</a>
                                                        <br><br>
                                                        <a href="{{url('track-order')}}/{{$records->id}}" class="btn"><i
                                                                class="fa fa-map-marker"></i> Track Order</a>
                                                    </div>
                                                </div>
                                                <hr>
                                            @endforeach
                                        </div>

                                        <div id="changePassword" class="tab-pane fade in">
                                            @include('admin.partials.validation_errors')
                                            <form action="{{url(route('update-password'))}}" method="post" class="form-group">
                                                {!! csrf_field() !!}
                                                <label for="name">Current Password</label>
                                                <input type="password" class="form-control" name="current_password">
                                                <br>
                                                <label for="email">Password</label>
                                                <input type="password" class="form-control" name="new_password">
                                                <br>
                                                <label for="email">Confirm password</label>
                                                <input type="password" class="form-control" name="new_password_confirmation">
                                                <br>
                                                <input type="submit" class="btn btn-primary" value="Update">
                                        </div>

                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
