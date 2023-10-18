<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/img/favicon.png" type="image/x-icon">
    <title>@section('title') :: Main @show</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>
<body>
<x-main.header></x-main.header>
<x-main.main></x-main.main>
<x-main.footer></x-main.footer>


</body>
</html>
