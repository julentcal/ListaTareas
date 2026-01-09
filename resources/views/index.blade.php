<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Tareas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .completed-text {
            text-decoration: line-through;
            color: #9CA3AF; 
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center py-10 px-4">

    <div class="bg-white w-full max-w-md rounded-2xl shadow-xl overflow-hidden">
        
        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-6 text-center">
            <h1 class="text-3xl font-bold text-white tracking-wide">Mis Tareas</h1>
            <p class="text-blue-100 mt-1 text-sm">Organiza tu día, paso a paso</p>
        </div>

        <div class="p-6">
            
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm" role="alert">
                    <p class="font-bold">Atención</p>
                    <ul class="list-disc pl-5 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/tasks" method="POST" class="mb-8">
                @csrf
                <div class="relative">
                    <input type="text" name="name" 
                        class="w-full pl-4 pr-14 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition shadow-sm placeholder-gray-400" 
                        placeholder="¿Qué tienes pendiente hoy?">
                    
                    <button type="submit" 
                        class="absolute right-2 top-2 bottom-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg px-4 transition duration-200 font-medium text-sm shadow-md">
                        Add
                    </button>
                </div>
            </form>

            <ul class="space-y-3">
                @foreach ($tasks as $task)
                    <li class="flex items-center justify-between p-4 bg-white border border-gray-100 rounded-xl shadow-sm hover:shadow-md transition duration-200 group">
                        
                        <span class="text-gray-700 font-medium {{ $task->is_completed ? 'completed-text' : '' }} break-all pr-4">
                            {{ $task->name }}
                        </span>

                        <div class="flex items-center space-x-2 opacity-100 md:opacity-0 md:group-hover:opacity-100 transition-opacity duration-200">
                            
                            <form action="/tasks/{{ $task->id }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="p-2 rounded-full hover:bg-green-100 text-gray-400 hover:text-green-600 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </button>
                            </form>

                            <form action="/tasks/{{ $task->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 rounded-full hover:bg-red-100 text-gray-400 hover:text-red-600 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach

                @if ($tasks->count() == 0)
                    <div class="text-center py-10">
                        <p class="text-gray-400 text-sm">🎉 ¡Todo limpio! No hay tareas pendientes.</p>
                    </div>
                @endif
            </ul>
        </div>
        
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 text-center">
            <p class="text-xs text-gray-400">Hecho con Laravel por Julia</p>
        </div>

    </div>

</body>
</html>
