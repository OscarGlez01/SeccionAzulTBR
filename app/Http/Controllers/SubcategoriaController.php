<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Http\Requests\StoreSubcategoriaRequest;
use App\Http\Requests\UpdateSubcategoriaRequest;

class SubcategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategorias = Subcategoria::query()
            ->with('categoria')
            ->orderBy('categoria_id')
            ->paginate(10);

        return view('subcategoria.index', ['subcategorias' => $subcategorias]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubcategoriaRequest $request)
    {
        try {
            if ($subcategoria = Subcategoria::create($request->validated())) {
                session()->flash('message', 'Subcategoría creada con exito');
                session()->flash('alert-class', 'success');
            } else {
                session()->flash('message', 'Fallo al crear la subcategoría');
                session()->flash('alert-class', 'error');
            }
        } catch (\Exception $e) {
            session()->flash('message', 'Ocurrió un error' . $e->getMessage());
            session()->flash('alert-class', 'error');
        }
        return to_route('subcategorias.index', $subcategoria)->with('message', 'Sub-categoría añadida');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categorias = Categoria::all();

        return view('subcategoria.create', compact('categorias'));
    }



    /**
     * Display the specified resource.
     */
    public function show(Subcategoria $subcategoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcategoria $subcategoria)
    {
        $categorias = Categoria::all();
        return view('subcategoria.edit', ['subcategoria'=>$subcategoria, 'categorias'=>$categorias]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubcategoriaRequest $request, Subcategoria $subcategoria)
    {
        try {
            if ($subcategoria->update($request->validated())) {
                // Update is successful
                session()->flash('message', 'Sub categoría actualizada con exito.');
                session()->flash('alert-class', 'success');
            } else {
                // Failsafe: Something's wrong
                session()->flash('message', 'Fallo al editar la subcategoría.');
                session()->flash('alert-class', 'error');
            }
        } catch (\Exception $e) {
            // Handle exceptions
            session()->flash('message', 'Ocurrió un error: ' . $e->getMessage());
            session()->flash('alert-class', 'error');
        }

        return to_route('subcategorias.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategoria $subcategoria)
    {
        try {
            if ($subcategoria->delete()) {
                // Delete is successful
                session()->flash('message', 'Sub-Categoría elimininada con exito.');
                session()->flash('alert-class', 'success');
            } else {
                // Failsafe: Something's wrong
                session()->flash('message', 'Fallo al borrar la sub-categoría.');
                session()->flash('alert-class', 'error');
            }
        } catch (\Exception $e) {
            // Handle exceptions
            session()->flash('message', 'Ocurrió un error: ' . $e->getMessage());
            session()->flash('alert-class', 'error');
        }

        return redirect()->route('subcategorias.index');
    }
}
