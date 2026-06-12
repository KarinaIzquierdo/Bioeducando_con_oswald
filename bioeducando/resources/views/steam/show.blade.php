<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $proyecto->titulo }} - Proyectos STEAM</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #f0fdf4; min-height: 100vh; }
        .sidebar { width: 260px; background-color: #6ab06a; display: flex; flex-direction: column; padding: 20px; position: fixed; height: 100vh; z-index: 1000; }
        .sidebar-title { font-size: 2.2rem; font-weight: 600; color: #000; margin-bottom: 40px; padding-left: 10px; }
        .menu-item { display: flex; align-items: center; padding: 12px 15px; color: white; text-decoration: none; margin-bottom: 10px; border-radius: 10px; transition: 0.3s; }
        .menu-item i { margin-right: 12px; width: 20px; }
        .menu-item.active { background-color: #3d5a44; }
        .main-content { margin-left: 260px; min-height: 100vh; display: flex; flex-direction: column; }
        .top-bar { height: 100px; background-color: #744d2d; display: flex; align-items: center; padding: 0 40px; color: white; }
        .top-bar h2 { font-size: 1.8rem; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; }
        .container { padding: 40px; max-width: 1000px; margin: 0 auto; width: 100%; }
        .btn-back { display: inline-flex; align-items: center; gap: 8px; color: #1a3a2a; text-decoration: none; font-weight: 700; margin-bottom: 30px; transition: 0.3s; }
        .btn-back:hover { color: #6ab06a; transform: translateX(-5px); }
        .project-detail-card { background: white; border-radius: 30px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .project-hero-img { width: 100%; height: 400px; object-fit: cover; }
        .project-content { padding: 40px; }
        .project-badge { background: #e8f5e9; color: #2e7d32; padding: 8px 20px; border-radius: 50px; font-weight: 800; font-size: 0.8rem; text-transform: uppercase; display: inline-block; margin-bottom: 20px; }
        .project-title { font-size: 2.5rem; color: #1a3a2a; font-weight: 800; margin-bottom: 25px; }
        .project-description-text { color: #475569; font-size: 1.1rem; line-height: 1.8; white-space: pre-line; }
        .sidebar-footer { margin-top: auto; display: flex; flex-direction: column; align-items: center; gap: 15px; padding: 20px 0; width: 100%; }
        .sidebar-logo { width: 140px; filter: brightness(0); margin-bottom: 5px; }
        .btn-logout { width: 100%; padding: 12px; background-color: #000; color: white; border: none; border-radius: 10px; cursor: pointer; display: flex; align-items: center; justify-content: center; font-weight: 600; transition: 0.3s; text-transform: lowercase; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h1 class="sidebar-title">Usuario</h1>
        <nav>
            <a href="{{ route('profile.edit') }}" class="menu-item">
                <i data-lucide="user"></i> Perfil
            </a>
            <a href="{{ route('retos.publica') }}" class="menu-item">
                <i data-lucide="leaf"></i> Retos Ecológicos
            </a>
            <a href="{{ route('comunidad.publica') }}" class="menu-item">
                <i data-lucide="flower-2"></i> Comunidad Ambiental
            </a>
            <a href="{{ route('contenido.creacion') }}" class="menu-item">
                <i data-lucide="clapperboard"></i> Eco-Estudio
            </a>
            <a href="{{ route('steam.proyectos') }}" class="menu-item active">
                <i data-lucide="microscope"></i> Proyectos STEAM
            </a>
            <a href="{{ route('prae.proyectos') }}" class="menu-item">
                <i data-lucide="book-open"></i> Proyectos PRAE
            </a>
        </nav>
        <div class="sidebar-footer">
            <img src="/imagenes/Logo.svg" alt="Logo" class="sidebar-logo">
            <form action="{{ route('logout') }}" method="POST" style="width: 100%;">
                @csrf
                <button type="submit" class="btn-logout">cerrar sesión</button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <div class="top-bar">
            <h2>Detalles del Proyecto</h2>
            <div class="profile-icon-container">
                @if(Auth::user()->avatar)
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Perfil" style="border-radius: 50%; width: 50px; height: 50px; object-fit: cover;">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=fff&color=744d2d&size=50" alt="Perfil" style="border-radius: 50%; width: 50px; height: 50px;">
                @endif
            </div>
        </div>

        <div class="container">
            <a href="{{ route('steam.proyectos') }}" class="btn-back">
                <i data-lucide="arrow-left"></i> Volver a Proyectos
            </a>

            <div class="project-detail-card">
                @if($proyecto->imagen)
                    <img src="{{ asset('storage/' . $proyecto->imagen) }}" alt="{{ $proyecto->titulo }}" class="project-hero-img">
                @else
                    <div style="height: 300px; background: #eee; display: flex; align-items: center; justify-content: center;">
                        <i data-lucide="image" size="64" color="#ccc"></i>
                    </div>
                @endif
                
                <div class="project-content">
                    <span class="project-badge">{{ $proyecto->categoria }}</span>
                    <h1 class="project-title">{{ $proyecto->titulo }}</h1>
                    <div class="project-description-text">
                        {{ $proyecto->descripcion }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>
