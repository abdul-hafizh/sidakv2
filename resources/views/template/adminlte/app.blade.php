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
     <script type="text/javascript">
        const BASE_URL = window.location.origin;
    </script>

    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900%7CMontserrat:300,400,500,600,700,800,900" rel="stylesheet">   
    <link rel="stylesheet" href="{{ mix('/vue/css/bundle.css') }}">
   
    </head>

    <body > 

    

    <div class="preloader"><span></span></div><!-- /.preloader -->
    <div class="page-wrapper">      
        @yield('content')
    </div>



     <script type="text/javascript" src="{{ mix('/vue/js/index.js') }}"></script>
     <script type="text/javascript" src="{{ mix('/vue/js/bundle.js') }}"></script> 
     
   

      </body>      
</html>
