<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Business') }}
        </h2>
    </x-slot>

    <div class="mx-auto mt-5 pb-12 max-w-screen-lg fadding-in">
        <h1 class="text-xl text-black dark:text-white ">Mostrando: {{ $negocio->nombre }}</h1>
        <hr class="my-4 xs:border-transparent">

        <div class="rounded border bg-gray-50 border-gray-400 dark:bg-slate-800 dark:border-neutral-400 grid"
            style="grid-template-columns: 200px 1fr">
            <div class="flex justify-center items-start mt-5 ">
                <img width="150" height="auto" class="rounded" src="{{ asset('storage/' . $negocio->imagen) }}"
                    alt="img#{{ $negocio->negocio_id }}" />
            </div>
            <div class="px-6 py-4">
                <div class="flex w-full">
                    <div class=" w-1/2 mb-4">
                        <label class="form-crud-label" for="nombre">
                            {{ __('Name') }}
                        </label>
                        <span class="form-crud-input"
                            id="nombre">{{ $negocio->nombre ?? 'No hay un nombre registrado' }}</span>
                    </div>

                    <div class="w-1/2 mb-4">
                        <label class="form-crud-label" for="categoria_id">{{ __('Category') }}</label>
                        <span name="form-crud-input"
                            disabled>{{ $negocio->categoria->nombre ?? 'El negocio no muestra una categoría visible' }}</span>
                    </div>

                </div>
                <div class="flex w-full">
                    <div class=" w-1/2 mb-4">
                        <label class="form-crud-label" for="ubicación">
                            {{ __('Location') }}
                        </label>
                        <span class="" id="ubicacion" placeholder="Ubicación geográfica del negocio">
                            <a class="" style="color: blue; text-decoration: underline" rel="noopener noreferrer"
                                target="blank" href="{{ $negocio->ubicacion }}">
                                Enlace de ubicación
                            </a>
                        </span>
                    </div>
                    <div class=" w-1/2 mb-4">
                        <label class="form-crud-label" for="direccion">
                            {{ __('Address') }}
                        </label>
                        <span class="form-crud-input" id="direccion">{{ $negocio->direccion ?? '---' }}</span>
                    </div>
                </div>
                <div class="flex w-full">
                    <div class=" mb-4">
                        <label class="form-crud-label" for="contacto_extra">
                            {{ __('Contact') }}
                        </label>
                        <span class="form-crud-input" id="contacto_extra">
                            {{ $negocio->contacto_extra ?? '---' }}
                        </span>
                    </div>
                </div>
                <div class="flex w-full">
                    <div class="w-1/2 mb-4">
                        <label class="form-crud-label" for="telefono">
                            {{ __('Telephone Number') }}
                        </label>
                        <span class="form-crud-input" id="telefono">{{ $negocio->telefono }}</span>
                    </div>
                    <div class="w-1/2 mb-5">
                        <label class="form-crud-label" for="whatsapp">
                            {{ __('Whatsapp') }}
                        </label>
                        <span class="form-crud-input" id="whatsapp"><a class=""
                                style="color: green; text-decoration: underline" rel="noopener noreferrer"
                                target="blank" href="{{ $negocio->whatsapp }}">
                                Enlace a Whatsapp
                            </a></span>

                    </div>
                </div>
                <div class="flex w-full">
                    <div class="w-1/2 mb-4">
                        <label class="form-crud-label" for="facebook">
                            {{ __('Facebook') }}
                        </label>
                        <span class="form-crud-input" id="facebook"><a class=""
                                style="color: blue; text-decoration: underline" rel="noopener noreferrer" target="blank"
                                href="{{ $negocio->facebook }}">
                                Facebook
                            </a></span>
                    </div>
                    <div class="w-1/2 mb-4">
                        <label class="form-crud-label" for="instagram">
                            {{ __('Instagram') }}
                        </label>
                        <span class="form-crud-input" id="instagram"><a class=""
                                style="color: blue; text-decoration: underline" rel="noopener noreferrer" target="blank"
                                href="{{ $negocio->instagram }}">
                                Instagram
                            </a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5 rounded border bg-gray-50 border-gray-400 dark:bg-slate-800 dark:border-neutral-400 p-5">
            <h2 class="text-xl">Etiquetas</h2>
            <form action="{{ route('negocios.handleSubcategorias', $negocio->negocio_id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="dropdown">
                    <div class="selected-tags my-4" id="selectedTags">
                        @foreach ($subcategorias_escogidas as $etiqueta)
                            <span class="tag">
                                {{ $etiqueta->nombre }}
                                <span>x</span>
                            </span>
                        @endforeach

                    </div>
                    <input type="text" placeholder="Buscar..." id="dropdownInput" class="form-control"
                        onclick="toggleDropdown()">
                    <div class="dropdown-menu" id="dropdownMenu">
                        @foreach ($subcategorias as $subcategoria)
                            <div class="dropdown-item" data-id="{{ $subcategoria->subcategoria_id }}">
                                {{ $subcategoria->nombre }}</div>
                        @endforeach
                    </div>
                    <input type="hidden" name="subcategorias" id="selectedSubcategoria">
                </div>

                <button type="submit" class="btn btn-add my-3">Etiquetar</button>
            </form>
        </div>
    </div>

    </div>


</x-app-layout>
<script>
    const dropdownInput = document.getElementById('dropdownInput');
    const dropdownMenu = document.getElementById('dropdownMenu');
    const selectedTags = document.getElementById('selectedTags');
    const selectedSubcategoriaInput = document.getElementById('selectedSubcategoria');

    let selectedSubcategoria = [];

    // Preload selected subcategories
    document.addEventListener('DOMContentLoaded', () => {
        const preloadedSubcategorias = @json($subcategorias_escogidas).map(subcat => ({
            id: subcat.subcategoria_id.toString(),
            name: subcat.nombre
        }));

        selectedSubcategoria = preloadedSubcategorias;
        updateSelectedTags();
    });

    function toggleDropdown() {
        dropdownMenu.classList.toggle('active');
    }

    document.addEventListener('click', (e) => {
        if (!dropdownInput.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.remove('active');
        }
    });

    dropdownInput.addEventListener('input', () => {
        const searchTerm = dropdownInput.value.toLowerCase();
        Array.from(dropdownMenu.children).forEach(item => {
            const matches = item.textContent.toLowerCase().includes(searchTerm);
            item.style.display = matches ? 'block' : 'none';
        });
    });

    dropdownMenu.addEventListener('click', (e) => {
        if (e.target.classList.contains('dropdown-item')) {
            const id = e.target.getAttribute('data-id');
            const name = e.target.textContent;

            if (!selectedSubcategoria.some(att => att.id === id)) {
                selectedSubcategoria.push({
                    id,
                    name
                });
                updateSelectedTags();
            }
            dropdownMenu.classList.remove('active');

        }
    });

    function updateSelectedTags() {
        selectedTags.innerHTML = '';
        selectedSubcategoria.forEach(att => {
            const tag = document.createElement('span');
            tag.className = 'tag';
            tag.textContent = att.name;

            const removeBtn = document.createElement('span');
            removeBtn.textContent = ' ×';
            removeBtn.style.cursor = 'pointer';
            removeBtn.addEventListener('click', () => {
                selectedSubcategoria = selectedSubcategoria.filter(a => a.id !== att.id);
                updateSelectedTags();
            });

            tag.appendChild(removeBtn);
            selectedTags.appendChild(tag);
        });

        selectedSubcategoriaInput.value = JSON.stringify(selectedSubcategoria.map(att => att.id));
    }
</script>
<style>
    .dropdown {
        position: relative;
        width: 100%;
        /* Adjust the width as needed */
    }

    .dropdown input {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .dropdown-menu {
        position: absolute;
        width: 100%;
        border: 1px solid #ccc;
        background-color: #fff;
        max-height: 200px;
        overflow-y: auto;
        display: none;
        z-index: 1000;
        border-radius: 4px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .dropdown-menu.active {
        display: block;
    }

    .dropdown-item {
        padding: 8px;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .dropdown-item:hover {
        background-color: #f1f1f1;
    }

    .selected-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
        margin-top: 10px;
    }

    .tag {
        background-color: #007bff;
        color: #fff;
        padding: 5px 10px;
        border-radius: 3px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 14px;
    }

    .tag .remove-tag {
        cursor: pointer;
        font-weight: bold;
        color: #fff;
    }
</style>
