<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectos PRAE - Bioeducando</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #f0fdf4; min-height: 100vh; }
        .sidebar { width: 260px; background-color: #6ab06a; display: flex; flex-direction: column; padding: 20px; position: fixed; height: 100vh; z-index: 1000; }
        .sidebar-title { font-size: 2.2rem; font-weight: 600; color: #000; margin-bottom: 40px; padding-left: 10px; }
        .menu-item { display: flex; align-items: center; padding: 12px 15px; color: white; text-decoration: none; margin-bottom: 10px; border-radius: 10px; transition: 0.3s; font-size: 1rem; }
        .menu-item i { margin-right: 12px; width: 20px; }
        .menu-item.active { background-color: #3d5a44; }
        .menu-item:hover:not(.active) { background-color: rgba(255,255,255,0.1); }
        .sidebar-footer { margin-top: auto; display: flex; flex-direction: column; align-items: center; gap: 15px; padding: 20px 0; width: 100%; }
        .sidebar-logo { width: 140px; filter: brightness(0); margin-bottom: 5px; }
        .btn-logout { width: 100%; padding: 12px; background-color: #000; color: white; border: none; border-radius: 10px; cursor: pointer; display: flex; align-items: center; justify-content: center; font-weight: 600; transition: 0.3s; text-transform: lowercase; }
        .main-content { margin-left: 260px; min-height: 100vh; display: flex; flex-direction: column; }
        .top-bar { height: 100px; background-color: #744d2d; display: flex; align-items: center; justify-content: space-between; padding: 0 40px; color: white; }
        .top-bar h2 { font-size: 1.8rem; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; }
        .profile-icon-container { background: white; padding: 5px; border-radius: 50%; display: flex; align-items: center; justify-content: center; }
        .container { padding: 40px; flex: 1; }
        .header-content { margin-bottom: 40px; text-align: center; }
        .header-content h1 { font-size: 2.5rem; color: #1a3a2a; font-weight: 800; margin-bottom: 10px; }
        .header-content p { color: #64748b; font-size: 1.1rem; }
        .projects-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 30px; max-width: 1200px; margin: 0 auto; }
        .project-card { background: white; border-radius: 30px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: 0.3s; border: 1px solid transparent; }
        .project-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); border-color: #6ab06a; }
        .project-image { width: 100%; height: 220px; object-fit: cover; }
        .project-info { padding: 25px; }
        .project-inst { font-size: 0.8rem; font-weight: 800; text-transform: uppercase; color: #6ab06a; margin-bottom: 10px; display: block; }
        .project-title { font-size: 1.4rem; color: #1a3a2a; font-weight: 800; margin-bottom: 15px; line-height: 1.3; }
        .project-description { color: #64748b; font-size: 0.95rem; line-height: 1.5; margin-bottom: 20px; }
        .btn-ver-mas { display: inline-flex; align-items: center; gap: 8px; padding: 12px 25px; background: #1a3a2a; color: white; border-radius: 12px; font-weight: 700; text-decoration: none; transition: 0.3s; }
        .project-card:hover .btn-ver-mas { background: #6ab06a; }
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
            <a href="{{ route('steam.proyectos') }}" class="menu-item">
                <i data-lucide="microscope"></i> Proyectos STEAM
            </a>
            <a href="{{ route('prae.proyectos') }}" class="menu-item active">
                <i data-lucide="book-open"></i> Proyectos PRAE
            </a>
            <a href="#" class="menu-item">
                <i data-lucide="settings"></i> Configuración
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
            <h2>Proyectos PRAE</h2>
            <div class="profile-icon-container">
                @if(Auth::user()->avatar)
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Perfil" style="border-radius: 50%; width: 50px; height: 50px; object-fit: cover;">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=fff&color=744d2d&size=50" alt="Perfil" style="border-radius: 50%; width: 50px; height: 50px;">
                @endif
            </div>
        </div>

        <div class="container">
            <div class="header-content">
                <h1>Impacto en las Escuelas 🌳</h1>
                <p>Conoce los Proyectos Ambientales Escolares (PRAE) que están transformando nuestras comunidades.</p>
            </div>

            <div class="projects-grid">
                @foreach($proyectos as $proyecto)
                <div class="project-card">
                    @if($proyecto->imagen)
                        <img src="{{ asset('storage/' . $proyecto->imagen) }}" alt="{{ $proyecto->titulo }}" class="project-image">
                    @else
                        <div style="height: 220px; background: #eee; display: flex; align-items: center; justify-content: center;">
                            <i data-lucide="image" size="48" color="#ccc"></i>
                        </div>
                    @endif
                    <div class="project-info">
                        <span class="project-inst">{{ $proyecto->institucion }}</span>
                        <h3 class="project-title">{{ $proyecto->titulo }}</h3>
                        <p class="project-description">{{ Str::limit($proyecto->descripcion, 120) }}</p>
                        <a href="{{ route('prae.show', $proyecto->id) }}" class="btn-ver-mas">
                            Explorar PRAE <i data-lucide="eye" size="18"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            @if($proyectos->isEmpty())
                <div style="text-align: center; padding: 60px; color: #94a3b8;">
                    <i data-lucide="book-open" size="60" style="opacity: 0.3; margin-bottom: 20px;"></i>
                    <p>No hay proyectos PRAE publicados todavía.</p>
                </div>
            @endif
        </div>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>
