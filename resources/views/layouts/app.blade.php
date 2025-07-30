<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Course Builder</title>

    @vite('resources/css/app.css', 'resources/js/app.js')
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        @include('layouts.sidebar')
        <div class="flex-1 flex flex-col">
            @include('layouts.navbar')
    
            @yield('content')
            
        </div>
    </div>
    
</body>
</html>