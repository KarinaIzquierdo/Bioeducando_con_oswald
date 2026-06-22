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
        .sidebar { width: 260px; background-color: #6ab06a; display: flex; flex-direction: column; padding: 20px; position: fixed; height: 100vh; z-index: 1000; overflow-y: auto; }
        .sidebar-title { font-size: 2.2rem; font-weight: 600; color: #000; margin-bottom: 25px; padding-left: 10px; flex-shrink: 0; }
        .menu-item { display: flex; align-items: center; padding: 12px 15px; color: white; text-decoration: none; margin-bottom: 10px; border-radius: 10px; transition: 0.3s; }
        .sidebar-footer { margin-top: auto; display: flex; flex-direction: column; align-items: center; gap: 10px; padding: 15px 0; width: 100%; flex-shrink: 0; }
        .sidebar-logo { width: 120px; max-width: 100%; filter: brightness(0); margin-bottom: 5px; }
        .btn-logout { width: 100%; padding: 12px; background-color: #000; color: white; border: none; border-radius: 10px; cursor: pointer; display: flex; align-items: center; justify-content: center; font-weight: 600; transition: 0.3s; text-transform: lowercase; font-size: 0.9rem; }
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
        .project-badge { background: #e8f5e9; color: #2e7d32; padding: 8px 20px; border-radius: 50px; font-weight: 800; font-size: 0.8rem; text-transform: uppercase; display: inline-block; margin-bottom: 10px; }
        .status-badge { padding: 6px 16px; border-radius: 50px; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; display: inline-block; margin-bottom: 20px; }
        .status-aprobado { background: #e8f5e9; color: #2e7d32; }
        .status-rechazado { background: #fee2e2; color: #b91c1c; }
        .status-pendiente { background: #fef9c3; color: #854d0e; }
        .project-title { font-size: 2.5rem; color: #1a3a2a; font-weight: 800; margin-bottom: 25px; }
        .project-section { margin-top: 35px; border-top: 2px solid #f0fdf4; padding-top: 30px; }
        .section-title-detail { font-size: 1.4rem; color: #1a3a2a; font-weight: 800; margin-bottom: 15px; display: flex; align-items: center; gap: 10px; }
        .section-title-detail i { color: #6ab06a; }
        .section-text { color: #475569; font-size: 1rem; line-height: 1.7; white-space: pre-line; }
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
        <div class="top-bar" style="height: 100px; background-color: #744d2d; display: flex; align-items: center; justify-content: flex-end; padding: 0 40px; width: 100%; box-sizing: border-box;">
            <div style="width: 50px; height: 50px; background-color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #744d2d; border: 2px solid white; overflow: hidden; flex-shrink: 0;">
                @if(Auth::check() && Auth::user()->foto_path)
                    <img src="{{ asset(Auth::user()->foto_path) }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    <i data-lucide="user" style="width: 28px; height: 28px;"></i>
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
                    <div class="status-badge status-{{ $proyecto->estado }}">{{ ucfirst($proyecto->estado) }}</div>
                    <h1 class="project-title">{{ $proyecto->titulo }}</h1>
                    
                    <div class="project-section">
                        <h2 class="section-title-detail"><i data-lucide="book-open"></i> Descripción / Pasos</h2>
                        <div class="section-text">{{ $proyecto->descripcion }}</div>
                    </div>

                    @if($proyecto->objetivos)
                    <div class="project-section">
                        <h2 class="section-title-detail"><i data-lucide="target"></i> Objetivos</h2>
                        <div class="section-text">{{ $proyecto->objetivos }}</div>
                    </div>
                    @endif

                    @if($proyecto->materiales)
                    <div class="project-section">
                        <h2 class="section-title-detail"><i data-lucide="package"></i> Materiales Necesarios</h2>
                        <div class="section-text">{{ $proyecto->materiales }}</div>
                    </div>
                    @endif

                    @if($proyecto->impacto_ambiental)
                    <div class="project-section">
                        <h2 class="section-title-detail"><i data-lucide="leaf"></i> Impacto Ambiental</h2>
                        <div class="section-text">{{ $proyecto->impacto_ambiental }}</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>
