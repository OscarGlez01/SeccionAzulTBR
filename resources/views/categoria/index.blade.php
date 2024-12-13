<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Category') }}
        </h2>
    </x-slot>
    <div class="mx-auto my-5 max-w-screen-lg">
        <a href="{{ route('categorias.create') }}" class="btn btn-add">Registrar</a>
        <hr class="my-4">
        <div class="">
            <table class="table-auto w-full text-left rtl:text-right crud-table">
                <thead class="">
                    <tr>
                        <th>ID</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria)
                        <tr>
                            <td>{{ $categoria->categoria_id }} </td>
                            <td>{{ $categoria->nombre }} </td>
                            <td>{{ $categoria->descripcion }} </td>
                            <td> 
                                <a href="" class="btn-mini btn-cancel">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                                <a href="" class="btn-mini btn-warning">
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
</x-app-layout>
