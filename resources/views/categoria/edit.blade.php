<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Category') }}
        </h2>
    </x-slot>

    <div class="mx-auto px-2 my-5 container lg:max-w-screen-lg fadding-in">
        <h1 class="text-xl text-black dark:text-white ">Editando el registro: {{ $categoria->nombre }}</h1>
        <hr class="my-4 border-gray-800 dark:border-neutral-400">
        <form action="{{ route('categorias.update', $categoria) }}" method="POST" class="form-crud">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="form-crud-label" for="nombre">
                    {{ __('Name') }}
                </label>
                <input class="form-crud-input" id="nombre" name="nombre" type="text"
                    value="{{$categoria->nombre}}"></input>
            </div>
            <div class="mb-4">
                <label class="form-crud-label" for="descripcion">
                    {{ __('Description') }}
                </label>
                <input class="form-crud-input" id="descripcion" name="descripcion" type="text" value="{{$categoria->descripcion}}" />
            </div>
            <div class="mb-2">
                <button type="submit" class="btn btn-warning">{{ __('Edit') }}</button>
                <a href="{{ route('categorias.index') }}">
                    <button type="button" class="btn btn-cancel"> {{ __('Cancel') }} </button>
                </a>
            </div>
            @if ($errors->any())
                <div
                    class="fade-in w-max rounded p-3 m-4 bg-red-300 border-red-400 border flex items-center text-red-500">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>

    </div>

</x-app-layout>
