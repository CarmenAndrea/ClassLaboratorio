<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plataforma Educativa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-indigo-50 font-sans antialiased text-gray-800">

   
    <nav class="bg-white shadow-md px-6 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            
            <span class="text-3xl">🎮</span>
            <span class="text-2xl font-bold text-indigo-600 tracking-wide">Class Laboratorio</span>
        </div>

        @if (Route::has('login'))
            <div class="space-x-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-indigo-600 transition">Panel de Control</a>
                @else
                    <a href="{{ route('login') }}" class="inline-block px-4 py-2 text-indigo-600 font-semibold rounded-lg hover:bg-indigo-50 transition">Iniciar Sesión</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="inline-block px-5 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow hover:bg-indigo-700 transition">Registrarse</a>
                    @endif
                @endauth
            </div>
        @endif
    </nav>


    <main class="max-w-4xl mx-auto text-center mt-20 px-4">
        <h1 class="text-5xl font-extrabold text-indigo-900 mb-6 leading-tight">
            ¡Aprender nunca fue tan divertido! 🚀
        </h1>
        <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
            Bienvenido a la plataforma donde las tareas se convierten en misiones y el conocimiento en superpoderes. ¿Estás listo para iniciar tu aventura escolar?
        </p>

        
        <div class="mt-4">
            <a href="{{ route('register') }}" class="inline-block px-8 py-4 bg-yellow-400 hover:bg-yellow-500 text-indigo-950 font-black text-xl rounded-full shadow-lg transform hover:scale-105 transition-all uppercase tracking-wider">
                ¡Comenzar Desafío! ✨
            </a>
        </div>
    </main>


    <div class="absolute bottom-4 left-4 text-4xl opacity-30 select-none">🧩</div>
    <div class="absolute top-24 right-12 text-4xl opacity-30 select-none">🎨</div>
    <div class="absolute bottom-12 right-6 text-4xl opacity-30 select-none">🚀</div>

</body>
</html>