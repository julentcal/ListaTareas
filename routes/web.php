<?php

use App\Http\Controllers\TaskController;

Route::get('/', [TaskController::class, 'index']);
// Fíjate que usamos 'post' en lugar de 'get' y llamamos a la función 'store'
Route::post('/tasks', [TaskController::class, 'store']);
// Ruta para actualizar (usamos PATCH para modificaciones parciales)
Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggle'])->name('tasks.toggle');
Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
Route::put('/tasks/{id}', [TaskController::class, 'update']);
