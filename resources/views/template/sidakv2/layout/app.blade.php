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
    <link rel="icon" type="image/x-icon" href="{{ config('app.url').$template.'/img/fave-icon.png' }}">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900%7CMontserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ config('app.url').$template.'/css/bootstrap.min.css' }}">
    <link rel="stylesheet" href="{{ config('app.url').$template.'/css/font-awesome.min.css' }}">

    <link rel="stylesheet" href="{{ config('app.url').$template.'/css/ionicons.min.css' }}">
    <link rel="stylesheet" href="{{ config('app.url').$template.'/css/AdminLTE.min.css' }}">
    <link rel="stylesheet" href="{{ config('app.url').$template.'/css/_all-skins.min.css' }}">
    <link rel="stylesheet" href="{{ config('app.url').$template.'/css/_all.css' }}">
    <link rel="stylesheet" href="{{ config('app.url').$template.'/css/style.css' }}">
    <link rel="stylesheet" href="{{ config('app.url').$template.'/css/pagination.css' }}">
    <link href="{{ config('app.url').$template.'/css/scrollbar.css' }}">
    <link rel="stylesheet" href="{{ config('app.url').$template.'/plugin/select2/css/select2.min.css' }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ config('app.url').$template.'/plugin/selectpicker/css/bootstrap-select.min.css' }}">
    <link rel="stylesheet" href="{{ config('app.url').$template.'/css/sweetalert2.min.css'}}">
    <link rel="stylesheet" href="{{ config('app.url').$template.'/css/menu.css'}}">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <script src="{{ config('app.url').$template.'/js/jquery.min.js' }}"></script>

<body class="hold-transition ">

    @if (!Auth::guest())
    <div class="wrapper">
        <header class="main-header">
            <a href="#" class="logo">
                <span class="logo-mini"></span>
                <span class="logo-lg"></span>
            </a>

            <nav role="navigation" class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <h3 class="pull-left padding-10-0 mgn-none text-capitalize">{{ $title  }} </h3>
                <div class="navbar-custom-menu mt-10 mc-15">




                    <ul class="nav navbar-nav">
                        <li class="dropdown messages-menu">
                            <a id="update-notif" data-toggle="dropdown" class="btn btn-danger margin-0-12-0-0  border-radius-10" aria-expanded="false">
                                <i aria-hidden="true" class="fa fa-bell"></i>
                                <span id="total-notif" class="label label-black"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li id="total-notif-all" class="header"></li>
                                <li>
                                    <ul id="menu-notif" class="menu"></ul>
                                </li>

                                <li class="footer"><a href="{{ url('notification') }}">See All Messages</a></li>
                            </ul>
                        </li>
                        <li>
                            <a data-toggle="modal" data-target="#modal-profile-x" class="btn btn-primary margin-0-12-0-0  border-radius-10">
                                <i aria-hidden="true" class="fa fa-user"></i> Profile
                            </a>


                        </li>

                        <li>
                            <a href="{{ url('logout') }}" class="btn btn-danger  border-radius-10">
                                <i aria-hidden="true" class="fa fa-sign-out"></i> Logout
                            </a>

                        </li>
                    </ul>





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


    <script src="{{ config('app.url').$template.'/js/sweetalert2.min.js' }}"></script>
    <script src="{{ config('app.url').$template.'/js/adminlte.min.js' }}"></script>
    <script src="{{ config('app.url').$template.'/js/bootstrap.min.js' }}"></script>
    <script src="{{ config('app.url').$template.'/js/icheck.min.js' }}"></script>
    <script src="{{ config('app.url').$template.'/js/icheck.js' }}"></script>
    <script src="{{ config('app.url').$template.'/js/dynemicbody.js' }}"></script>
    <script src="{{ config('app.url').$template.'/js/dynemicbody.js' }}"></script>
    <script src="{{ config('app.url').$template.'/js/slimscroll.min.js' }}"></script>
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
    <script src="{{ config('app.url').$template.'/plugin/select2/js/select2.min.js' }}"></script>
    <script src="{{ config('app.url').$template.'/plugin/selectpicker/js/bootstrap-select.min.js' }}"></script>
    <script src="{{ config('app.url').$template.'/js/accounting.min.js' }}"></script>
    <script src="{{ config('app.url').$template.'/js/xlsx.full.min.js' }}"></script>

   

    <script>
        $(function() {

                $('[data-toggle="tooltip"]').tooltip();

                $("#update-notif").click(() => {
                    UpdateData();
                });






            //getNotif();


            function UpdateData() {

                $.ajax({
                    url: BASE_URL + `/api/notif-update`,
                    method: 'GET',
                    success: function(response) {
                        $('#total-notif').html('');
                    },
                    error: function(error) {
                        console.error('Error fetching data:', error);
                    }
                });


            }

            // function getNotif() {

            //     $.ajax({
            //         url: BASE_URL + `/api/notif`,
            //         method: 'GET',
            //         success: function(response) {
                       

            //             if (response.data.length > 0) {
            //                 // Populate content with new data
            //                 response.data.forEach(function(item, index) {
            //                     var row = ``;
            //                     row += `<li>`;
            //                     row += `<a href="#">`;
            //                     row += `<div class="pull-left">`;
            //                     row += `<img src="${item.photo}" class="img-circle" alt="User Image">`;
            //                     row += `</div>`;
            //                     row += `<h4>${item.name}<small><i class="fa fa-clock-o"></i> ${item.created_at}</small></h4>`;
            //                     row += `<p>${item.messages}</p>`;
            //                     row += `</a>`;

            //                     row += `</li>`;

            //                 });
            //                 $('#total-notif').append(response.total_not_show);
            //                 $('#total-notif-all').append('You have ' + response.total_all + ' messages');
            //                 $('#menu-notif').append(row);
            //             } else {
                            
            //                 var row = ``;
            //                 row += `<li>`;
            //                 row += `<a>Data Kosong</a>`;
            //                 row += `</li>`;
            //                 $('#menu-notif').append(row);
            //             }


            //         },
            //         error: function(error) {
            //             console.error('Error fetching data:', error);
            //         }
            //     });
            // } 
        });
    </script>
    <script type="text/javascript">
        const apps = localStorage.getItem('apps');
        const template = JSON.parse(apps);
        $('.logo-mini').html('<img src="' + template.logo_sm + '" class="full">');
        $('.logo-lg').html('<img src="' + template.logo_lg + '" class="full">');


        $("#close1").click(()=> {   
          DefaultNull();
        });

         $("#close2").click(()=> {   
          DefaultNull();
        });

         function DefaultNull()
       {
            $('.selectpicker').selectpicker('refresh');
           $("input").val(null);
           $("textarea").val(null);
           $('#daerah-alert-add').hide();
           $('#semester').selectpicker('val', 'null');
           $('#role_id').selectpicker('val', 'null');
           $('#kabupaten_id').selectpicker('val', 'null');
           $('#province_id').selectpicker('val', 'null');
           $('.form-group').removeClass('has-error');
           $('.span-messages').removeClass('help-block').html('');
           
        }

    </script>
    @stack('scripts')

</body>
@include('template/sidakv2/layout.profile')

</html>