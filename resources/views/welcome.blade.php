<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Plataforma Educativa 🚀</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,800&display=swap" rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Figtree', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f0f4ff 0%, #e0e7ff 100%);
            min-height: 100vh;
            color: #1e293b;
            display: flex;
            flex-direction: column;
        }

        /* NAVBAR */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .logo {
            font-size: 1.25rem;
            font-weight: 800;
            color: #4f46e5;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .btn-primary {
            text-decoration: none;
            color: #ffffff;
            font-weight: 700;
            padding: 10px 22px;
            border-radius: 10px;
            background: #4f46e5;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background: #4338ca;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(79, 70, 229, 0.4);
        }

        /* HERO SECTION */
        .hero {
            max-width: 1000px;
            margin: 60px auto 40px auto;
            text-align: center;
            padding: 0 20px;
        }

        .badge {
            display: inline-block;
            background: #e0e7ff;
            color: #4338ca;
            padding: 8px 18px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 0.9rem;
            margin-bottom: 20px;
            border: 1px solid #c7d2fe;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .hero h1 span {
            color: #4f46e5;
            background: linear-gradient(90deg, #4f46e5, #7c3aed);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero p {
            font-size: 1.2rem;
            color: #64748b;
            max-width: 700px;
            margin: 0 auto 36px auto;
            line-height: 1.6;
        }

        .btn-hero {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: #ffffff;
            font-size: 1.15rem;
            font-weight: 800;
            padding: 16px 36px;
            border-radius: 14px;
            text-decoration: none;
            box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.5);
            transition: all 0.2s ease;
        }

        .btn-hero:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px -5px rgba(79, 70, 229, 0.6);
        }

        /* FEATURES CARDS */
        .features {
            max-width: 1100px;
            margin: 40px auto 60px auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            padding: 0 20px;
        }

        .card {
            background: #ffffff;
            padding: 28px;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px -5px rgba(0,0,0,0.1);
        }

        .card-icon {
            font-size: 2.5rem;
            margin-bottom: 16px;
        }

        .card h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .card p {
            color: #64748b;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        footer {
            margin-top: auto;
            text-align: center;
            padding: 24px;
            color: #94a3b8;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <header>
        <a href="/" class="logo">
            🎮 Class Laboratorio
        </a>
        <div>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-primary">Ir al Dashboard ⚙️</a>
                @else
                    <a href="{{ route('login') }}" class="btn-primary">Iniciar Sesión</a>
                @endauth
            @endif
        </div>
    </header>

    <!-- HERO SECTION -->
    <section class="hero">
        <span class="badge">🚀 ¡Aprender nunca fue tan divertido!</span>
        <h1>Convierte el conocimiento en <span>Superpoderes</span></h1>
        <p>Bienvenido a la plataforma interactiva donde cada tarea se transforma en una misión espacial y cada logro te acerca al siguiente nivel escolar.</p>
        
        @auth
            <a href="{{ url('/dashboard') }}" class="btn-hero">
                ¡CONTINUAR AVENTURA! 🚀
            </a>
        @else
            <a href="{{ route('login') }}" class="btn-hero">
                ¡INICIAR SESIÓN! ✨
            </a>
        @endauth
    </section>

    <!-- TARJETAS INFORMATIVAS -->
    <section class="features">
        <div class="card">
            <div class="card-icon">🎯</div>
            <h3>Misiones Clave</h3>
            <p>Accede a tus tareas asignadas y completa desafíos diseñados para potenciar tus habilidades.</p>
        </div>

        <div class="card">
            <div class="card-icon">👨‍🏫</div>
            <h3>Clases en Vivo</h3>
            <p>Sigue el material publicado por tus profesores y mantente al día con tu grupo escolar.</p>
        </div>

        <div class="card">
            <div class="card-icon">🏆</div>
            <h3>Recompensas</h3>
            <p>Gana reconocimiento por tus entregas a tiempo y visualiza tu progreso en tiempo real.</p>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <p>© {{ date('Y') }} Plataforma Educativa - Todos los derechos reservados.</p>
    </footer>

</body>
</html>