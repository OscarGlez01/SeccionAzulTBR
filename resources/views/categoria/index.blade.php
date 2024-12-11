<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Category') }}
        </h2>
    </x-slot>
    <div>
        <a href="{{ route('categorias.create') }}" class="btn btn-info">Registrar</a>
        <hr>
        <div class="table-responsive">
            <table class="table table-condensed table-hover">
                <thead>
                    <th>
                        id
                    </th>
                    <th>
                        Nombre
                    </th>
                    <th>
                        Descripción
                    </th>
                    <th>
                        Action
                    </th>
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria)
                        <tr>
                            <td>{{ $categoria->categoria_id }} </td>
                            <td>{{ $categoria->nombre }} </td>
                            <td>{{ $categoria->descripcion }} </td>
                            <td>
                                <a href="{{ route('destroy.categoria', $categoria->categoria_id) }}" class="btn btn-danger"
                                    onclick="return confirm('¿Seguro deseas eliminarlo?')"><i
                                        class="far fa-trash-alt"></i></a>
                                <a href="{{ route('edit.categoria', $categoria->categoria_id) }}" class="btn btn-warning"><i
                                        class="far fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $categorias->render() !!}
        </div>
    </div>
</x-app-layout>
