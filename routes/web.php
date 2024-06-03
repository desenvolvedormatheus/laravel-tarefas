<?php

use App\Http\Controllers\TarefasController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TarefasController::class, 'index'])->name('tarefas.index');

Route::post('/create', [TarefasController::class, 'create'])->name('tarefas.create');

Route::post('/destroy', [TarefasController::class, 'destroy'])->name('tarefas.destroy');

Route::post('/update', [TarefasController::class, 'update'])->name('tarefas.update');
