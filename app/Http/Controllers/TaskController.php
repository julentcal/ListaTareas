<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task; 

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all(); 

        return view('index', ['tasks' => $tasks]);
    }

    public function store(Request $request)
    {
       // 👇 1. VALIDACIÓN: 
        // 'required': no puede estar vacío.
        // 'min:3': debe tener al menos 3 letras.
        $request->validate([
            'name' => 'required|min:3'
        ]);

        // Si la validación falla, Laravel se detiene aquí y te devuelve atrás automáticamente.
        // Si pasa, sigue con el código de abajo:

        $task = new Task;
        $task->name = $request->name;
        $task->save();

        return redirect('/');
    }

    public function destroy($id)
    {
        // 1. Buscamos la tarea en la base de datos por su ID
        $task = Task::find($id);

        // 2. La eliminamos
        $task->delete();

        // 3. Volvemos a la página principal
        return redirect('/');
    }

    public function update($id)
    {
        $task = Task::find($id);

        // 👇 LA MAGIA: Invertimos el valor.
        // Si es false, se vuelve true. Si es true, se vuelve false.
        $task->is_completed = ! $task->is_completed;
        
        $task->save();

        return redirect('/');


    }

}
