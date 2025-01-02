<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Category') }}
        </h2>
    </x-slot>
    <div class="mx-auto my-5 lg:mx-auto md:w-screen max-w-screen-lg xs:max-w-screen-sm fadding-in ">
        <a href="{{ route('categorias.create') }}" class="btn btn-add ms-4 xl:ms-0">Registrar</a>
        <hr class="my-4 xs:border-transparent">
        <div class="overflow-auto">
            <table class="table-auto w-full text-left rtl:text-right crud-table">
                <thead class="">
                    <tr class="">
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Banner') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria)
                        <tr class="content-row">
                            <td>{{ $categoria->nombre }} </td>
                            <td>{{ $categoria->descripcion }} </td>
                            <td><img width="60" height="auto" class="rounded"
                                    src="{{ asset('storage/' . $categoria->banner) }}"
                                    alt="img#{{ $categoria->banner }}" /></td>
                            <td>
                                <div style="cursor: pointer;" class="inline-flex" x-data="{ categoria: {{ $categoria }} }">
                                    <a type="button" class="btn-mini btn-cancel"
                                        x-on:click="$dispatch('open-modal', 'delete-categoria-registry'); $dispatch('categoria', categoria)">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </div>
                                <a href="{{ route('categorias.edit', $categoria) }}" class="btn-mini btn-warning">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {{ $categorias->links() }}
        </div>
    </div>

    @if (session('message'))
        <div x-data="{ open: true }" x-init="setTimeout(() => open = false, 5000)" x-show="open"
            class="fixed bottom-4 right-4 px-4 py-2 rounded shadow-lg
            {{ session('alert-class') === 'success' ? 'bg-green-500 text-white' : '' }}
            {{ session('alert-class') === 'error' ? 'bg-red-500 text-white' : '' }}
            {{ session('alert-class') === 'warning' ? 'bg-yellow-500 text-black' : '' }}">
            {{ session('message') }}
        </div>
    @endif

    <!-- Modal para borrar un registro -->
    <div x-data="{
        categoria: { categoria_id: null },
        get deletionRoute() {
            return `/categorias/${this.categoria.categoria_id}`;
        }
    }" @categoria.window="categoria = $event.detail" class="space-y-6">
        <x-modal name="delete-categoria-registry" :show="false" class="" focusable>
            <form :action="deletionRoute" method="POST" class="p-6 dark:text-gray-100">
                @csrf
                @method('DELETE')
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 ">
                    {{ __('Delete') }}
                </h2>
                <div class="mt-6 space-y-2">
                    <p>{{ __('Estas seguro de que desea eliminar este objeto?') }} </p>
                    <br>
                    <h4 class="text-slate-900 dark:text-gray-100 capitalize">
                        {{ __('Name') }}</h4>
                    <p x-text="categoria.nombre"></p>
                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="btn-mini btn-cancel">
                            {{ __('Delete') }}
                        </button>
                        <button type="button" class="btn btn-add"
                            x-on:click.prevent="$dispatch('close')">{{ __('Cancel') }}</button>
                    </div>
                </div>
            </form>
        </x-modal>
    </div>
</x-app-layout>
