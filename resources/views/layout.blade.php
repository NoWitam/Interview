<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title> @yield('title') </title>
    </head>

    <body>
        @if(\Session::has('success'))
           <h1 style="color: green"> {{ \Session::get('success') }} </h1>
        @endif

        @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
               <li>{{ $error }}</li>
            @endforeach
        </ul>

        @endif
        
        @yield('body')

    </body>
</html>
