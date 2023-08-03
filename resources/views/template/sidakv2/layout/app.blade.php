<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <link rel="icon" href="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="theme-color" content="#ff4500">
    <meta name="description" content="Sidak | BKPM">
    
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="csrf-token" content="{{ Session::token() }}"> 
    <title> {{ config('app.name') }} | {{ $title  }}</title>
    <!--  <script type="text/javascript">
        const BASE_URL = window.location.origin;
    </script> -->
    <link rel="icon" type="image/x-icon" href="{{ $template.'/img/faveicon.png' }}">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900%7CMontserrat:300,400,500,600,700,800,900" rel="stylesheet">   
    <link rel="stylesheet" href="{{ $template.'/css/bootstrap.min.css' }}">
    <link rel="stylesheet" href="{{ $template.'/css/font-awesome.min.css' }}">

    <link rel="stylesheet" href="{{ $template.'/css/ionicons.min.css' }}">
    <link rel="stylesheet" href="{{ $template.'/css/AdminLTE.min.css' }}">
    <link rel="stylesheet" href="{{ $template.'/css/_all-skins.min.css' }}">
    <link rel="stylesheet" href="{{ $template.'/css/_all.css' }}">
    <link rel="stylesheet" href="{{ $template.'/css/style.css' }}">
    <link rel="stylesheet" href="{{ $template.'/css/pagination.css' }}">
   <link rel="stylesheet" href="{{ $template.'/css/scrollbar.css' }}">

   
  
   
    </head>

    <body class="hold-transition"> 
    @if (!Auth::guest())
      <div class="wrapper">
        <header class="main-header">
            <a href="#" class="logo">
                <span class="logo-mini">
                    <img src="{{ $sidebar->logo_sm  }}" class="full">
                </span>
                <span class="logo-lg">
                    <img src="{{ $sidebar->logo_lg  }}" class="full">
                </span>
            </a>

            <nav role="navigation" class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <h3 class="pull-left padding-10-0 mgn-none">Data {{ $title  }} </h3> 
                <div class="navbar-custom-menu">
                    <div class="mt-10 mc-15">
                        <button type="button" class="btn btn-primary margin-0-12-0-0 btn-flat border-radius-10">
                            <i aria-hidden="true" class="fa fa-user"></i> Profile
                        </button> 

                        
                        <a href="{{ url('logout') }}" class="btn btn-danger btn-flat border-radius-10">
                            <i aria-hidden="true" class="fa fa-sign-out"></i> Logout
                        </a>
                    </div>
                </div>
            </nav>
        </header>
        @include('template/sidakv2/layout.sidebar')
        <div class="content-wrapper">
            @yield('content')
        </div>
      
      </div>
    @else
    <div class="preloader"><span></span></div><!-- /.preloader -->
    <div class="page-wrapper">      
        @yield('content')
    </div>
    @endif


    <script src="{{ $template.'/js/jquery.min.js' }}"></script>
    <script src="{{ $template.'/js/adminlte.min.js' }}"></script>
    <script src="{{ $template.'/js/bootstrap.min.js' }}"></script>
    <script src="{{ $template.'/js/icheck.min.js' }}"></script>
    <script src="{{ $template.'/js/icheck.js' }}"></script>
    <script src="{{ $template.'/js/dynemicbody.js' }}"></script> 
    <script src="{{ $template.'/js/scrollbar.js' }}"></script>
   

      </body>      
</html>
