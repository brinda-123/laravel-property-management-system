@php
$setting = App\Models\SiteSetting::find(1);
@endphp


@php
$isMainIndexPage = Request::url() == url('/');
@endphp

@if($isMainIndexPage)
<header class="main-header header-style-two">
    @else
    <header class="main-header">
        @endif


    <div class="header-top">
        <div class="top-inner clearfix">
            <div class="left-column pull-left">
                <ul class="info clearfix">
                    <li><i class="far fa-map-marker-alt"></i>{{ $setting->company_address }}</li>
                    <li><i class="far fa-clock"></i>Mon - Sat 9.00 - 18.00</li>
                    <li><i class="far fa-phone"></i>+919925792715</li>
                </ul>
            </div>
            <div class="right-column pull-right">
                <ul class="social-links clearfix">
                    <li><a href="{{ $setting->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="{{ $setting->twitter }}"><i class="fab fa-twitter"></i></a></li>
                </ul>

                @auth

                <div class="sign-box">
                    <a href="{{ route('dashboard') }}"><i class="fas fa-user"></i> Dashboard</a>
                    &nbsp;|&nbsp;
                    <a href="{{ route('user.logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>


                @else

                <div class="sign-box">
                    <a href="{{ route('login') }}"><i class="fas fa-user"></i>Sign In</a>
                </div>

                @endauth



            </div>
        </div>
    </div>
    <!-- header-lower -->
    <div class="header-lower">
        <div class="outer-box">
            <div class="main-box">
                <div class="logo-box">
                    <figure class="logo"><a href="{{ url('/') }}"><img src="{{ asset($setting->logo) }}" alt=""></a></figure>
                </div>
                <div class="menu-area clearfix">
                    <!--Mobile Navigation Toggler-->
                    <div class="mobile-nav-toggler">
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                    </div>
                    <nav class="main-menu navbar-expand-md navbar-light">
                        <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix">

                                <li><a href="{{ url('/') }}"><span>Home</span></a> </li>
                                <li><a href="{{ route('aboutus') }}"><span>About Us </span></a> </li>

                                <li class="dropdown"><a href="{{ route('front.all.property') }}"><span>Property</span></a>
                                    <ul>
                                        <!-- <li><a href="{{ route('rent.property') }}">Rent Property</a></li> -->
                                        <li><a href="{{ route('buy.property') }}">Buy Property </a></li>

                                    </ul>
                                </li>
                                <li><a href="#agent-team"><span>Agent </span></a> </li>

                                <li><a href="{{ route('seller.register') }}"><span>Seller </span></a> </li>


                                <li><a href="{{ route('contactus') }}"><span>Contact</span></a></li>

                                <li>
                                    <a href="{{ route('agent.login') }}" class="btn btn-success"><span>+</span>Add Listing</a>
                                </li>


                            </ul>
                        </div>
                    </nav>
                </div>
                <!-- <div class="btn-box">
                    <a href="{{ route('agent.login') }}" class="theme-btn btn-one"><span>+</span>Add Listing</a>
                </div> -->
            </div>
        </div>
    </div>

    <!--sticky Header-->
    <div class="sticky-header">
        <div class="outer-box">
            <div class="main-box">
                <div class="logo-box">
                    <figure class="logo"><a href="{{ url('/') }}"><img src="{{ asset($setting->logo) }}" alt=""></a></figure>
                </div>
                <div class="menu-area clearfix">
                    <nav class="main-menu clearfix">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav>
                </div>
                <!-- <div class="btn-box">
                    <a href="{{ route('agent.login') }}" class="theme-btn btn-one"><span>+</span>Add Listing</a>
                </div> -->
            </div>
        </div>
    </div>
</header>