<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="funCodes">
  <meta name="keyword" content="Application de gestion de stock !">
  <title>izyGest | @yield('titre') </title>

  <!-- Favicons -->
  <link href="{{ asset('/icon.png') }}" rel="icon">
  <link href="{{ asset('/icon.png') }}" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <!--external css-->
  <link href="{{ asset('lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="{{ asset('css/zabuto_calendar.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('lib/gritter/css/jquery.gritter.css') }}" />
  <!-- Custom styles for this template -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style-responsive.css') }}" rel="stylesheet">
  <script src="{{ asset('lib/chart-master/Chart.js') }}"></script>

  <link href="{{ asset('lib/advanced-datatable/css/demo_page.css') }}" rel="stylesheet" />
  <link href="{{ asset('lib/advanced-datatable/css/demo_table.css') }}" rel="stylesheet" />

  
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>

<body>

    @include('layouts/plus/header')

    @include('layouts/plus/menu')

    <section id="main-content">

        <section class="wrapper">
            

            @yield('content')

        </section>
        
    {{-- @include('layouts/plus/footer') --}}
    </section>


    @include('layouts/plus/script')

</body>

</html>