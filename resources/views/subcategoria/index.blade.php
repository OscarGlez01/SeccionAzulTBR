<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sub-Category') }}
        </h2>
    </x-slot>
    <div class="mx-auto my-5 max-w-screen-lg xs:max-w-screen-sm fadding-in ">
        <a href="{{ route('subcategorias.create') }}" class="btn btn-add">Registrar</a>
        <hr class="my-4 xs:border-transparent">
        <div class="overflow-auto">
            <table class="table-auto w-full text-left rtl:text-right crud-table">
                <thead class="">
                    <tr class="">
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Category') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subcategorias as $subcategoria)
                        <tr class="content-row">
                            <td>{{ $subcategoria->nombre }} </td>
                            <td>{{ $subcategoria->descripcion }} </td>
                            <td>{{ $subcategoria->categoria->nombre ?? '---' }}</td>
                            <td>
                                <div style="cursor: pointer;" class="inline-flex" x-data="{ subcategoria: {{ $subcategoria }} }">
                                    <a type="button" class="btn-mini btn-cancel"
                                        x-on:click="$dispatch('open-modal', 'delete-subcategoria-registry'); $dispatch('subcategoria', subcategoria)">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </div>
                                <a href="{{ route('subcategorias.edit', $subcategoria) }}"
                                    class="btn-mini btn-warning">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <div class="">
            {{ $subcategorias->links('pagination::tailwind') }}
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
        subcategoria: { subcategoria_id: null },
        get deletionRoute() {
            return `/subcategorias/${this.subcategoria.subcategoria_id}`;
        }
    }" @subcategoria.window="subcategoria = $event.detail" class="space-y-6">
        <x-modal name="delete-subcategoria-registry" :show="false" class="" focusable>
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
                    <p x-text="subcategoria.nombre"></p>
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
