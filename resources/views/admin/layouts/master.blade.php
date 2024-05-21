<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>@yield('title')</title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('admin/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


    <!-- Vendor CSS-->
    <link href="{{ asset('admin/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/') }}vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('admin/css/theme.css') }}" rel="stylesheet" media="all">

    {{-- font awesome  --}}
    <script src="https://kit.fontawesome.com/17730cb0db.js" crossorigin="anonymous"></script>

</head>

<body class="animsition">
    <!-- MENU SIDEBAR-->
    <aside class="menu-sidebar d-none d-lg-block">
        <div class="logo">
            <a href="#" class="navbar-brand">
                <img src="{{ asset('admin/images/icon/logo.png') }}" alt="Cool Admin" />
            </a>
        </div>
        <div class="menu-sidebar__content js-scrollbar1">
            <nav class="navbar-sidebar">
                <ul class="list-unstyled navbar__list tabs">
                    <li class="active has-sub tab1" onclick="tab1">
                        <a class="js-arrow nav-link" href="{{ route('category#list') }}">
                            <i class="fas fa-chart-bar"></i>Category
                        </a>

                    </li>
                    <li class="nav-link tab2" onclick="tab2">
                        <a class="js-arrow nav-link"  href="{{ route('product#list') }}">
                            <i class="fa-solid fa-pizza-slice"></i>Product
                        </a>
                    </li>

                    <li class="nav-link tab3" onclick="tab3">
                        <a class="js-arrow nav-link"  href="{{ route('order#list') }}">
                            <i class="fas fa-chart-bar"></i>Order
                        </a>
                    </li>

                    <li class="nav-link tab5" onclick="tab4">
                        <a class="js-arrow nav-link"  href="{{ route('admin#userList') }}">
                            <i class="fa-solid fa-users"></i>User List
                        </a>
                    </li>

                    <li class="nav-link tab5" onclick="tab5">
                        <a class="js-arrow nav-link"  href="{{ route('admin#inbox') }}">
                            <i class="fa-solid fa-envelope"></i>Inbox
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
    <!-- END MENU SIDEBAR-->

     <!-- HEADER DESKTOP-->
     <header class="header-desktop">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="header-wrap">
                    <h3 class="mb-2">Admin Dashboard</h3>

                    <div class="header-button">
                        <div class="noti-wrap">
                            <div class="noti__item js-item-menu">
                                <i class="zmdi zmdi-notifications"></i>
                                <span class="quantity"></span>
                                <div class="notifi-dropdown js-dropdown">
                                    <div class="notifi__title">
                                        <p>You have Notifications</p>
                                    </div>
                                    <div class="notifi__item">
                                        <div class="bg-c1 img-cir img-40">
                                            <i class="zmdi zmdi-email-open"></i>
                                        </div>
                                        <div class="content">
                                            <p>You got email notification</p>
                                            <span class="date">April 12, 2018 06:50</span>
                                        </div>
                                    </div>

                                    <div class="notifi__footer">
                                        <a href="{{ route('admin#inbox') }}">All notifications</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="account-wrap">
                            <div class="account-item clearfix js-item-menu">
                                <div class="image">
                                    @if ( Auth::user()->image == null)
                                    <img src="{{ asset('admin/images/profile.png') }}" >
                                  @else
                                    <img src="{{ asset('storage/' .Auth::user()->image ) }}"/>
                                  @endif
                                </div>
                                <div class="content">
                                    <a class="js-acc-btn nav-link" href="#">{{ Auth::user()->name }}</a>
                                </div>
                                <div class="account-dropdown js-dropdown">
                                    <div class="info clearfix">
                                        <div class="image">
                                            <a href="#" >
                                                @if ( Auth::user()->image == null)
                                                <img src="{{ asset('admin/images/profile.png') }}" >
                                              @else
                                                <img src="{{ asset('storage/' .Auth::user()->image ) }}"/>
                                              @endif
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h5 class="name">
                                                <a href="#" class="nav-link">{{ Auth::user()->name }}</a>
                                            </h5>
                                            <span class="email">{{ Auth::user()->email }}</span>
                                            <span class="email">{{ Auth::user()->role }}</span>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="{{ route('admin#account') }}" class="nav-link">
                                                <i class="zmdi zmdi-account"></i>Account</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="{{ route('admin#password') }}" class="nav-link">
                                                <i class="fa-solid fa-key"></i>Password</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="{{ route('admin#list') }}" class="nav-link">
                                                <i class="zmdi zmdi-accounts"></i>Admin List</a>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__footer my-3 d-flex justify-content-center">
                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf

                                            <button class="btn btn-dark" type="submit"><i class="fa-solid fa-right-from-bracket"></i>Logout</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- HEADER DESKTOP-->
     @yield('content')

    <!-- Jquery JS-->
    <script src="{{ asset('admin/vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('admin/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Vendor JS       -->
    <script src="{{ asset('admin/vendor/slick/slick.min.js') }}">
    </script>
    <script src="{{ asset('admin/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
    </script>
    <script src="{{ asset('admin/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/counter-up/jquery.counterup.min.js') }}">
    </script>
    <script src="{{ asset('admin/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/select2/select2.min.js') }}">
    </script>

    <!-- Main JS-->
    <script src="{{ asset('admin/js/main.js') }}"></script>

    {{-- jquery cdn  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</body>
    @yield('scriptSource')
</html>
<!-- end document-->
