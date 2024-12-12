<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Category') }}
        </h2>
    </x-slot>

    <div class="mx-auto my-5 max-w-screen-lg">
        <h1 class="text-xl text-black dark:text-white ">Añadir un registro</h1>
        <hr class="my-4 border-gray-800 dark:border-neutral-400">
        <form action="" class="bg-gray-100 border border-gray-400 rounded px-8 pt-6 pb-8 mb-4 dark:bg-slate-900 dark:border-neutral-400">
            <div class="mb-4">
                <label class="form-crud-label" for="nombre">
                    {{ __('Name')}}
                </label>
                <input
                    class="form-crud-input"
                    id="nombre" type="text" placeholder="Nombre de la categoría" />
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre">
                    {{__('Description')}}
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:ring"
                    id="nombre" type="text" placeholder="Describe la categoría" />
            </div>
            <div class="mb-2">
                <button class="btn btn-add">{{__('Create')}}</button>
            </div>
        </form>
    </div>

</x-app-layout>
