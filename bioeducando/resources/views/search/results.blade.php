<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de búsqueda - Bioeducando</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #f0f2f0; min-height: 100vh; }

        .navbar {
            background-color: #3d5a44;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 50px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .search-container {
            position: relative;
            width: 320px;
        }

        .search-container input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border-radius: 30px;
            border: none;
            background-color: #f0f0f0;
            font-size: 1.1rem;
            outline: none;
        }

        .search-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
            width: 20px;
            height: 20px;
        }

        .container {
            max-width: 1000px;
            margin: 110px auto 40px;
            padding: 0 20px;
        }

        .results-header {
            margin-bottom: 30px;
            color: #1a3a2a;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 800;
            margin: 40px 0 20px;
            color: #3d5a44;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Estilo de Retos (simplificado de la vista de retos) */
        .reto-card {
            background: white;
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border-left: 6px solid #6ab06a;
        }

        /* Estilo de Publicaciones (simplificado de comunidad) */
        .post-card {
            background: white;
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        .no-results {
            text-align: center;
            padding: 60px;
            background: white;
            border-radius: 30px;
            color: #666;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: white;
            text-decoration: none;
            font-weight: 600;
            background: rgba(255,255,255,0.1);
            padding: 8px 15px;
            border-radius: 12px;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="/" class="back-btn">
            <i data-lucide="chevron-left"></i> Volver
        </a>
        <form action="{{ route('search') }}" method="GET" class="search-container">
            <i data-lucide="search" class="search-icon"></i>
            <input type="text" name="query" placeholder="Buscar" value="{{ $query }}">
        </form>
        <div style="width: 100px;"></div>
    </nav>

    <div class="container">
        <div class="results-header">
            <h1>Resultados para: "{{ $query }}"</h1>
        </div>

        @if($retos->isNotEmpty())
            <h2 class="section-title"><i data-lucide="leaf"></i> Retos encontrados</h2>
            @foreach($retos as $reto)
                <div class="reto-card">
                    <h3>{{ $reto->titulo }}</h3>
                    <p>{{ Str::limit($reto->descripcion, 150) }}</p>
                    <a href="{{ route('retos.publica') }}" style="color: #6ab06a; font-weight: 600; text-decoration: none; margin-top: 10px; display: inline-block;">Ver en retos →</a>
                </div>
            @endforeach
        @endif

        @if($publicaciones->isNotEmpty())
            <h2 class="section-title"><i data-lucide="users"></i> Comunidad ambiental</h2>
            @foreach($publicaciones as $post)
                <div class="post-card">
                    <div style="font-weight: 700; color: #1a3a2a; margin-bottom: 10px;">{{ $post->user->name }}</div>
                    <p>{{ $post->contenido }}</p>
                    <a href="{{ route('comunidad.publica') }}" style="color: #6ab06a; font-weight: 600; text-decoration: none; margin-top: 10px; display: inline-block;">Ver en comunidad →</a>
                </div>
            @endforeach
        @endif

        @if($retos->isEmpty() && $publicaciones->isEmpty())
            <div class="no-results">
                <i data-lucide="search-x" size="48" style="margin-bottom: 20px;"></i>
                <h2>No encontramos nada para "{{ $query }}"</h2>
                <p>Intenta con otras palabras clave.</p>
            </div>
        @endif
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
