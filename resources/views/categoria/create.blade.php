<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Category') }}
        </h2>
    </x-slot>

    <div class="mx-auto my-5 max-w-screen-lg fadding-in">
        <h1 class="text-xl text-black dark:text-white ">Añadir un registro</h1>
        <hr class="my-4 border-gray-800 dark:border-neutral-400">
        <form action="{{ route('categorias.store') }}" method="POST" class="form-crud" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="form-crud-label" for="nombre">
                    {{ __('Name') }}
                </label>
                <input class="form-crud-input" id="nombre" name="nombre" type="text"
                    placeholder="Nombre de la categoría" />
            </div>
            <div class="mb-4">
                <label class="form-crud-label" for="descripcion">
                    {{ __('Description') }}
                </label>
                <input class="form-crud-input" id="descripcion" name="descripcion" type="text"
                    placeholder="Describe la categoría" />
            </div>

            <div x-data="{
                imagePreview: '',
                resetPreview() {
                    this.imagePreview = '';
                    this.$refs.fileInput.value = '';
                }
            }" class="mb-4">
                <label class="form-crud-label" for="banner">{{ __('Header') }}</label>
                <input x-ref="fileInput" class="form-crud-input" id="banner" name="banner" type="file"
                    accept="image/*"
                    @change="imagePreview = $refs.fileInput.files[0] ? URL.createObjectURL($refs.fileInput.files[0]) : ''">
                <div class="my-4">
                    <template x-if="imagePreview">
                        <img :src="imagePreview" alt="Image preview" width="150">
                    </template>
                </div>
                <!-- Reset the image preview -->
                <button type="button" @click="resetPreview" class="btn btn-warning">
                    {{ __('Reset Image') }}
                </button>
            </div>
            <div x-data="iconSelector()" class="p-4">
                <!-- Search Input -->
                <label for="icon-search" class="block text-sm font-medium">Search Icons:</label>
                <input id="icon-search" type="text" x-model="searchQuery" @input="filterIcons"
                    placeholder="Search for an icon..." class="border p-2 w-full rounded mb-4" />

                <div class="grid grid-cols-6 gap-4 max-h-64 overflow-y-auto border p-2 rounded">
                    <template x-for="icon in filteredIcons" :key="icon">
                        <div class="flex flex-col items-center justify-center border p-2 rounded cursor-pointer hover:bg-gray-200"
                            @click="selectIcon(icon)" :class="selectedIcon === icon ? 'bg-blue-100' : ''">
                            <i :class="icon" class="text-xl"></i>
                            <span x-text="icon" class="text-xs mt-1"></span>
                        </div>
                    </template>
                </div>

                <!-- Selected Icon Preview -->
                <div class="mt-4">
                    <h3 class="text-sm font-medium">Selected Icon:</h3>
                    <div class="flex items-center mt-2">
                        <i x-show="selectedIcon" :class="selectedIcon" class="text-2xl mr-2"></i>
                        <span x-text="selectedIcon || 'No icon selected'" class="text-sm"></span>
                    </div>
                </div>

                <!-- Hidden Input to Submit the Selected Icon -->
                <input type="hidden" name="logo" :value="selectedIcon">
            </div>
            <div class="mb-2">
                <button type="submit" class="btn btn-add">{{ __('Create') }}</button>
                <a href="{{ route('categorias.index') }}">
                    <button type="button" class="btn btn-cancel"> {{ __('Cancel') }} </button>
                </a>
            </div>
    </div>
    @if ($errors->any())
        <div class="fade-in w-max rounded p-3 m-4 bg-red-300 border-red-400 border flex items-center text-red-500">
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

<script>
    function iconSelector() {
        return {
            searchQuery: '',
            icons: [
                'fa-solid fa-home',
                'fa-solid fa-user',
                'fa-solid fa-envelope',
                'fa-solid fa-phone',
                'fa-solid fa-cog',
                'fa-solid fa-heart',
                'fa-solid fa-star',
                'fa-solid fa-trash',
                'fa-solid fa-camera',
                'fa-solid fa-car',
                // Add more FontAwesome icons here
            ],
            filteredIcons: [],
            selectedIcon: null,

            filterIcons() {
                this.filteredIcons = this.icons.filter(icon =>
                    icon.toLowerCase().includes(this.searchQuery.toLowerCase())
                );
            },

            selectIcon(icon) {
                this.selectedIcon = icon;
            },

            init() {
                // Initialize filteredIcons with the full list of icons
                this.filteredIcons = this.icons;
            }
        };
    }
</script>
