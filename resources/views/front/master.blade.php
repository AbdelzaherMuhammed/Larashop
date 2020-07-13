<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>LaraShop 55</title>
    <link type="text/css" href="{{asset('/')}}" rel="stylesheet"/>
    <link type="text/css" href="{{asset('theme/fonts/fontawesome-webfont.woff')}}" rel="stylesheet"/>

    <link type="text/css" href="{{asset('theme/css/font-awesome.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('theme/bootstrap/dist/css/bootstrap.min.css')}}">
    <link type="text/css" href="{{asset('theme/css/style.css')}}" rel="stylesheet"/>
    <script type="text/javascript" src="{{asset('theme/js/jquery-1.11.3.js')}}"></script>


    <style>
        ol.progtrckr {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        ol.progtrckr li {
            display: inline-block;
            text-align: center;
            line-height: 3.5em;
        }

        ol.progtrckr[data-progtrckr-steps="2"] li {
            width: 49%;
        }

        ol.progtrckr[data-progtrckr-steps="3"] li {
            width: 33%;
        }

        ol.progtrckr[data-progtrckr-steps="4"] li {
            width: 24%;
        }

        ol.progtrckr[data-progtrckr-steps="5"] li {
            width: 19%;
        }

        ol.progtrckr[data-progtrckr-steps="6"] li {
            width: 16%;
        }

        ol.progtrckr[data-progtrckr-steps="7"] li {
            width: 14%;
        }

        ol.progtrckr[data-progtrckr-steps="8"] li {
            width: 12%;
        }

        ol.progtrckr[data-progtrckr-steps="9"] li {
            width: 11%;
        }

        ol.progtrckr li.progtrckr-done {
            color: black;
            border-bottom: 4px solid yellowgreen;
        }

        ol.progtrckr li.progtrckr-todo {
            color: silver;
            border-bottom: 4px solid silver;
        }

        ol.progtrckr li:after {
            content: "\00a0\00a0";
        }

        ol.progtrckr li:before {
            position: relative;
            bottom: -2.5em;
            float: left;
            left: 50%;
            line-height: 1em;
        }

        ol.progtrckr li.progtrckr-done:before {
            content: "\2713";
            color: white;
            background-color: yellowgreen;
            height: 2.2em;
            width: 2.2em;
            line-height: 2.2em;
            border: none;
            border-radius: 2.2em;
        }

        ol.progtrckr li.progtrckr-todo:before {
            content: "\039F";
            color: silver;
            background-color: white;
            font-size: 2.2em;
            bottom: -1.2em;
        }


        .greyBg {
            margin-top: 20px
        }

        .inner_msg {
            clear: both;
            padding: 10px;
            margin: 0 auto;
            width: 99%;
            background-color: #efefef;
            border: 1px solid #ccc;
            min-height: 150px;
        }

        .inner_msg p {
            color: #000;
            font-size: 15px;
            text-align: center;

        }

        .list option {
            margin-top: 10px
        }

        .inboxMain {
            min-height: 400px;
            background-color: #fff;
            padding: 10px;
            border: 1px solid #ccc
        }

        .inboxRow {
            border-bottom: 1px solid #ccc;
            padding: 10px
        }

    </style>
</head>
<body>
<header id="header" class="hidden-xs">
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="tollNum">Tollfree : 888 888 8888</div>
                </div>
                <div class="col-sm-6">

                    <div class="account-link ">

                        <ul>
                            @if(auth()->check())
                                <li><a href="{{url('/inbox')}}">INBOX(0)</a></li>
                                <li><a href="{{url('/myaccount')}}">MY ACCOUNT</a></li>
                                <li>

                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('LOGOUT') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>

                                </li>
                                </li>
                            @else
                                <li><a href="{{url('/login')}}">LOGIN</a></li>
                            @endif
                            <li><a onclick="javascript:showDiv('slidingDiv');"
                                   href="javascript:">SEARCH</a>
                                <div id="slidingDiv" class="srchBox">
                                    <form action="{{url('search')}}">
                                        <input type="text" name="searchData"/>
                                        <i class="fa fa-search"></i>
                                    </form>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">

            <div class="col-sm-8">
                <div class="nav-link">
                    <div style="text-align: center;position:absolute;left:550px;top: 3px">
                        <ul>
                            <li><a href="{{url('/products')}}">Products</a>
                                <ul class="dropdown">

                                    @inject('categories' , 'App\Category')

                                    @foreach($categories->with('childs')->where('parent_id' , 0)->get() as $item)

                                        @if($item->childs()->count() >0)
                                            <li>
                                                <a href="{{url('products')}}/{{$item->category_name}}">
                                                    <h4>{{$item->category_name}}</h4></a>
                                                @foreach($item->childs as $subMenu)
                                                    <ul>
                                                        <li>
                                                            <a href="{{url('products')}}/{{$subMenu->category_name}}">
                                                                {{$subMenu->category_name}}</a>
                                                        </li>
                                                    </ul>
                                                @endforeach
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{url('products')}}/{{$item->category_name}}">
                                                    <h4>{{$item->category_name}}</h4></a>
                                            </li>

                                        @endif
                                    @endforeach
                                </ul>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="nav-btns">
                    <div class="nav-cart" style="position: absolute;left: 250px;width: 120px;top: 8px">
                        <a href="{{url('cart')}}"><img src="{{asset('theme/images/cart.png')}}"/>
                            CART({{Cart::count()}})
                        </a>
                    </div>
                </div>
            </div>
            <div style="height: 50px"></div>
            <div class="nav-toggle">
                <div class="icon-menu"><span class="line line-1"></span> <span class="line line-2"></span> <span
                        class="line line-3"></span></div>
            </div>
            <div style="margin-top: -45px " class="logo "><a href="{{url('/')}}"><img
                    src="{{asset('theme/images/logo.jpg')}}" alt=""/></a></div>
        </div>

    </div>
</header>
@yield('content')

<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="col-sm-3 col-lg-3 hidden-xs">
                    <h5>More Info</h5>
                    <div class="ft-link">
                        <ul>
                            <li><a href="#">Bulk Buying</a></li>
                            <li><a href="#">Faq's</a></li>
                            <li><a href="#">Testimonials</a></li>
                            <li><a href="#">Shipping Policy</a></li>
                            <li><a href="#">Return Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3 col-lg-3 hidden-xs">
                    <h5>Resources</h5>
                    <div class="ft-link">
                        <ul>
                            <li><a href="#">Ayurvedic Doshas</a></li>
                            <li><a href="#">Gluten Allergy</a></li>
                            <li><a href="#">Ayurvedic Diet</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-5 col-lg-4">
                    <h5>Newsletter</h5>
                    <div class="newsletter">
                        <p>Sign up for email to get the latest updates &amp; more.</p>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="enter your email...">
                            <span class="input-group-btn">
                <input type="submit" class="btn btn-default" type="button" Value="Subscribe"/>
              </span>
                        </div>
                        <ul class="social">
                            <li><a target="_blank" href="{{$settings->facebook_link}}" class="facebook"><i class="fa fa-facebook"></i></a></li>
                            <li><a target="_blank" href="{{$settings->twitter_link}}" class="twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a target="_blank" href="{{$settings->instagram_link}}" class="instagram"><i class="fa fa-instagram"></i></a></li>
                            <li><a target="_blank" href="{{$settings->github_link}}" class="github"><i class="fa fa-github"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="copyrt">
                    &copy; 2017 LaraShop55. All Rights Reserved. <a href="terms-conditions.php">Terms &amp;
                        Conditions</a>
                </div>
            </div>
        </div>
    </div>
</footer>
<script type="text/javascript" src="{{asset('theme/js/html5.js')}}"></script>
<script type="text/javascript" src="{{asset('theme/js/bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('theme/js/multiple-accordion.js')}}"></script>
<script type="text/javascript" src="{{asset('theme/js/jquery.nice-select.js')}}"></script>
<script type="text/javascript" src="{{asset('theme/js/jquery.bootstrap-responsive-tabs.js')}}"></script>
<script>
    $(function () {
        var html = $('html, body'),
            navContainer = $('.nav-container'),
            navToggle = $('.nav-toggle'),
            navDropdownToggle = $('.has-dropdown');
        // Nav toggle
        navToggle.on('click', function (e) {
            var $this = $(this);
            e.preventDefault();
            $this.toggleClass('is-active');
            navContainer.toggleClass('is-visible');
            html.toggleClass('nav-open');
        });
    });
</script>
<script language="JavaScript">
    $(document).ready(function () {
        $(".topnav").accordion({
            accordion: false,
            speed: 500,
            closedSign: '+',
            openedSign: '-'
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {

        $('select').niceSelect();
        //  FastClick.attach(document.body);
    });
</script>
<script>
    $('.responsive-tabs').responsiveTabs({
        accordionOn: ['xs', 'sm']
    });
</script>
<script type="text/javascript">
    function showDiv(divname) {
        closealldivs(divname);
        $("#" + divname).slideToggle();
    }

    function closeMe(trgt) {
        $("#slidingDiv" + trgt).toggle();
    }

    function closealldivs(divname) {
        for (var i = 1; i <= 3; i++) {
            var abc = "slidingDiv" + i;
            if (divname != abc) {
                $("#slidingDiv" + i).hide();
            }
        }
    }
</script>
<script type="text/javascript">
    $('#myTabs a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    })
</script>
@stack('scripts')
</body>
