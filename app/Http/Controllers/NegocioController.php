<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Negocio;
use App\Http\Requests\StoreNegocioRequest;
use App\Http\Requests\UpdateNegocioRequest;
use Illuminate\Support\Facades\Storage;

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
        $imagePath = $this->handleImageUpload($request);

        try {
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Negocio $negocio)
    {
        $categorias = Categoria::all();
        return view('negocio.edit', ['negocio' => $negocio, 'categorias' => $categorias]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNegocioRequest $request, Negocio $negocio)
    {
        $imagePath = $this->handleImageUpload($request);

        try {
            $data = array_merge(
                $request->validated(),
                ['imagen' => $imagePath]
            );

            $negocio = Negocio::update($data);
            session()->flash('message', 'Negocio creado con exito');
            session()->flash('alert-class', 'success');
        } catch (\Exception $e) {
            session()->flash('message', 'Ocurrió un error: ' . $e->getMessage());
            session()->flash('alert-class', 'error');
        }

        return to_route('negocios.index')->with('message', 'Negocio añadido.');
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
            if ($negocio && $negocio->imagen && Storage::exists('public/' . $negocio->imagen)) {
                Storage::delete('public/' . $negocio->imagen);
            }

            // Store the new image in the public storage folder 'images'
            return $request->file('imagen')->store('images', 'public');
        }

        // If no image is uploaded, return null (no change for update)
        return $negocio ? $negocio->imagen : null; // For update, keep the old image if not updated
    }

}
