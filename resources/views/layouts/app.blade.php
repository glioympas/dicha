<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>
        {{ config('app.name') }} - @yield('title')
    </title>

    <link href="/assets/vendor/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="/assets/vendor/fontawesome/css/brands.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="/assets/css/master.css" rel="stylesheet">
    
</head>

<body>
    <div class="wrapper">
        @include('partials.sidebar')
         <form method="POST" class="d-none logout-form" action="{{ route('logout') }}">@csrf</form>
        <div id="body" class="active">
            @include('partials.navbar')
            <div class="content">
                <div class="container py-4">

                    <div class="alert alert-success {{ session()->has('success') ? '' : 'd-none' }} top-success">{{ session('success') }}</div>
                    <div class="alert alert-danger {{ session()->has('error') ? '' : 'd-none' }} top-error">{{ session('error') }}</div>

                    <div class="mt-4">
                        @yield('content')
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>