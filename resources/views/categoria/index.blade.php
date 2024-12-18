<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Category') }}
        </h2>
    </x-slot>
    <div class="mx-auto my-5 max-w-screen-lg xs:max-w-screen-sm ">
        <a href="{{ route('categorias.create') }}" class="btn btn-add">Registrar</a>
        <hr class="my-4 xs:border-transparent">
        <div class="overflow-auto">
            <table class="table-auto w-full text-left rtl:text-right crud-table">
                <thead class="">
                    <tr class="">
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria)
                        <tr>
                            <td>{{ $categoria->nombre }} </td>
                            <td>{{ $categoria->descripcion }} </td>
                            <td>
                                <div class="inline-flex" x-data="{ categoria: {{ $categoria }} }">
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
