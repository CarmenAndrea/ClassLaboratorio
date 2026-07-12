<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if(auth()->user()->role === 'maestro')
                    
                    <h2 class="text-2xl font-bold text-indigo-700 mb-4">Panel del Profesor 👨‍🏫</h2>
                    
                    @if(session('success'))
                        <div class="bg-green-500 text-white p-4 rounded-lg mb-6 font-bold shadow-sm flex items-center">
                            ✅ {{ session('success') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div class="bg-indigo-50 p-4 rounded-lg border-2 border-indigo-200 shadow-sm">
                            <h3 class="font-bold text-lg mb-2">➕ Crear Nueva Clase</h3>
                            <p class="text-sm text-gray-600 mb-4">Escribe el nombre de la materia para abrir un nuevo salón.</p>
                            
                            <form action="{{ route('clases.store') }}" method="POST" class="space-y-3">
                                @csrf
                                <div>
                                    <input 
                                        type="text" 
                                        name="nombre" 
                                        placeholder="Ej. Programación Web" 
                                        class="w-full p-2.5 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white text-gray-900" 
                                        required
                                    >
                                </div>
                                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded transition text-sm shadow">
                                    Crear Clase
                                </button>
                            </form>
                        </div>

                        <div class="bg-green-50 p-4 rounded-lg border-2 border-green-200 shadow-sm">
                            <h3 class="font-bold text-lg">📤 Subir Tarea</h3>
                            <p class="text-sm text-gray-600 mb-4">Publica misiones o retos para tus alumnos.</p>
                            <button class="mt-8 w-full bg-green-600 text-white font-bold py-2 px-4 rounded cursor-not-allowed opacity-60 text-sm shadow" disabled>
                                Próximamente...
                            </button>
                        </div>
                    </div>

                @else
                    
                    <h2 class="text-2xl font-bold text-orange-600 mb-4">¡Hola, Alumno! 🎒</h2>
                    <div class="bg-orange-50 p-6 rounded-xl border-4 border-dashed border-orange-200">
                        <h3 class="text-xl font-black">🚀 Tus Misiones Pendientes:</h3>
                        <ul class="mt-4 space-y-2">
                            <li class="bg-white p-3 rounded shadow-sm border-l-4 border-orange-500">
                                ✨ Tarea 1: Sumas Espaciales - <span class="text-blue-500 font-bold">Ver más</span>
                            </li>
                        </ul>
                    </div>

                @endif

            </div>
        </div>
    </div>
</x-app-layout>
