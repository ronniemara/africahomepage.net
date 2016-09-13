<!DOCTYPE html>
<html lang="en">
    <head>
      <title>Mp3AfricaMusic.com</title>

      <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link href="{{ elixir('css/app.css') }}" rel="stylesheet" type="text/css">
      <style>
      body { padding-bottom: 70px; }
      </style>

    </head>
    <body  data-title="{{ $dataTitle }}" >    
        <div class="wrapper">
            @include('header')
            @include('nav')
            <div class="container">
                    @include('leftsidebar')
                    @yield('content')     
                    @include('rightsidebar')
            </div><!-- end container -->
        </div> <!--wrapper  -->
      <script type="text/javascript" src="{{ elixir('js/main.js') }}"></script>
    </body>
</html>
