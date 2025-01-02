<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use Illuminate\Support\Facades\Storage;

class CategoriaController extends Controller
{
    /**
     * Despliega las categorias disponibles.
     */
    public function index()
    {
        $categorias = Categoria::query()
            ->orderBy('categoria_id')
            ->paginate(6);
        return view('categoria.index', ['categorias' => $categorias]);
    }

    /**
     * Crea una instancia nueva de Categoria y la almacena en la base de datos
     */
    public function store(StoreCategoriaRequest $request)
    {
        try {
            $imagePath = $this->handleImageUpload($request);
            $data = array_merge(
                $request->validated(),
                ['banner' => $imagePath]
            );
            $categoria = Categoria::create($data);

            session()->flash('message', 'Categoría creada con exito.');
            session()->flash('alert-class', 'success');
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
        $iconosDisponibles = [
            'fa-solid fa-user',
            'fa-solid fa-cog',
            'fa-solid fa-heart',
            'fa-solid fa-check',
            'fa-solid fa-camera',
        ];
        return view('categoria.create', ['iconosDisponibles' => $iconosDisponibles] );
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

            $imagePath = $this->handleImageUpload($request, $categoria);

            $data = array_merge(
                $request->validated(),
                ['banner' => $imagePath]
            );

            $categoria->update($data);

            // Update is successful
            session()->flash('message', 'Categoría actualizada con exito.');
            session()->flash('alert-class', 'success');

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

    /**
     * Summary of handleImageUpload
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    private function handleImageUpload($request, $categoria = null)
    {
        // If an image is uploaded
        if ($request->hasFile('banner')) {
          
            // If an existing negocio is passed, delete the old image (if exists)
            if ($categoria && $categoria->banner && Storage::exists($categoria->banner)) {
                Storage::delete($categoria->banner);
            }

            // Store the new image in the public storage folder 'images'
            return $request->file('banner')->store('images/banners', 'public');
        } else {
            return $categoria ? $categoria->banner : null; // For update, keep the old image if not updated
        }
    }

}