<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sub-Category') }}
        </h2>
    </x-slot>

    <div class="mx-auto my-5 max-w-screen-lg fadding-in">
        <h1 class="text-xl text-black dark:text-white ">Añadir un registro</h1>
        <hr class="my-4 border-gray-800 dark:border-neutral-400">
        <form action="{{ route('subcategorias.store') }}" method="POST" class="form-crud">
            @csrf
            <div class="mb-4">
                <label class="form-crud-label" for="nombre">
                    {{ __('Name') }}
                </label>
                <input class="form-crud-input" id="nombre" name="nombre" type="text"
                    placeholder="Nombre de la sub-categoría" />
            </div>
            <div class="mb-4">
                <label class="form-crud-label" for="descripcion">
                    {{ __('Description') }}
                </label>
                <input class="form-crud-input" id="descripcion" name="descripcion" type="text"
                    placeholder="Describe la sub-categoría" />
            </div>
            <div class="mb-4">
                <label class="form-crud-label" for="categoria_id">{{ __('Category') }}</label>
                <select class="form-crud-input" id="categoria_id" name="categoria_id" required>
                    <option value="" disabled selected>Selecciona una categoria</option>
                    <option value="">Sin categoría</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->categoria_id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-2">
                <button type="submit" class="btn btn-add">{{ __('Create') }}</button>
                <a href="{{ route('subcategorias.index') }}">
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
