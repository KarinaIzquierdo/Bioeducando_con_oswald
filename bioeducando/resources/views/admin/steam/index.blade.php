<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar STEAM - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { display: flex; height: 100vh; background-color: #f4f7f4; }
        .sidebar { width: 260px; background-color: #6ab06a; display: flex; flex-direction: column; padding: 20px; }
        .admin-title { font-size: 2rem; font-weight: 600; color: #000; margin-bottom: 40px; text-align: center; width: 100%; }
        .menu-item { display: flex; align-items: center; padding: 12px 15px; color: white; text-decoration: none; margin-bottom: 10px; border-radius: 10px; transition: 0.3s; }
        .menu-item i { margin-right: 12px; }
        .menu-item.active { background-color: #3d5a44; }
        
        .sidebar-footer {
            margin-top: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            padding: 20px 0;
            width: 100%;
        }
        .sidebar-logo { width: 140px; filter: brightness(0); margin-bottom: 5px; }
        .btn-logout {
            width: 100%;
            padding: 12px;
            background-color: #3d5a44;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-weight: 600;
            transition: 0.3s;
            font-size: 0.95rem;
        }
        .btn-logout:hover { background-color: #2d4433; }
        
        .main-content { flex: 1; display: flex; flex-direction: column; overflow-y: auto; }
        .top-bar { height: 100px; background-color: #744d2d; display: flex; align-items: center; padding: 0 40px; color: white; justify-content: space-between; }
        .top-bar h2 { color: white; font-size: 1.8rem; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; margin: 0; display: flex; align-items: center; gap: 12px; }
        .content-padding { padding: 40px; }
        .btn-add { background: white; color: #744d2d; border: none; padding: 10px 20px; border-radius: 12px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .proyectos-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 25px; }
        .proyecto-card { background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.05); transition: 0.3s; position: relative; }
        .proyecto-img { width: 100%; height: 180px; object-fit: cover; }
        .proyecto-info { padding: 20px; }
        .proyecto-cat { font-size: 0.75rem; font-weight: 800; color: #6ab06a; text-transform: uppercase; }
        .proyecto-title { font-size: 1.2rem; font-weight: 700; margin: 10px 0; color: #333; }
        .actions { display: flex; gap: 10px; margin-top: 20px; }
        .btn-edit { flex: 1; padding: 10px; background: #f0f0f0; border-radius: 10px; text-align: center; text-decoration: none; color: #444; font-weight: 600; }
        .btn-delete { padding: 10px; background: #fee2e2; border: none; border-radius: 10px; color: #ef4444; cursor: pointer; }
        
        .status-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 5px 12px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
        }
        .status-pendiente { background: #fef9c3; color: #854d0e; }
        .status-aprobado { background: #dcfce7; color: #166534; }
        .status-rechazado { background: #fee2e2; color: #991b1b; }
        
        .featured-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: #6ab06a;
            color: white;
            padding: 5px 10px;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 5px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h1 class="admin-title">Admin</h1>
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="menu-item {{ Request::is('admin') ? 'active' : '' }}">
                <i data-lucide="layout-dashboard"></i> Dashboard
            </a>
            <a href="{{ route('usuarios.index') }}" class="menu-item {{ Request::is('admin/usuarios*') ? 'active' : '' }}">
                <i data-lucide="users"></i> Usuarios
            </a>
            <a href="{{ route('admin.retos') }}" class="menu-item {{ Request::is('admin/retos*') ? 'active' : '' }}">
                <i data-lucide="leaf"></i> Retos Ecológicos
            </a>
            <a href="{{ route('admin.comunidad_activa') }}" class="menu-item {{ Request::is('admin/comunidad-activa*') ? 'active' : '' }}">
                <i data-lucide="flower-2"></i> Comunidad Activa
            </a>
            <a href="{{ route('admin.steam.index') }}" class="menu-item {{ Request::is('admin/steam*') ? 'active' : '' }}">
                <i data-lucide="microscope"></i> Gestionar STEAM
            </a>
            <a href="{{ route('admin.prae.index') }}" class="menu-item {{ Request::is('admin/prae*') ? 'active' : '' }}">
                <i data-lucide="book-open"></i> Gestionar PRAE
            </a>
            <a href="{{ route('admin.profile.edit') }}" class="menu-item {{ Request::is('admin/perfil*') ? 'active' : '' }}">
                <i data-lucide="user"></i> Mi Perfil
            </a>
            <a href="#" class="menu-item">
                <i data-lucide="settings"></i> Configuración
            </a>
        </nav>
        <div class="sidebar-footer">
            <img src="/imagenes/Logo.svg" alt="Logo" class="sidebar-logo">
            <form action="{{ route('logout') }}" method="POST" style="width: 100%;">
                @csrf
                <button type="submit" class="btn-logout">
                    <i data-lucide="log-out"></i> Cerrar Sesión
                </button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <div class="top-bar" style="width: 100%; box-sizing: border-box;">
            <h2><i data-lucide="microscope"></i> Gestionar STEAM</h2>
            <div style="width: 50px; height: 50px; background-color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #744d2d; border: 2px solid white; overflow: hidden; flex-shrink: 0;">
                @if(Auth::check() && Auth::user()->foto_path)
                    <img src="{{ asset(Auth::user()->foto_path) }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    <i data-lucide="user" style="width: 28px; height: 28px;"></i>
                @endif
            </div>
        </div>

        <div class="content-padding">
            @if(session('success'))
                <div style="background: #dcfce7; color: #15803d; padding: 15px; border-radius: 12px; margin-bottom: 20px;">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('admin.steam.create') }}" class="btn-add" style="margin-bottom: 25px; display: inline-flex;">
                <i data-lucide="plus" size="20"></i> Nuevo Proyecto
            </a>

            <!-- Sección 1: Proyectos Publicados -->
            <h2 style="font-size: 1.4rem; font-weight: 700; color: #1a3a2a; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                <i data-lucide="layers" size="24"></i> Proyectos Publicados
            </h2>

            @if($proyectos->count() > 0)
            <div class="proyectos-grid" style="margin-bottom: 40px;">
                @foreach($proyectos as $proyecto)
                <div class="proyecto-card">
                    @if($proyecto->destacado)
                        <div class="featured-badge">
                            <i data-lucide="star" size="12" fill="white"></i> Destacado
                        </div>
                    @endif

                    @if($proyecto->imagen)
                        <img src="{{ asset('storage/' . $proyecto->imagen) }}" class="proyecto-img">
                    @else
                        <div style="height: 180px; background: #eee; display: flex; align-items: center; justify-content: center;">
                            <i data-lucide="image" size="40" color="#ccc"></i>
                        </div>
                    @endif
                    <div class="proyecto-info">
                        <span class="proyecto-cat">{{ $proyecto->categoria }}</span>
                        <h3 class="proyecto-title">{{ $proyecto->titulo }}</h3>
                        <p style="font-size: 0.85rem; color: #666; margin-bottom: 10px;">
                            <i data-lucide="user" size="14"></i> {{ $proyecto->user ? $proyecto->user->name : 'Institucional' }}
                        </p>
                        <div class="actions" style="display: flex; gap: 8px; flex-wrap: wrap;">
                            <a href="{{ route('admin.steam.edit', $proyecto->id) }}" class="btn-edit" style="flex: 1;">
                                <i data-lucide="edit-3" size="16"></i> Gestionar
                            </a>
                            <form action="{{ route('admin.steam.destroy', $proyecto->id) }}" method="POST" onsubmit="return confirm('¿Eliminar proyecto?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-delete"><i data-lucide="trash-2" size="16"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div style="background: white; border-radius: 20px; padding: 40px; text-align: center; margin-bottom: 40px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                <i data-lucide="layers" size="48" color="#ccc"></i>
                <p style="color: #94a3b8; margin-top: 15px;">No hay proyectos publicados aún</p>
            </div>
            @endif

            <!-- Sección 2: Solicitudes Pendientes -->
            <h2 style="font-size: 1.4rem; font-weight: 700; color: #1a3a2a; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                <i data-lucide="inbox" size="24"></i> Solicitudes Pendientes
                @if($solicitudes->count() > 0)
                    <span style="background: #fef9c3; color: #854d0e; font-size: 0.85rem; padding: 4px 12px; border-radius: 20px;">{{ $solicitudes->count() }}</span>
                @endif
            </h2>

            @if($solicitudes->count() > 0)
            <div style="background: #fefce8; border: 2px dashed #facc15; border-radius: 20px; padding: 25px; margin-bottom: 40px;">
            <div class="proyectos-grid" style="margin-bottom: 0;">
                @foreach($solicitudes as $proyecto)
                <div class="proyecto-card" style="border: 2px solid #fef9c3;">
                    @if($proyecto->imagen)
                        <img src="{{ asset('storage/' . $proyecto->imagen) }}" class="proyecto-img">
                    @else
                        <div style="height: 180px; background: #eee; display: flex; align-items: center; justify-content: center;">
                            <i data-lucide="image" size="40" color="#ccc"></i>
                        </div>
                    @endif
                    <div class="proyecto-info">
                        <span class="proyecto-cat">{{ $proyecto->categoria }}</span>
                        <h3 class="proyecto-title">{{ $proyecto->titulo }}</h3>
                        <p style="font-size: 0.85rem; color: #666; margin-bottom: 10px;">
                            <i data-lucide="user" size="14"></i> <strong>Propuesto por:</strong> {{ $proyecto->user ? $proyecto->user->name : 'Anónimo' }}
                        </p>
                        <div class="actions" style="display: flex; gap: 8px; flex-wrap: wrap;">
                            <a href="{{ route('admin.steam.edit', $proyecto->id) }}" class="btn-edit" style="flex: 0 0 auto;">
                                <i data-lucide="edit-3" size="16"></i> Revisar
                            </a>
                            <form action="{{ route('admin.steam.estado', $proyecto->id) }}" method="POST" style="display: inline; flex: 1;">
                                @csrf @method('PATCH')
                                <input type="hidden" name="estado" value="aprobado">
                                <button type="submit" class="btn-edit" style="background: #dcfce7; color: #166534; width: 100%;"><i data-lucide="check" size="16"></i> Aprobar</button>
                            </form>
                            <form action="{{ route('admin.steam.estado', $proyecto->id) }}" method="POST" style="display: inline; flex: 1;">
                                @csrf @method('PATCH')
                                <input type="hidden" name="estado" value="rechazado">
                                <button type="submit" class="btn-edit" style="background: #fee2e2; color: #991b1b; width: 100%;"><i data-lucide="x" size="16"></i> Rechazar</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            </div>
            @else
            <div style="background: #fefce8; border: 2px dashed #facc15; border-radius: 20px; padding: 40px; text-align: center;">
                <i data-lucide="inbox" size="48" color="#ccc"></i>
                <p style="color: #94a3b8; margin-top: 15px;">No hay solicitudes pendientes</p>
            </div>
            @endif
        </div>
    </div>
    <script>lucide.createIcons();</script>
</body>
</html>
