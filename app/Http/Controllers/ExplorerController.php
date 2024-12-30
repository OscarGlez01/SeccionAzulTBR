<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class ExplorerController extends Controller
{

    public function index()
    {
        $categorias = Categoria::query()->orderBy('categoria_id')->get();
        return view('explorer', ['categorias' => $categorias]);

    }
}
