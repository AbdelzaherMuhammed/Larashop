<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="{{asset('admin/assets/img/favicon.ico')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <title>@yield('title')</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Bootstrap core CSS     -->
    <link href="{{asset('admin/assets/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <!-- Animation library for notifications   -->
    <link href="{{asset('admin/assets/css/bootstrap.min.css')}}" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="{{asset('admin/assets/css/light-bootstrap-dashboard.css')}}" rel="stylesheet"/>

    <!--     Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="{{asset('admin/assets/css/pe-icon-7-stroke.css')}}" rel="stylesheet"/>

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="{{asset('admin/assets/img/sidebar-5.jpg')}}">

        <!--

            Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
            Tip 2: you can also add an image using data-image tag

        -->

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="{{url('admin/home')}}" class="simple-text">
                    Larashop
                </a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="{{url('admin/home')}}">
                        <i class="pe-7s-graph"></i>
                        <p>Home</p>
                    </a>
                </li>

                <li>
                    <a href="{{url('admin/profile')}}">
                        <i class="fa fa-user"></i>
                        <p>Profile</p>
                    </a>
                </li>

                <li>
                    <a href="{{url(route('products.create'))}}">
                        <i class=" fa fa-list"></i>
                        <p>Products</p>
                    </a>
                </li>

                <li>
                    <a href="{{url(route('categories.create'))}}">
                        <i class="fa fa fa-sitemap"></i>
                        <p>Categories</p>
                    </a>
                </li>

                <li>
                    <a href="{{url('admin/orders')}}">
                        <i class="fa fa-shopping-cart"></i>
                        <p>Orders</p>
                    </a>
                </li>

                <li>
                    <a href="{{url(route('users.index'))}}">
                        <i class="fa fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>

            </ul>

        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                </div>

                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-dashboard"></i>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="">
                                Account
                            </a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">

                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" dir="rtl" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        @yield('content')
        {{--        <div class="content">--}}
        {{--            <div class="container-fluid">--}}
        {{--                <div class="row">--}}

        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>

                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy;
                    <script>document.write(new Date().getFullYear())</script>
                    <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                </p>
            </div>
        </footer>

    </div>
</div>


</body>

<!--   Core JS Files   -->
<script src="{{asset('admin/assets/js/jquery-1.10.2.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/assets/js/bootstrap.min.js')}}" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="{{asset('admin/assets/js/bootstrap-checkbox-radio-switch.js')}}"></script>

<!--  Charts Plugin -->
<script src="{{asset('admin/assets/js/chartist.min.js')}}"></script>

<!--  Notifications Plugin    -->
<script src="{{asset('admin/assets/js/bootstrap-notify.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<!--  Google Maps Plugin    -->


<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="{{asset('admin/assets/js/light-bootstrap-dashboard.js')}}"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="{{asset('admin/assets/js/demo.js')}}"></script>

@stack('scripts')
</html>
