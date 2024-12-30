<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sub-Category') }}
        </h2>
    </x-slot>

    <div class="mx-auto px-2 my-5 container lg:max-w-screen-lg fadding-in">
        <h1 class="text-xl text-black dark:text-white ">Editar un registro</h1>
        <hr class="my-4 border-gray-800 dark:border-neutral-400">
        <form action="{{ route('subcategorias.update', $subcategoria) }}" method="POST" class="form-crud">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="form-crud-label" for="nombre">
                    {{ __('Name') }}
                </label>
                <input value="{{ $subcategoria->nombre }}" class="form-crud-input" id="nombre" name="nombre"
                    type="text" placeholder="Nombre de la sub-categoría" />
            </div>
            <div class="mb-4">
                <label class="form-crud-label" for="descripcion">
                    {{ __('Description') }}
                </label>
                <input value="{{ $subcategoria->descripcion }}" class="form-crud-input" id="descripcion"
                    name="descripcion" type="text" placeholder="Describe la sub-categoría" />
            </div>
            <div class="mb-4">
                <label class="form-crud-label" for="categoria_id">{{ __('Category') }}</label>
                <select class="form-crud-input" id="categoria_id" name="categoria_id" required>
                    <option value="" disabled>Select a Category</option>
                    <option value="" {{ is_null($subcategoria->categoria_id) ? 'selected' : '' }}>Sin categoría
                    </option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->categoria_id }}"
                            {{ $subcategoria->categoria_id == $categoria->categoria_id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-2">
                <button type="submit" class="btn btn-warning">{{ __('Edit') }}</button>
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
