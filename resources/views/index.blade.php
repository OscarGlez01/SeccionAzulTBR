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
                <a href="{{ url('/explore') }}" class="btn btn-amarillo">Explorar</a>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container mx-auto px-3 xl:w-9/12">
            <div class="flex flex-wrap h-full xs:flex-col xs:justify-center">
                <div
                    class="w-1/2 xs:w-full xs:justify-center pr-4 self-center flex justify-items-center text-left GUAYMAS-SONORA ">
                    <button title="Cambiar tema" id="theme-toggle" type="button"
                        class="text-black dark:text-gray-400 hover:bg-black dark:hover:bg-gray-700 hover:bg-opacity-15 dark:hover:opacity-100 focus:outline-none focus:ring-4 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 mx-4 transition-all duration-300">
                        <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                        <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                fill-rule="evenodd" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <h1 class="mb-0" style="line-height: 3rem">GUAYMAS · SONORA</h1>
                </div>
                <div
                    class="w-1/2 xs:w-full xs:flex xs:justify-center xs:pl-0 pl-4 self-center text-right Annciate-con-nosotros">
                    <a class = "me-4 xs:me-0 p-4 rounded highlight-element" href="">Anúnciate con nosotros</a>
                    <a href="{{ route('login') }}">
                        <button type="button" title="Log-in as admin"
                            class="p-3 rounded highlight-element relative group transition-all duration-200">
                            <i class="fa-solid fa-door-closed fa-xl group-hover:hidden"></i>
                            <i class="fa-solid fa-door-open fa-xl hidden group-hover:inline"></i>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </footer>

</html>
