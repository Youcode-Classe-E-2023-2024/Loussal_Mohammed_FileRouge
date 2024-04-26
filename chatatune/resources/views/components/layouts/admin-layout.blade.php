{{-- @extends('layouts.adminLayout') --}}

{{-- @section('title', 'Dashboard') --}}

{{-- @section('content') --}}
{{-- --}}
{{-- @endsection --}}

    <!DOCTYPE html>
<html lang="en">

<!-- Mirrored from designreset.com/cork/html/modern-dark-menu/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 10 Jan 2024 10:24:16 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>
    <link rel="icon" type="image/x-icon" href="https://designreset.com/cork/html/src/assets/img/favicon.ico" />
    <link href="{{ asset('layouts/modern-dark-menu/css/light/loader.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('layouts/modern-dark-menu/css/dark/loader.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('layouts/modern-dark-menu/loader.js') }}"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('layouts/modern-dark-menu/css/light/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('layouts/modern-dark-menu/css/dark/plugins.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{ asset('plugins/src/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/light/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/dark/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        const token = localStorage.getItem('token');

        if(!token){
            window.location.href = '/login';
        }else{
            console.log('token');
            axios.get('api/get-user', {
                headers: {
                    'Authorization': 'Bearer ' + token,
                }
            })
                .then((response) => {
                    var user = response.data.user;
                    console.log(user.roles);
                    if (user.roles != 'admin') {
                        // window.location.href = '/';
                    }else{
                        console.log(user.roles);
                        console.log(user)
                        document.getElementById('user').innerHTML =user.name;
                        document.getElementById('roles').innerHTML =user.roles;

                    }

                })
                .catch((error) => {
                    // window.location.href = '/login';

                });

        }




    </script>
    <style>

    </style>

    <link href="{{ asset('css/dark/apps/notes.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/light/apps/notes.css') }}" rel="stylesheet" type="text/css" />

    <<<<<<< HEAD
    <link rel="stylesheet" href="{{asset('css/pagination.css')}}">

    =======
    >>>>>>> 4cd14aaba2b9571e120af2ca68cc52066d289175
</head>

<body class="layout-boxed">
<!-- BEGIN LOADER -->
<div id="load_screen">
    <div class="loader">
        <div class="loader-content">
            <div class="spinner-grow align-self-center"></div>
        </div>
    </div>
</div>
<!--  END LOADER -->

<!--  BEGIN NAVBAR  -->
<x-nav-bar />
<!--  END NAVBAR  -->

<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">

    <div class="overlay"></div>
    <div class="search-overlay"></div>

    <!--  BEGIN SIDEBAR  -->
    <div class="sidebar-wrapper sidebar-theme">

        <x-side-bar />

    </div>
    <!--  END SIDEBAR  -->

    <!--  BEGIN CONTENT AREA  -->
    {{$slot}}
    <!--  END CONTENT AREA  -->

</div>
<!-- END MAIN CONTAINER -->

<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{ asset('plugins/src/global/vendors.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/src/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('plugins/src/mousetrap/mousetrap.min.js') }}"></script>
<script src="{{ asset('plugins/src/waves/waves.min.js') }}"></script>
<script src="{{ asset('layouts/modern-dark-menu/app.js') }}"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="{{ asset('plugins/src/apex/apexcharts.min.js') }}"></script>
<script src="{{ asset('js/dashboard/dash_1.js') }}"></script>
<script src="{{ asset('js/apps/notes.js') }}"></script>
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

</body>

<!-- Mirrored from designreset.com/cork/html/modern-dark-menu/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 10 Jan 2024 10:24:48 GMT -->

</html>
