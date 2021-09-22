<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">    
        
        <title>{{ config('app.name') }}</title>
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap/bootstrap.min.css')}}">

        <!-- Custom CSS -->
            
        <!-- JQuery -->
        <script src="{{ asset('/js/jquery-3.3.1.min.js')}}"></script>

        <!-- Bootstrap JS -->
        <script src="{{ asset('/js/bootstrap/bootstrap.min.js')}}"></script>    
    </head>
<body>    
    <div>
        <div id="content">
            <main class="content">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>