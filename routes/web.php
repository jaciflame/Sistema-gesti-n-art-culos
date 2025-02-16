<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ContactoController;
use App\Livewire\ShowTags;
use App\Livewire\ShowUserArticles;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, "index"])->name("index");

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/articles', ShowUserArticles::class)->name('showuserarticles');
    //RESTRICCION PARA QUE SOLO ENTREN ADMIN
    Route::get('/tags', ShowTags::class)->middleware('is_admin')->name('tags.index');
    
});
//RUTAS DEL FORMULARIO DE CONTACTO
Route::get('contacto', [ContactoController::class, 'pintarFormulario'])->name('contacto.pintar');
Route::post('contacto', [ContactoController::class, 'procesarFormulario'])->name('contacto.procesar');