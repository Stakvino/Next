<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>CRM @yield('title')</title>

        <link href="/img/favicon.ico" rel="SHORTCUT ICON" />

        
        <!-- Bootstrap -->
        <link href="{{asset('vendor/bootstrap/bootstrap.min.css')}}" />
        <!-- DataTable -->
        <link rel="stylesheet" href="http://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
        <!-- iziModal -->
        <link rel="stylesheet" href="{{asset('vendor/iziModal/Modal.min.css')}}" />
        <!-- iziToast -->
        <link rel="stylesheet" type="text/css" href="{{asset('vendor/iziToast/dist/css/iziToast.min.css')}}">
        <!-- SemanticUi -->
        <link rel="stylesheet" type="text/css" href="{{asset('vendor/SemanticUI/semantic.min.css')}}">
         <!-- iziToast -->       
        <link rel="stylesheet" type="text/css" href="{{asset('vendor/iziToast/dist/css/iziToast.min.css')}}">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        @yield('extra-css')
    </head>


<body >

    <div class="main-secion">
      @yield('content')
    </div> 

    <!-- JQuery -->
    <script src="{{asset('vendor/jQuery/jquery.min.js')}}"></script>
    <!-- JQuery Datatables -->
    <script src="{{asset('vendor/DataTables/jquery.dataTables.min.js')}}"></script>
    <!-- iziModal -->
    <script src="{{asset('vendor/iziModal/Modal.min.js')}}"></script>
    <!-- iziToast -->
    <script src="{{asset('vendor/iziToast/dist/js/iziToast.min.js')}}"></script>
    <!-- Semantic UI -->
    <script src="{{asset('vendor/SemanticUI/semantic.min.js')}}"></script>

    <!-- Js -->
    <script src="{{ asset('js/crm/fournisseurs/helper.js') }}"></script>
    <script src="{{ asset('js/crm/fournisseurs/fournisseurs.js') }}"></script>

  @yield('extra-js')

</body>
</html>