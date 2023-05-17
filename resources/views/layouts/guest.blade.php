<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">



    <style>
        .invalid-feedback {
            color: rgb(240, 60, 60);
            font-family: Arial, Helvetica, sans-serif;
            font-weight: normal;

        }

        ;
    </style>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
</head>

<body>
    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>
</body>
<!-- Styles -->
<script src="{{ asset('assets/dashboard/plugins/jquery/jquery.min.js') }}"></script>
<!-- jquery validtion cdn  -->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>


{{-- <script src="{{ asset('assets/custom_js/validate/customValidate.js') }}"></script>
<script src="{{ asset('assets/custom_js/validate/userAuthenticate.js') }}"></script> --}}


{{-- validate --}}

{!! JsValidator::formRequest('App\Http\Requests\RegisterRequest', '#registerUser') !!}
{!! JsValidator::formRequest('App\Http\Requests\Auth\LoginRequest', '#login') !!}


</html>
