<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ExplorerController;
use App\Http\Controllers\NegocioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubcategoriaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/explorar', action: [ExplorerController::class, 'index'])->name('explore.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('categorias', CategoriaController::class);
    Route::resource('subcategorias', SubcategoriaController::class);
    Route::resource('negocios', NegocioController::class);
    // Ruta para hotswap de estado de negocio
    Route::patch('/negocios/{id}/toggle-estado', [NegocioController::class, 'patchEstado'])->name('negocios.toggleEstado');
    // Ruta para etiquetar con subcategorias un negocio
    Route::put('/negocios/{id}/handle-subcategorias', [NegocioController::class, 'handleSubcategorias'])->name('negocios.handleSubcategorias');

});

require __DIR__ . '/auth.php';
