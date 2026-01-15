<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/individuals');
});

// Rotas para as views do CRUD de Individuals
Route::view('/individuals', 'individuals.index')->name('individuals.index');
Route::view('/individuals/create', 'individuals.create')->name('individuals.create');
Route::get('/individuals/{id}', fn($id) => view('individuals.show'))->name('individuals.show');
Route::get('/individuals/{id}/edit', fn($id) => view('individuals.edit'))->name('individuals.edit');