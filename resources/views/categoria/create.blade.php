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
                    placeholder="Describe brevemente la categoría" />
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
                        <img :src="imagePreview" alt="Image preview" width="150" height="auto">
                    </template>
                </div>
                <!-- Reset the image preview -->
                <button type="button" @click="resetPreview" class="btn btn-warning">
                    {{ __('Reset Image') }}
                </button>
            </div>

            <div x-data="iconSelector()" class="py-4">
                <!-- Search Input with Suggestions -->
                <div>
                    <label for="icon-search" class="block text-md font-medium">Logo</label>
                    <div class="relative">
                        <input id="icon-search" type="text" x-model="searchQuery" @input="filterIcons"
                            placeholder="Search for an icon..." class="border p-2 w-full rounded" />
                    </div>
                </div>

                <!-- Icons Display Grid -->
                <div class="grid grid-cols-6 gap-4 max-h-64 overflow-y-auto border p-2 mt-4 rounded">
                    <template x-for="icon in visibleIcons" :key="icon">
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

            <!-- Options Item Rack -->
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
            icons: [],
            filteredIcons: [],
            visibleIcons: [],
            suggestions: [],
            selectedIcon: null,
            iconsPerPage: 227,
            currentPage: 1,

            async init() {
                // Leer inconos desde un JSON en Storage
                const response = await fetch('/storage/fontawesome_icons.json');
                this.icons = await response.json();
                this.filteredIcons = this.icons;
                this.loadVisibleIcons();
            },

            filterIcons() {
                this.filteredIcons = this.icons.filter(icon =>
                    icon.toLowerCase().includes(this.searchQuery.toLowerCase())
                );
                this.currentPage = 1;
                this.loadVisibleIcons();
            },

            loadVisibleIcons() {
                const start = (this.currentPage - 1) * this.iconsPerPage;
                const end = start + this.iconsPerPage;
                this.visibleIcons = this.filteredIcons.slice(0, end);
            },

            loadMoreIcons() {
                this.currentPage++;
                this.loadVisibleIcons();
            },

            selectIcon(icon) {
                this.selectedIcon = icon;
            },

            selectSuggestion(suggestion) {
                this.searchQuery = suggestion;
                this.filterIcons();
            }
        };
    }
</script>
