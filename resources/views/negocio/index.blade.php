<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Business') }}
        </h2>
    </x-slot>
    <div class="mx-auto my-5 max-w-screen-lg xs:max-w-screen-sm fadding-in ">
        <a href="{{ route('negocios.create') }}" class="btn btn-add">Registrar</a>
        <hr class="my-4 xs:border-transparent">
        <div class="overflow-auto">
            <table class="table-auto w-full text-left rtl:text-right crud-table">
                <thead class="">
                    <tr class="">
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Location') }}</th>
                        <th>{{ __('Category') }}</th>
                        <th>{{ __('Phone Number') }}</th>
                        <th>{{ __('Facebook') }} </th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($negocios as $negocio)
                        <tr class="content-row">
                            <td>
                                <div class="relative inline-block ">
                                    <input
                                        class="checkbox-toggle peer h-6 w-12 cursor-pointer appearance-none rounded-full border border-black dark:border-white checked:border-black focus:checked:border-black dark:checked:border-white bg-transparent"
                                        type="checkbox"
                                        value="{{$negocio->estado}}">
                                    <span
                                        class="peerless pointer-events-none absolute left-1 top-[5px] block h-4 w-4 rounded-full transition-all duration-200 peer-checked:left-7 bg-slate-600 dark:bg-slate-400 peer-checked:bg-white"></span>
                                </div>
                            </td>
                            <td>{{ $negocio->nombre }} </td>
                            <td>{{ $negocio->ubicacion }}</td>
                            <td>{{ $negocio->categoria->nombre ?? '---' }}</td>
                            <td>{{ $negocio->telefono }}</td>
                            <td>{{ $negocio->facebook }}</td>
                            <td>
                                <div style="cursor: pointer;" class="inline-flex" x-data="{ negocio: {{ $negocio }} }">
                                    <a type="button" class="btn-mini btn-cancel"
                                        x-on:click="$dispatch('open-modal', 'delete-negocio-registry'); $dispatch('negocio', negocio)">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </div>
                                <a href="{{ route('negocios.edit', $negocio) }}" class="btn-mini btn-warning">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {{ $negocios->links() }}
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
        negocio: { negocio_id: null },
        get deletionRoute() {
            return `/negocios/${this.negocio.negocio_id}`;
        }
    }" @negocio.window="negocio = $event.detail" class="space-y-6">
        <x-modal name="delete-negocio-registry" :show="false" class="" focusable>
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
                    <p x-text="negocio.nombre"></p>
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
