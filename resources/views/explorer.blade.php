@extends('layouts.cover')

@section('content')

<div class="container mx-auto principal">
    <!-- Desktop Button Section -->
    <div class="flex flex-wrap justify-center btn-version-pc">
        <article class="w-1/2 md:w-1/3 lg:w-1/4 px-4">
            <a href="/explore/13" class="seccion-item">
                <img src="img/iconos/Emergenciax2.png" class="icon" alt=""><br>
                <span class="titulo">Números de emergencia</span><br>
                <small class="descripcion">EMERGENCY NUMBERS</small>
            </a>
        </article>
        <article class="w-1/2 md:w-1/3 lg:w-1/4 px-4">
            <a href="" class="seccion-item">
                <img src="img/iconos/Icon awesome-info@2x.png" class="icon" alt=""><br>
                <span class="titulo">Oficinas de gobierno</span><br>
                <small class="descripcion">CITY HALL</small>
            </a>
        </article>
    </div>

    <!-- Mobile Button Section -->
    <div class="flex flex-col items-center btn-version-mobil">
        <article class="w-full">
            <a href="" class="seccion-item-mobil">
                <img src="img/iconos/Gobierno.svg" class="icon" alt="">
                <span class="titulo">Oficinas de gobierno</span>
                <small class="descripcion absolute -ml-[145px] mt-[22px]">CITY HALL</small>
            </a>
        </article>
        <article class="w-full mt-10">
            <a href="/explore/13" class="seccion-item-mobil emergency">
                <img src="img/iconos/Emergencia.svg" class="icon ml-6 mt-2" alt="">
                <span class="titulo">Números de emergencia</span>
                <small class="descripcion absolute -ml-[171px] mt-[22px]">Emergency Numbers</small>
            </a>
        </article>
    </div>

    <!-- Dynamic Section -->
    <div class="flex flex-wrap justify-center secciones">
        @foreach ($categorias as $categoria)
            <article class="w-1/2 md:w-1/3 lg:w-1/4">
                <a href="/explore/8" class="seccion-item bg-cover bg-center"
                    style="background-image: url('img/fotos/Fumigaciones.jpg');">
                    <img src="img/iconos/Pestcontrol@2x.png" class="icon" alt=""><br>
                    <span class="titulo">{{ $categoria->nombre }}</span><br>
                    <small class="descripcion">{{ $categoria->descripcion }}</small>
                </a>
            </article>
        @endforeach
    </div>
</div>

@endsection