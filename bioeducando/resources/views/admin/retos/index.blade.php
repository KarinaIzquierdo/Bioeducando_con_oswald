<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retos Ecológicos - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { display: flex; height: 100vh; background-color: #f4f7f4; }

        /* Reutilizamos el Sidebar del Admin */
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

        .sidebar-logo { 
            width: 140px; 
            filter: brightness(0); 
            margin-bottom: 5px; 
        }

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
        .btn-logout:hover {
            background-color: #2d4433;
        }

        /* Contenido */
        .main-content { flex: 1; display: flex; flex-direction: column; overflow-y: auto; }
        .top-bar { height: 80px; background-color: #744d2d; display: flex; align-items: center; padding: 0 40px; color: white; justify-content: space-between; }
        
        .content-padding { padding: 40px; }
        .header-section { margin-bottom: 40px; }
        .header-section h2 { font-size: 2rem; color: #1a3a2a; display: flex; align-items: center; gap: 15px; }

        /* Grid de Retos */
        .retos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
        }

        .reto-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            border-left: 8px solid #6ab06a;
            transition: 0.3s;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .reto-card:hover { transform: translateY(-5px); box-shadow: 0 15px 35px rgba(0,0,0,0.1); }

        .reto-number { font-size: 0.9rem; font-weight: 700; color: #6ab06a; text-transform: uppercase; margin-bottom: 10px; display: block; }
        .reto-title { font-size: 1.3rem; font-weight: 700; color: #333; margin-bottom: 15px; }
        .reto-desc { font-size: 0.95rem; color: #666; line-height: 1.6; margin-bottom: 25px; }

        .reto-badge {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 5px 12px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 20px;
        }

        .btn-manage {
            width: 100%;
            padding: 12px;
            background: #f0f0f0;
            border: none;
            border-radius: 12px;
            color: #444;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-manage:hover { background: #3d5a44; color: white; }

        .btn-add-reto {
            background: white;
            color: #744d2d;
            border: none;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>
</head>
<body>

    <!-- Sidebar Reutilizado -->
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
            <a href="{{ route('admin.comunidad') }}" class="menu-item {{ Request::is('admin/comunidad*') ? 'active' : '' }}">
                <i data-lucide="flower-2"></i> Comunidad Ambiental
            </a>
            <a href="{{ route('admin.steam.index') }}" class="menu-item {{ Request::is('admin/steam*') ? 'active' : '' }}">
                <i data-lucide="microscope"></i> Gestionar STEAM
            </a>
            <a href="{{ route('admin.prae.index') }}" class="menu-item {{ Request::is('admin/prae*') ? 'active' : '' }}">
                <i data-lucide="book-open"></i> Gestionar PRAE
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

    <!-- Main Content -->
    <div class="main-content">
        <div class="top-bar">
            <span>Gestión de Retos de Reciclaje</span>
            <a href="{{ route('admin.retos.create') }}" class="btn-add-reto" style="text-decoration: none;">
                <i data-lucide="plus-circle"></i> Nuevo Reto
            </a>
        </div>

        <div class="content-padding">
            @if(session('success'))
                <div style="background: #dcfce7; color: #15803d; padding: 15px 25px; border-radius: 12px; border: 1px solid #bbf7d0; font-weight: 600; margin-bottom: 25px; display: flex; align-items: center; gap: 10px;">
                    <i data-lucide="check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <div class="header-section">
                <h2><i data-lucide="recycle" style="color: #6ab06a"></i> Retos de reciclaje</h2>
            </div>

            <div class="retos-grid">
                @foreach($retos as $reto)
                <div class="reto-card">
                    <div>
                        <span class="reto-number">Misión {{ str_pad($reto->id, 2, '0', STR_PAD_LEFT) }}</span>
                        <h3 class="reto-title">{{ $reto->titulo }}</h3>
                        <div class="reto-badge">
                            <i data-lucide="{{ $reto->estado == 'activa' ? 'check-circle' : 'x-circle' }}"></i> 
                            {{ ucfirst($reto->estado) }}
                        </div>
                        <p class="reto-desc">{{ $reto->descripcion }}</p>
                    </div>
                    <a href="{{ route('admin.retos.edit', $reto->id) }}" class="btn-manage" style="text-decoration: none;">
                        <i data-lucide="edit-3"></i> Editar Misión
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
