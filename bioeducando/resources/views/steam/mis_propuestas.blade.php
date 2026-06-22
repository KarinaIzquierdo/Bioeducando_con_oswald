<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Propuestas STEAM - Bioeducando</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #f0fdf4; min-height: 100vh; display: flex; }

        .sidebar { width: 260px; background-color: #6ab06a; display: flex; flex-direction: column; padding: 20px; position: fixed; height: 100vh; z-index: 1000; }
        .sidebar-title { font-size: 2.2rem; font-weight: 600; color: #000; margin-bottom: 40px; padding-left: 10px; }
        .menu-item { display: flex; align-items: center; padding: 12px 15px; color: white; text-decoration: none; margin-bottom: 10px; border-radius: 10px; transition: 0.3s; font-size: 1rem; }
        .menu-item i { margin-right: 12px; width: 20px; }
        .menu-item.active { background-color: #3d5a44; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .menu-item:hover:not(.active) { background-color: rgba(255,255,255,0.1); }
        .sidebar-footer { margin-top: auto; display: flex; flex-direction: column; align-items: center; gap: 15px; padding: 20px 0; width: 100%; }
        .sidebar-logo { width: 140px; filter: brightness(0); margin-bottom: 5px; }
        .btn-logout { width: 100%; padding: 12px; background-color: #000; color: white; border: none; border-radius: 10px; cursor: pointer; display: flex; align-items: center; justify-content: center; font-weight: 600; transition: 0.3s; text-transform: lowercase; }

        .main-content { margin-left: 260px; min-height: 100vh; flex: 1; display: flex; flex-direction: column; }
        .top-bar { height: 100px; background-color: #744d2d; display: flex; align-items: center; justify-content: space-between; padding: 0 40px; }
        .top-bar h2 { color: white; font-size: 1.8rem; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; }

        .container { padding: 40px; max-width: 1000px; margin: 0 auto; width: 100%; }
        
        .alert-success { background: #dcfce7; color: #15803d; padding: 20px; border-radius: 20px; margin-bottom: 30px; font-weight: 600; border: 1px solid #bbf7d0; display: flex; align-items: center; gap: 12px; }

        .header-section { display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; }
        .header-section h1 { font-size: 2rem; color: #1a3a2a; font-weight: 800; }
        .btn-new { background: #1a3a2a; color: white; padding: 12px 25px; border-radius: 12px; text-decoration: none; font-weight: 700; transition: 0.3s; display: flex; align-items: center; gap: 8px; }
        .btn-new:hover { background: #6ab06a; transform: translateY(-2px); }

        .proposals-grid { display: grid; gap: 20px; }
        .proposal-card { background: white; padding: 25px; border-radius: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); display: flex; align-items: center; justify-content: space-between; }
        
        .proposal-info h3 { color: #1a3a2a; font-size: 1.2rem; margin-bottom: 5px; }
        .proposal-info p { color: #64748b; font-size: 0.9rem; }
        
        .status-badge { padding: 8px 16px; border-radius: 50px; font-size: 0.8rem; font-weight: 800; text-transform: uppercase; }
        .status-pendiente { background: #fef9c3; color: #854d0e; }
        .status-aprobado { background: #dcfce7; color: #166534; }
        .status-rechazado { background: #fee2e2; color: #991b1b; }

        .empty-state { text-align: center; padding: 80px 20px; color: #94a3b8; }
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
            @if(session('success'))
                <div class="alert-success">
                    <i data-lucide="check-circle" size="24"></i>
                    {{ session('success') }}
                </div>
            @endif

            <div class="header-section">
                <h1>Tus Propuestas STEAM</h1>
                <a href="{{ route('steam.proponer') }}" class="btn-new">
                    <i data-lucide="plus-circle" size="20"></i> Nueva Propuesta
                </a>
            </div>

            <div class="proposals-grid">
                @forelse($propuestas as $propuesta)
                <div class="proposal-card">
                    <div class="proposal-info">
                        <h3>{{ $propuesta->titulo }}</h3>
                        <p>Enviado el {{ $propuesta->created_at->format('d/m/Y') }} • {{ $propuesta->categoria }}</p>
                    </div>
                    <span class="status-badge status-{{ $propuesta->estado }}">
                        {{ $propuesta->estado }}
                    </span>
                </div>
                @empty
                <div class="empty-state">
                    <i data-lucide="clipboard-list" size="60" style="opacity: 0.3; margin-bottom: 20px;"></i>
                    <p>Aún no has enviado ninguna propuesta. ¡Anímate a compartir tu idea!</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
