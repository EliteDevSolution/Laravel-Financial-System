<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" 
        content="width=device-width, 
        initial-scale=1.0, 
        user-scalable=no" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>KSBIN Clients</title>
        <!-- Scripts -->
        {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <!-- Styles -->
        {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css"> --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
        <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
        <link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}">
        <link rel="stylesheet" href="{{ asset('css/responsive.bootstrap.css') }}">
        
        @yield('pdf-js')
        @yield('touch-punch')
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.20/r-2.2.3/datatables.min.css"/>
        
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        
        <script>
            // if (screen.width <= 425) {
            //      document.location = "/under-maintenance";
            // }
        </script>
        @yield('screenshot')
        <style>
            .dataTables_wrapper .dataTables_filter input {
                border: none;
                border: 1px solid #bfbfbf;
                border-radius: 15px;
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-dark bg-white shadow">
                <div class="container">
                    
                    <a class="navbar-brand" href="{{ url('/') }}">
                        K.S. BILLING & ASSOCIATES INC.
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                        </ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif
                            @else
                            @if (Route::currentRouteName() != 'user.edit')
                                {{-- expr --}}
                            
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-capitalize" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item border-bottom" href="/">My Account</a>
                                    <a class="dropdown-item border-bottom" href="{{ route('user.edit', Auth::user()->id) }}">Change Password</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                            @else

                                <li class="nav-item">
                                    <a class="nav-link" href="/">Return</a>
                                </li>

                            @endif
                            
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <a href="{{ route('userInvoices') }}" class="{{ Route::currentRouteName() == 'userInvoices' ? 'active-link' : '' }}">My Invoices</a>
                <a href="{{ route('userContracts') }}" class="{{ Route::currentRouteName() == 'userContracts' ? 'active-link' : '' }}">My Contracts</a>
            </div>
            <main class="p-0 m-0">
                @yield('content')
            </main>
            <footer class="mainfooter" role="contentinfo">
                <div class="footer-middle">
                    <div class="container">
                        
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-center">&copy; Copyright <?php echo date('Y'); ?> - KS Billing & Associates Inc.  All rights reserved.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <script>
        function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        }
        function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        }
        </script>
        <script src="{{ asset('js/sweet-alert.js') }}"></script>
        <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
        <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        {{-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script> --}}
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.20/r-2.2.3/datatables.min.js"></script>
        <script src="{{ asset('js/slick.min.js') }}"></script>
        @yield('signTemplate')
        @yield('theLoaderScript')
        <script>
            
            jQuery(document).ready(function($){
                
                
                
                $('.testimonials').slick({
                slidesToShow: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                });
                $('#user-contract').DataTable({
                    responsive: true,
                });
                $('#user-invoice').DataTable({
                    responsive: true,
                });
                $('#user-uploads').DataTable({
                    responsive: true,
                });
                $('#user-attachments').DataTable({
                    responsive: true,
                });
                
                window.setInterval(function(){
                    var table = $("#user-attachments").DataTable();
                    $("#user-attachments").css( 'display', 'table' );
                    table.responsive.recalc();
                    
                    var table2 = $("#user-invoice").DataTable();
                    $("#user-invoice").css( 'display', 'table' );
                    table2.responsive.recalc();
                    
                    var table3 = $("#user-uploads").DataTable();
                    $("#user-uploads").css( 'display', 'table' );
                    table3.responsive.recalc();
                }, 1000);
                
            });
            
            
            
            
        </script>
        <script src="{{ asset('js/wow.min.js') }}"></script>
        <script>
        new WOW().init();
        </script>
    </body>
</html>