<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectos STEAM - Bioeducando</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #f0f9ff; min-min-height: 100vh; display: flex; }

        .sidebar { width: 260px; background-color: #6ab06a; display: flex; flex-direction: column; padding: 20px; position: fixed; height: 100vh; z-index: 1000; overflow-y: auto; }
        .sidebar-title { font-size: 2.2rem; font-weight: 600; color: #000; margin-bottom: 25px; padding-left: 10px; flex-shrink: 0; }
        .menu-item { display: flex; align-items: center; padding: 12px 15px; color: white; text-decoration: none; margin-bottom: 10px; border-radius: 10px; transition: 0.3s; font-size: 1rem; }
        .menu-item i { margin-right: 12px; width: 20px; }
        .menu-item.active { background-color: #3d5a44; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .menu-item:hover:not(.active) { background-color: rgba(255,255,255,0.1); }
        .sidebar-footer { margin-top: auto; display: flex; flex-direction: column; align-items: center; gap: 10px; padding: 15px 0; width: 100%; flex-shrink: 0; }
        .sidebar-logo { width: 120px; max-width: 100%; filter: brightness(0); margin-bottom: 5px; }
        .btn-logout { width: 100%; padding: 12px; background-color: #000; color: white; border: none; border-radius: 10px; cursor: pointer; display: flex; align-items: center; justify-content: center; font-weight: 600; transition: 0.3s; text-transform: lowercase; font-size: 0.9rem; }

        .main-content { flex: 1; margin-left: 260px; display: flex; flex-direction: column; min-height: 100vh; }
        .top-bar { height: 100px; background-color: #744d2d; display: flex; align-items: center; justify-content: space-between; padding: 0 40px; width: 100%; position: sticky; top: 0; z-index: 900; }
        .top-bar h2 { color: white; font-size: 1.8rem; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; margin: 0; }
        .profile-icon { width: 50px; height: 50px; background-color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #744d2d; border: 2px solid white; overflow: hidden; flex-shrink: 0; }
        .profile-icon img { width: 100%; height: 100%; object-fit: cover; }

        .container { padding: 40px; flex: 1; width: 100%; max-width: 1200px; margin: 0 auto; }
        .header-content { display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; }
        .header-content h1 { font-size: 2.2rem; color: #1a3a2a; font-weight: 800; }
        .btn-propose { background: #6ab06a; color: white; padding: 12px 25px; border-radius: 15px; text-decoration: none; font-weight: 700; display: flex; align-items: center; gap: 10px; transition: 0.3s; }
        .btn-propose:hover { background: #5aa05a; transform: translateY(-3px); }
        .projects-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 30px; }
        .project-card { background: white; border-radius: 25px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: 0.3s; border: 1px solid #e2e8f0; }
        .project-card:hover { transform: translateY(-5px); box-shadow: 0 15px 40px rgba(0,0,0,0.1); }
        .project-image { width: 100%; height: 200px; background: #f8fafc; overflow: hidden; }
        .project-image img { width: 100%; height: 100%; object-fit: cover; }
        .project-content { padding: 25px; }
        .project-category { font-size: 0.75rem; font-weight: 800; color: #6ab06a; text-transform: uppercase; margin-bottom: 10px; display: block; }
        .project-title { font-size: 1.4rem; color: #1a3a2a; font-weight: 800; margin-bottom: 12px; }
        .project-desc { color: #64748b; font-size: 0.95rem; line-height: 1.6; margin-bottom: 20px; }
        .btn-view { display: flex; align-items: center; justify-content: center; gap: 8px; background: #1a3a2a; color: white; padding: 12px; border-radius: 12px; text-decoration: none; font-weight: 700; transition: 0.3s; }
        .btn-view:hover { background: #2d4433; }

        .my-proposals { background: white; border-radius: 20px; padding: 25px; margin-bottom: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        .my-proposals h2 { font-size: 1.2rem; color: #1a3a2a; font-weight: 800; margin-bottom: 15px; display: flex; align-items: center; gap: 10px; }
        .proposal-item { display: flex; align-items: center; justify-content: space-between; padding: 14px 18px; border-radius: 14px; background: #f8fafc; margin-bottom: 10px; }
        .proposal-item:last-child { margin-bottom: 0; }
        .proposal-item h4 { color: #1a3a2a; font-size: 1rem; margin-bottom: 4px; }
        .proposal-item p { color: #94a3b8; font-size: 0.8rem; }
        .status-badge { padding: 5px 14px; border-radius: 50px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; }
        .status-pendiente { background: #fef9c3; color: #854d0e; }
        .status-aprobado { background: #dcfce7; color: #166534; }
        .status-rechazado { background: #fee2e2; color: #991b1b; }
        @media (max-width: 768px) {
            body { flex-direction: column; }

            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                padding: 15px;
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
            }

            .sidebar-title,
            .admin-title {
                font-size: 1.5rem;
                margin-bottom: 15px;
                width: 100%;
                text-align: center;
            }

            nav {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 5px;
                width: 100%;
            }

            .menu-item {
                padding: 8px 12px;
                font-size: 0.8rem;
                margin-bottom: 0;
            }

            .menu-item i {
                margin-right: 6px;
                width: 16px;
            }

            .sidebar-footer {
                display: none;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .top-bar {
                height: auto;
                padding: 15px 20px;
            }

            .top-bar h2 {
                font-size: 1.4rem;
            }

            .container {
                padding: 20px 15px;
            }

            table {
                display: block;
                width: 100%;
                overflow-x: auto;
                white-space: nowrap;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h1 class="sidebar-title">Usuario</h1>
        <nav>
            <a href="{{ route('profile.edit') }}" class="menu-item"><i data-lucide="user"></i> Perfil</a>
            <a href="{{ route('retos.usuario') }}" class="menu-item"><i data-lucide="leaf"></i> Retos Ecológicos</a>
            <a href="{{ route('noticias.usuario') }}" class="menu-item"><i data-lucide="newspaper"></i> Noticias Ambientales</a>
            <a href="{{ route('comunidad.usuario') }}" class="menu-item"><i data-lucide="flower-2"></i> Comunidad Ambiental</a>
            <a href="{{ route('contenido.creacion') }}" class="menu-item"><i data-lucide="clapperboard"></i> Eco-Estudio</a>
            <a href="{{ route('steam.proyectos') }}" class="menu-item active"><i data-lucide="microscope"></i> Proyectos STEAM</a>
            <a href="{{ route('prae.proyectos') }}" class="menu-item"><i data-lucide="book-open"></i> Proyectos PRAE</a>
            <a href="#" class="menu-item"><i data-lucide="settings"></i> Configuración</a>
        </nav>
        <div class="sidebar-footer">
            <img src="/imagenes/Logo.svg" alt="Logo" class="sidebar-logo">
            <form action="{{ route('logout') }}" method="POST" style="width: 100%;">@csrf<button type="submit" class="btn-logout">cerrar sesión</button></form>
        </div>
    </div>
    <div class="main-content">
        <div class="top-bar">
            <h2>Proyectos STEAM</h2>
            <div class="profile-icon">
                @if(Auth::check() && Auth::user()->foto_path)
                    <img src="{{ asset(Auth::user()->foto_path) }}" alt="Perfil">
                @else
                    <i data-lucide="user" style="width: 28px; height: 28px;"></i>
                @endif
            </div>
        </div>
        <div class="container">
            <div class="header-content"><h1>Explora Proyectos STEAM 🔬</h1><a href="{{ route('steam.proponer') }}" class="btn-propose"><i data-lucide="plus-circle"></i> Proponer Proyecto</a></div>

            @if(Auth::check() && $misPropuestas->count() > 0)
            <div class="my-proposals">
                <h2><i data-lucide="inbox" size="22"></i> Mis Propuestas</h2>
                @foreach($misPropuestas as $propuesta)
                <div class="proposal-item">
                    <div>
                        <h4>{{ $propuesta->titulo }}</h4>
                        <p>{{ $propuesta->categoria }} • {{ $propuesta->created_at->format('d/m/Y') }}</p>
                    </div>
                    <span class="status-badge status-{{ $propuesta->estado }}">{{ $propuesta->estado }}</span>
                </div>
                @endforeach
            </div>
            @endif

            <div class="projects-grid">
                @forelse($proyectos as $proyecto)
                <div class="project-card">
                    <div class="project-image">
                        @if($proyecto->imagen)<img src="{{ asset('storage/' . $proyecto->imagen) }}" alt="">
                        @else<div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #cbd5e1;"><i data-lucide="microscope" size="48"></i></div>@endif
                    </div>
                    <div class="project-content">
                        <span class="project-category">{{ $proyecto->categoria }}</span>
                        <h3 class="project-title">{{ $proyecto->titulo }}</h3>
                        <p class="project-desc">{{ Str::limit($proyecto->descripcion, 120) }}</p>
                        <a href="{{ route('steam.show', $proyecto->id) }}" class="btn-view">Ver Proyecto <i data-lucide="arrow-right" size="16"></i></a>
                    </div>
                </div>
                @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 60px; color: #64748b;">
                    <i data-lucide="microscope" size="48" style="margin-bottom: 15px;"></i>
                    <h3 style="font-size: 1.2rem; font-weight: 700; color: #1a3a2a; margin-bottom: 10px;">No hay proyectos disponibles</h3>
                    <p>¡Sé el primero en proponer un proyecto STEAM!</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
    <script>lucide.createIcons();</script>
</body>
</html>
