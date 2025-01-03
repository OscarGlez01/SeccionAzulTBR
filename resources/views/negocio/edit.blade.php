<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Business') }}
        </h2>
    </x-slot>

    <div class="mx-auto px-2 my-5 pb-12 container lg:max-w-screen-lg fadding-in">
        <h1 class="text-xl text-black dark:text-white ">Editar un registro</h1>
        <hr class="my-4 border-gray-800 xs:border-neutral-100 dark:border-neutral-400">
        <form action="{{ route('negocios.update', $negocio) }}" method="POST" enctype="multipart/form-data"
            class="form-crud">
            @csrf
            @method('PUT')
            <div class="flex w-full gap-3">
                <div class=" w-1/2 mb-4">
                    <label class="form-crud-label" for="nombre">
                        {{ __('Name') }}
                    </label>
                    <input value="{{ $negocio->nombre }}" class="form-crud-input" id="nombre" name="nombre"
                        type="text" placeholder="Nombre del negocio" />
                </div>
                <div class=" w-1/2 mb-4">
                    <label class="form-crud-label" for="direccion">
                        {{ __('Address') }}
                    </label>
                    <input value="{{ $negocio->direccion }}" class="form-crud-input" id="direccion" name="direccion"
                        type="text" placeholder="La dirección registrada del negocio" />
                </div>
            </div>
            <div class="flex w-full gap-3">
                <div class=" w-1/2 mb-4">
                    <label class="form-crud-label" for="ubicación">
                        {{ __('Location') }}
                    </label>
                    <input value="{{ $negocio->ubicacion }}" class="form-crud-input" id="ubicacion" name="ubicacion"
                        type="text" placeholder="Ubicación geográfica del negocio" />
                </div>
                <div class="w-1/2 mb-4">
                    <label class="form-crud-label" for="categoria_id">{{ __('Category') }}</label>
                    <select class="form-crud-input" id="categoria_id" name="categoria_id" required>
                        <option value="" disabled>Selecciona una categoria</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->categoria_id }}"
                                {{ $negocio->categoria_id == $categoria->categoria_id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-crud-label" for="contacto_extra">
                    {{ __('Contact') }}
                </label>
                <textarea class="form-crud-input resize-y" id="contacto_extra" name="contacto_extra" type="text"
                    placeholder="Información adicional proporcionada por el negocio"></textarea>
            </div>
            <div class="flex w-full gap-3">
                <div class="w-1/2 mb-4">
                    <label class="form-crud-label" for="telefono">
                        {{ __('Telephone Number') }}
                    </label>
                    <input value="{{ $negocio->telefono }}" class="form-crud-input" id="telefono" name="telefono"
                        type="tel" placeholder="Número celular o fijo del negocio" />
                </div>
                <div class="w-1/2 mb-4">
                    <label class="form-crud-label" for="whatsapp">
                        {{ __('Whatsapp') }}
                    </label>
                    <input value="{{ $negocio->whatsapp }}" class="form-crud-input" id="whatsapp" name="whatsapp"
                        type="tel" placeholder="Perfil de Whatsapp activo, de tenerlo" />
                </div>
            </div>
            <div x-data="{
                imagePreview: '{{ $negocio->imagen ? asset('storage/' . $negocio->imagen) : '' }}',
                resetPreview() {
                    this.imagePreview = '{{ $negocio->imagen ? asset('storage/' . $negocio->imagen) : '' }}';
                    this.$refs.fileInput.value = '';
                }
            }" class="mb-4">
                <label class="form-crud-label" for="imagen">{{ __('Image') }}</label>
                <input x-ref="fileInput" class="form-crud-input" id="imagen" name="imagen" type="file"
                    accept="image/*"
                    @change="imagePreview = $refs.fileInput.files[0] ? URL.createObjectURL($refs.fileInput.files[0]) : ''">

                <div class="my-4">
                    <template x-if="imagePreview">
                        <img :src="imagePreview" alt="Image preview" width="150">
                    </template>
                    <template x-if="!imagePreview">
                        <img src="{{ asset('storage/' . $negocio->imagen) }}" alt="Imagen de negocio" width="150">
                    </template>
                </div>

                <!-- Reset the image preview -->
                <button type="button" @click="resetPreview" class="btn btn-warning">
                    {{ __('Reset Image') }}
                </button>
            </div>

            <div class="flex w-full gap-3">
                <div class="w-1/2 mb-4">
                    <label class="form-crud-label" for="facebook">
                        {{ __('Facebook') }}
                    </label>
                    <input value="{{ $negocio->facebook }}" class="form-crud-input" id="facebook" name="facebook"
                        type="text" placeholder="Página de Facebook activa, de tenerla" />
                </div>
                <div class="w-1/2 mb-4">
                    <label class="form-crud-label" for="instagram">
                        {{ __('Instagram') }}
                    </label>
                    <input value="{{ $negocio->instagram }}" class="form-crud-input" id="instagram"
                        name="instagram" type="text" placeholder="Página de Instragram activa, de tenerla" />
                </div>
            </div>
            <div class="mb-2">
                <button type="submit" class="btn btn-add">{{ __('Edit') }}</button>
                <a href="{{ route('negocios.index') }}">
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

