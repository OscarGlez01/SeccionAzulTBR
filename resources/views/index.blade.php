<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seccion Azul</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="w-full max-w-screen-xl mx-auto px-4" style="height:90vh;">

        <div class="flex justify-center logo ">
            <img src="img/LogoGris.svg">
        </div>

        <form action="{{ route('dashboard') }}" class="flex justify-center fh-100" method="GET">
            <div class="searchbar">
                <input class="search_input" type="text" name="search" placeholder="Fumigar">
                <button type="submit" class="search_icon"><i class="fas fa-search"></i> </button>
            </div>
        </form>

        <div class="flex justify-center explorar">
            <a href="{{ url('/explore') }}" class="btn btn-amarillo">Explorar</a>
        </div>

    </div>



    <footer class="footer index">
        <div class="container mx-auto px-3 h-full xl:w-9/12">
            <div class="flex flex-wrap h-full">
                <div class="w-1/2 pr-4 self-center text-left GUAYMAS-SONORA "> GUAYMAS · SONORA</div>
                <div class="w-1/2 pl-4 self-center text-right Annciate-con-nosotros"><a href="">Anúnciate con
                        nosotros</a></div>
            </div>
        </div>
    </footer>

</html>
