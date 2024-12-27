<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\Negocio;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNegocioRequest;
use App\Http\Requests\UpdateNegocioRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class NegocioController extends Controller
{
    /**
     * Bring all available instances of Negocio and ready them for CRUD
     */
    public function index()
    {
        $negocios = Negocio::query()
            ->with('categoria')
            ->orderBy('categoria_id')
            ->paginate(10);

        return view('negocio.index', ['negocios' => $negocios]);
    }


    /**
     * Store a new Negocio in database
     */
    public function store(StoreNegocioRequest $request)
    {
        try {
            $imagePath = $this->handleImageUpload($request);
            $data = array_merge(
                $request->validated(),
                ['imagen' => $imagePath]
            );

            $negocio = Negocio::create($data);

            session()->flash('message', 'Negocio creado con éxito');
            session()->flash('alert-class', 'success');
        } catch (\Exception $e) {
            session()->flash('message', 'Ocurrió un error: ' . $e->getMessage());
            session()->flash('alert-class', 'error');
            return to_route('negocios.index');
        }

        return to_route('negocios.index', ['negocio' => $negocio])->with('message');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();

        return view('negocio.create', compact('categorias'));

    }



    /**
     * Display the specified resource.
     */
    public function show(Negocio $negocio)
    {

        $subcategorias = Subcategoria::where('categoria_id', $negocio->categoria_id)
            ->orWhere('categoria_id', null)
            ->get();

        $subcategorias_escogidas = $negocio->subcategorias;
        return view('negocio.show', ['negocio' => $negocio, 'subcategorias' => $subcategorias, 'subcategorias_escogidas' => $subcategorias_escogidas]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Negocio $negocio)
    {
        $categorias = Categoria::all();
        $subcategorias = Subcategoria::where('categoria_id', $negocio->categoria_id)
            ->orWhere('categoria_id', null)
            ->get();
        return view('negocio.edit', ['negocio' => $negocio, 'categorias' => $categorias, 'subcategorias' => $subcategorias]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNegocioRequest $request, Negocio $negocio)
    {
        $imagePath = $this->handleImageUpload($request, $negocio);
        try {
            $data = array_merge(
                $request->validated(),
                ['imagen' => $imagePath]
            );

            $negocio->update($data);
            session()->flash('message', 'Negocio creado con exito');
            session()->flash('alert-class', 'success');
        } catch (\Exception $e) {
            session()->flash('message', 'Ocurrió un error: ' . $e->getMessage());
            session()->flash('alert-class', 'error');
        }

        return to_route('negocios.index')->with('message', 'Negocio actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Negocio $negocio)
    {
        try {
            if ($negocio->delete()) {
                // Delete is successful
                session()->flash('message', 'Negocio elimininado con exito.');
                session()->flash('alert-class', 'success');
            } else {
                // Failsafe: Something's wrong
                session()->flash('message', 'Fallo al borrar el Negocio.');
                session()->flash('alert-class', 'error');
            }
        } catch (\Exception $e) {
            // Handle exceptions
            session()->flash('message', 'Ocurrió un error: ' . $e->getMessage());
            session()->flash('alert-class', 'error');
        }

        return redirect()->route('negocios.index');
    }


    /**
     * Update the Negocio's subcategories
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Negocio $negocio
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleSubcategorias(Request $request, $negocio_id)
    {
        $negocio = Negocio::findOrFail($negocio_id);
        $subcategoriasIds = json_decode($request->subcategorias, true);
        $negocio->subcategorias()->sync($subcategoriasIds);
        
        return redirect()->back()->with('success', 'Attachments saved successfully!');
    }


    /**
     * Handle the image upload process
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    private function handleImageUpload($request, $negocio = null)
    {
        // If an image is uploaded
        if ($request->hasFile('imagen')) {
            // If an existing negocio is passed, delete the old image (if exists)
            if ($negocio && $negocio->imagen && Storage::exists($negocio->imagen)) {
                Storage::delete($negocio->imagen);
            }

            // Store the new image in the public storage folder 'images'
            return $request->file('imagen')->store('images', 'public');
        } else {
            return $negocio ? $negocio->imagen : null; // For update, keep the old image if not updated
        }
    }


    public function patchEstado(Request $request, $negocio_id)
    {
        $validated = $request->validate([
            'estado' => ['required', Rule::in(['activo', 'inactivo'])],
        ]);

        $negocio = Negocio::findOrFail($negocio_id);
        $negocio->estado = $validated['estado'];
        $negocio->save();

        return to_route('negocios.index')->with('message', 'Estado actualizado.');

    }

}
