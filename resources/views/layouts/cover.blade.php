<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sección Azul: Catálogo</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="w-full header_search">
        <section class="flex flex-col h-30 items-center">
            <a href="/" class="flex justify-center logo-header w-full">
                <img src="img/LogoBlanco.svg">
            </a>
            <p class="text-center w-full mb-4">
                Busca cualquier lugar, producto o servicio.<br>
                Si está en Guaymas, está aquí.
            </p>
            <form action="sinresultado.php" class="flex justify-center w-full h-full">
                <div class="searchbar">
                    <input class="search_input" type="text" name=""
                        placeholder="Buscar... plomero, plomeria, tuberia, tubos">
                    <button type="submit" class="search_icon">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </section>
    </div>
    @yield('content')
    <x-footer></x-footer>
</body>

</html>
