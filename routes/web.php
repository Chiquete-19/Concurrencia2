<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controlador;

Route::get('/', [Controlador::class, 'index'])->name('index');
Route::post('/add', [Controlador::class, 'agregarMedicamento'])->name('agragarMedicamento');
Route::post('/clear', [Controlador::class, 'limpiarReceta'])->name('limpiarReceta');
Route::get('/checkout', [Controlador::class, 'checkout'])->name('checkout');
