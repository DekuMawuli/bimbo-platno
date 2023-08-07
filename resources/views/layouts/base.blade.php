<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bimbo | @yield('title')</title>
    @livewireStyles
    <link rel="stylesheet" href="{{ asset("css/bootstrap.css") }}">
    <style>
        body{
            background-color: #e5e5e5;
        }

        .btn, .card{
             border-radius: 0;
        }

        .form-control{
            border-radius: 0;
            border: 1px dashed;
        }

        .form-control:focus{
            box-shadow: none !important;
            border: 1px dashed rgba(9, 116, 126, 0.51);
        }
    </style>
</head>
<body>
    @yield("content")

    @livewireScripts
    <script src="{{ asset("js/jquery.min.js") }}"></script>
    <script src="{{ asset("js/bootstrap.min.js") }}"></script>
    @yield("extra_js")
</body>
</html>
