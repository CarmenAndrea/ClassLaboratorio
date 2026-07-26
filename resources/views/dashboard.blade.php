<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                {{-- VISTA DEL ADMINISTRADOR --}}
                @if(auth()->user()->role === 'admin')
                    <div style="background-color: #f3e8ff; border: 2px solid #d8b4fe; padding: 24px; border-radius: 12px; margin-bottom: 24px;">
                        <h2 style="font-size: 24px; font-weight: bold; color: #581c87; margin-bottom: 8px;">Panel del Administrador ⚙️</h2>
                        <p style="color: #6b21a8; margin-bottom: 20px;">Desde aquí puedes gestionar el acceso a la plataforma y dar de alta nuevos usuarios.</p>

                        <div style="background-color: #fff1f2; border: 2px solid #fecdd3; padding: 20px; border-radius: 10px; margin-bottom: 24px;">
                            <h3 style="font-size: 18px; font-weight: bold; color: #9f1239; margin-bottom: 12px;">🚨 Alertas de Restablecimiento ({{ $solicitudes->count() }})</h3>
                            
                            @if($solicitudes->isEmpty())
                                <p style="color: #9f1239; font-size: 14px; font-style: italic;">No hay solicitudes pendientes en este momento. ¡Todo al día!</p>
                            @else
                                <div style="display: flex; flex-direction: column; gap: 10px;">
                                    @foreach($solicitudes as $solicitud)
                                        <div style="background-color: #ffffff; padding: 12px 16px; border-radius: 8px; border-left: 5px solid #f43f5e; display: flex; justify-content: space-between; align-items: center;">
                                            <div>
                                                <span style="font-weight: bold; color: #1e293b; font-size: 14px;">{{ $solicitud->email }}</span>
                                                <span style="font-size: 12px; color: #64748b; margin-left: 10px;">🕒 {{ $solicitud->created_at->diffForHumans() }}</span>
                                            </div>
                                            <div style="display: flex; gap: 8px;">
                                                <button onclick="navigator.clipboard.writeText('{{ $solicitud->email }}'); alert('Correo copiado');" style="background-color: #f1f5f9; border: none; padding: 6px 12px; border-radius: 6px; cursor: pointer; font-size: 12px; font-weight: bold;">📋 Copiar</button>
                                                <form action="{{ route('password.request.destroy', $solicitud->id) }}" method="POST" style="margin: 0;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" style="background-color: #be123c; color: white; border: none; padding: 6px 12px; border-radius: 6px; cursor: pointer; font-size: 12px; font-weight: bold;">Atendido ✓</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        
                        <a href="/register" style="display: inline-block; background-color: #7e22ce; color: #ffffff; padding: 12px 24px; border-radius: 8px; font-weight: bold; text-decoration: none; margin-bottom: 24px;">
                            ➕ Registrar Nuevo Maestro o Alumno
                        </a>
                    </div>

                {{-- VISTA DEL MAESTRO --}}
                @elseif(auth()->user()->role === 'maestro')
                    <h2 style="font-size: 24px; font-weight: bold; color: #4338ca; margin-bottom: 16px;">Panel del Profesor 👨‍🏫</h2>
                    
                    @if(session('success'))
                        <div style="background-color: #dcfce7; border: 2px solid #86efac; color: #15803d; padding: 12px 16px; border-radius: 8px; font-weight: bold; margin-bottom: 24px;">
                            ✅ {{ session('success') }}
                        </div>
                    @endif

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 24px;">
                        <!-- CREAR NUEVA CLASE -->
                        <div style="background-color: #eef2ff; padding: 20px; border-radius: 12px; border: 2px solid #c7d2fe; height: fit-content;">
                            <h3 style="font-size: 18px; font-weight: bold; color: #1e1b4b; margin-bottom: 8px;">➕ Crear Nueva Clase</h3>
                            <p style="font-size: 14px; color: #475569; margin-bottom: 16px;">Escribe el nombre de la materia para abrir un nuevo salón.</p>
                            
                            <form action="{{ route('clases.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 12px;">
                                @csrf
                                <input type="text" name="nombre" placeholder="Ej. Matemáticas Mágicas" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;" required>
                                <button type="submit" style="width: 100%; background-color: #4f46e5; color: #ffffff; font-weight: bold; padding: 10px; border-radius: 6px; border: none; cursor: pointer; font-size: 14px;">
                                    Crear Clase
                                </button>
                            </form>
                        </div>

                        <!-- PUBLICAR MISION / TAREA -->
                        <div style="background-color: #f0fdf4; padding: 20px; border-radius: 12px; border: 2px solid #bbf7d0;">
                            <h3 style="font-size: 18px; font-weight: bold; color: #14532d; margin-bottom: 8px;">🎯 Crear Nueva Misión (Tarea)</h3>
                            <p style="font-size: 14px; color: #475569; margin-bottom: 16px;">Sube actividades y asigna recompensa en estrellas.</p>
                            
                            <form action="{{ route('tareas.store') }}" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 12px;">
                                @csrf
                                <div>
                                    <label style="font-size: 12px; font-weight: bold; color: #166534;">Título de la Misión:</label>
                                    <input type="text" name="titulo" placeholder="Ej. El Enigma de las Fracciones" style="width: 100%; padding: 8px; border: 1px solid #86efac; border-radius: 6px; font-size: 14px;" required>
                                </div>

                                <div>
                                    <label style="font-size: 12px; font-weight: bold; color: #166534;">Instrucciones / Descripción:</label>
                                    <textarea name="descripcion" rows="2" placeholder="Explica qué deben hacer los alumnos..." style="width: 100%; padding: 8px; border: 1px solid #86efac; border-radius: 6px; font-size: 14px;"></textarea>
                                </div>

                                <div>
                                    <label style="font-size: 12px; font-weight: bold; color: #166534;">Adjuntar Material (PDF, Imagen, Documento):</label>
                                    <input type="file" name="archivo" style="width: 100%; font-size: 12px; color: #166534;">
                                </div>

                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                                    <div>
                                        <label style="font-size: 12px; font-weight: bold; color: #166534;">Fecha Límite:</label>
                                        <input type="datetime-local" name="fecha_limite" style="width: 100%; padding: 6px; border: 1px solid #86efac; border-radius: 6px; font-size: 12px;" required>
                                    </div>
                                    <div>
                                        <label style="font-size: 12px; font-weight: bold; color: #166534;">Recompensa ⭐:</label>
                                        <input type="number" name="estrellas_recompensa" value="10" min="1" style="width: 100%; padding: 6px; border: 1px solid #86efac; border-radius: 6px; font-size: 12px;" required>
                                    </div>
                                </div>

                                <button type="submit" style="width: 100%; background-color: #16a34a; color: #ffffff; font-weight: bold; padding: 10px; border-radius: 6px; border: none; cursor: pointer; font-size: 14px; margin-top: 8px;">
                                    🚀 Lanzar Misión
                                </button>
                            </form>
                        </div>
                    </div>

                {{-- VISTA DEL ALUMNO --}}
                @else
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <h2 style="font-size: 24px; font-weight: bold; color: #ea580c;">¡Hola, {{ auth()->user()->name }}! 🎒</h2>
                        
                        <!-- TABLERO GAMIFICADO DE ESTRELLAS Y RACHA -->
                        <div style="display: flex; gap: 12px;">
                            <div style="background-color: #fef3c7; border: 2px solid #fde047; padding: 8px 16px; border-radius: 20px; font-weight: bold; color: #854d0e; display: flex; align-items: center; gap: 6px;">
                                ⭐ <span>0 Estrellas</span>
                            </div>
                            <div style="background-color: #ffedd5; border: 2px solid #fdba74; padding: 8px 16px; border-radius: 20px; font-weight: bold; color: #9a3412; display: flex; align-items: center; gap: 6px;">
                                🔥 <span>0 Días de Racha</span>
                            </div>
                        </div>
                    </div>

                    <div style="background-color: #fff7ed; padding: 24px; border-radius: 12px; border: 3px dashed #fed7aa;">
                        <h3 style="font-size: 18px; font-weight: 900; color: #9a3412; margin-bottom: 16px;">🚀 Tus Misiones Pendientes:</h3>
                        
                        @php
                            $tareas = \App\Models\Tarea::orderBy('fecha_limite', 'asc')->get();
                        @endphp

                        @if($tareas->isEmpty())
                            <p style="color: #c2410c; font-style: italic;">🎉 ¡No tienes misiones pendientes por ahora! Descansa un poco.</p>
                        @else
                            <div style="display: flex; flex-direction: column; gap: 12px;">
                                @foreach($tareas as $tarea)
                                    <div style="background-color: #ffffff; padding: 16px; border-radius: 10px; border-left: 6px solid #f97316; box-shadow: 0 2px 4px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center;">
                                        <div>
                                            <h4 style="font-size: 16px; font-weight: bold; color: #1c1917;">{{ $tarea->titulo }}</h4>
                                            <p style="font-size: 13px; color: #57534e; margin-top: 4px;">{{ $tarea->descripcion }}</p>
                                            
                                            <div style="display: flex; gap: 16px; margin-top: 8px; font-size: 12px; font-weight: bold;">
                                                <span style="color: #dc2626;">⏳ Límite: {{ \Carbon\Carbon::parse($tarea->fecha_limite)->format('d/m/Y h:i A') }}</span>
                                                <span style="color: #d97706;">⭐ +{{ $tarea->estrellas_recompensa }} Estrellas</span>
                                            </div>

                                            @if($tarea->archivo)
                                                <a href="{{ asset('storage/' . $tarea->archivo) }}" target="_blank" style="display: inline-block; margin-top: 8px; color: #2563eb; font-size: 12px; text-decoration: underline; font-weight: bold;">
                                                    📎 Descargar Archivo Adjunto
                                                </a>
                                            @endif
                                        </div>

                                        <button style="background-color: #f97316; color: white; border: none; padding: 10px 18px; border-radius: 8px; font-weight: bold; cursor: pointer; font-size: 13px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                            Entregar Misión 🎯
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>