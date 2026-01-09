<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarea</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center py-10 px-4">

    <div class="bg-white w-full max-w-md rounded-2xl shadow-xl overflow-hidden">
        
        <div class="bg-gradient-to-r from-purple-500 to-pink-600 p-6 text-center">
            <h1 class="text-3xl font-bold text-white tracking-wide">Editar Tarea</h1>
        </div>

        <div class="p-6">
            <form action="/tasks/{{ $task->id }}" method="POST">
                @csrf
                @method('PUT')

                <label class="block text-gray-700 text-sm font-bold mb-2">Nombre de la tarea:</label>
                
                <input type="text" name="name" value="{{ $task->name }}" 
                    class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 mb-4" 
                    autofocus>

                <div class="flex gap-2">
                    <a href="/" class="w-1/2 text-center py-3 bg-gray-200 text-gray-700 rounded-xl font-bold hover:bg-gray-300 transition">
                        Cancelar
                    </a>
                    <button type="submit" class="w-1/2 py-3 bg-purple-600 text-white rounded-xl font-bold hover:bg-purple-700 transition">
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>