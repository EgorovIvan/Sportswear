<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@section('title') :: Cart @show</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>
<body>
<div class="wrapper">
    <x-main.header></x-main.header>
    <x-cart.cart></x-cart.cart>
    <x-main.footer></x-main.footer>
</div>


</body>
</html>
