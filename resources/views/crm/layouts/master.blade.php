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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <!-- Datatable -->
        <link rel="stylesheet" href="http://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
        <!-- Awesome Font -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- iziModal -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.1/css/iziModal.min.css" />
        
        <link rel="stylesheet" type="text/css" href="{{asset('vendor/iziToast/dist/css/iziToast.min.css')}}">
        
        <!-- Semantic UI -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.9/semantic.min.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        @yield('extra-css')
    </head>


<body >

    <div class="main-secion">
      @yield('content')
    </div> 

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- JQuery Datatables -->
    <script src="http://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <!-- iziModal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.1/js/iziModal.min.js"></script>

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