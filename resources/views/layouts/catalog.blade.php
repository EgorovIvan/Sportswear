<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@section('title') :: Catalog @show</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>
<body>
<x-main.header></x-main.header>
<x-catalog.catalog></x-catalog.catalog>
<x-main.footer></x-main.footer>

@stack('js')
</body>
</html>
