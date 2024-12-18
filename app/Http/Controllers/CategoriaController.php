<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;

class CategoriaController extends Controller
{
    /**
     * Despliega las categorias disponibles.
     */
    public function index()
    {
        $categorias = Categoria::query()
            ->orderBy('categoria_id')
            ->paginate(10);
        return view('categoria.index', ['categorias' => $categorias]);
    }

    /**
     * Crea una instancia nueva de Categoria y la almacena en la base de datos
     */
    public function store(StoreCategoriaRequest $request)
    {
        try {
            if ($categoria = Categoria::create($request->validated())) {
                // Update is successful
                session()->flash('message', 'Categoría creada con exito.');
                session()->flash('alert-class', 'success');
            } else {
                // Failsafe: Something's wrong
                session()->flash('message', 'Fallo al crear la categoría.');
                session()->flash('alert-class', 'error');
            }
        } catch (\Exception $e) {
            session()->flash('message', 'Ocurrió un error: ' . $e->getMessage());
            session()->flash('alert-class', 'error');
        }
        return to_route('categorias.index', $categoria)->with('message', 'Categoria Añadida.');
    }

    /**
     * Despliega la vista para crear una nueva instancia de Categoria
     */
    public function create()
    {
        return view('categoria.create');
    }



    /**
     * Obtiene una sola instancia de categoría y la muestra, así cómo sus sub-categorias.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Actualiza una instancia concreta de categoría con nueva data
     */
    public function update(UpdateCategoriaRequest $request, Categoria $categoria)
    {
        try {
            if ($categoria->update($request->validated())) {
                // Update is successful
                session()->flash('message', 'Categoría actualizada con exito.');
                session()->flash('alert-class', 'success');
            } else {
                // Failsafe: Something's wrong
                session()->flash('message', 'Fallo al editar la categoría.');
                session()->flash('alert-class', 'error');
            }
        } catch (\Exception $e) {
            // Handle exceptions
            session()->flash('message', 'Ocurrió un error: ' . $e->getMessage());
            session()->flash('alert-class', 'error');
        }
        return to_route('categorias.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        return view('categoria.edit', ['categoria' => $categoria]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {

        try {
            if ($categoria->delete()) {
                // Delete is successful
                session()->flash('message', 'Categoría elimininada con exito.');
                session()->flash('alert-class', 'success');
            } else {
                // Failsafe: Something's wrong
                session()->flash('message', 'Fallo al borrar la categoría.');
                session()->flash('alert-class', 'error');
            }
        } catch (\Exception $e) {
            // Handle exceptions
            session()->flash('message', 'Ocurrió un error: ' . $e->getMessage());
            session()->flash('alert-class', 'error');
        }

        return redirect()->route('categorias.index');
    }
}