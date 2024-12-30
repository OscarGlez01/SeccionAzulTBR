<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seccion Azul</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="">
    <div class="bg-white dark:bg-slate-800 home-index">
        <div class="w-full max-w-screen-xl mx-auto px-4">
            <div class="flex justify-center logo ">
                <img title="SeccionAzul" src="img/LogoGris.svg" class="block dark:hidden">
                <img title="SeccionAzul" src="img/LogoBlanco.svg" class="hidden dark:block">
            </div>
            <form action="{{ route('dashboard') }}" class="flex justify-center fh-100" method="GET">
                <div class="searchbar">
                    <input class="search_input" type="text" name="search" placeholder="Fumigar">
                    <button type="submit" title="search" class="search_icon"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <div class="flex justify-center explorar">
                <a href="{{ route('explore.index') }}" class="btn btn-amarillo">Explorar</a>
            </div>
        </div>
    </div>
    <x-footer></x-footer>
</html>
