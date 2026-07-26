<x-guest-layout>
    <!-- Session Status / Alertas dinámicas -->
    @if(session('status'))
        <div class="mb-4 font-medium text-sm {{ str_contains(session('status'), 'éxito') ? 'text-green-600 bg-green-50 border-green-200' : 'text-amber-600 bg-amber-50 border-amber-200' }} p-3 rounded-md border">
            {{ session('status') }}
        </div>
    @endif

    <!-- Mostrar errores de validación (como si el correo no existe) -->
    <x-input-error :messages="$errors->get('email')" class="mb-4" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <!-- SECCIÓN MODIFICADA: Solicitud directa al Administrador para Alumnos/Maestros -->
    <div class="mt-6 pt-6 border-t border-gray-200 text-center">
        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">
            ¿Eres Alumno o Maestro y olvidaste tu clave?
        </p>
        
        <form action="{{ route('admin.password.request') }}" method="POST" class="space-y-2">
            @csrf
            <div class="flex flex-col sm:flex-row gap-2 justify-center items-center">
                <input 
                    type="email" 
                    name="email" 
                    placeholder="Ingresa tu correo escolar" 
                    class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm p-2 w-full max-w-xs text-gray-900" 
                    required
                >
                <button 
                    type="submit" 
                    class="w-full sm:w-auto bg-purple-600 hover:bg-purple-700 text-white font-bold text-xs py-2 px-4 rounded-md shadow transition"
                >
                    🔔 Solicitar al Admin
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>