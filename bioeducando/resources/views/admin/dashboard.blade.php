<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Bioeducando</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Iconos Lucide para los menús -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { display: flex; height: 100vh; background-color: white; }

        /* Sidebar Izquierda */
        .sidebar {
            width: 260px;
            background-color: #6ab06a;
            display: flex;
            flex-direction: column;
            padding: 20px;
            position: relative;
        }

        .admin-title {
            font-size: 2rem;
            font-weight: 400;
            color: #000;
            margin-bottom: 40px;
            margin-top: 10px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: white;
            text-decoration: none;
            margin-bottom: 10px;
            border-radius: 10px;
            transition: 0.3s;
            font-size: 1rem;
        }

        .menu-item i { margin-right: 12px; width: 20px; }

        .menu-item.active {
            background-color: #3d5a44;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .menu-item:hover:not(.active) {
            background-color: rgba(255,255,255,0.1);
        }

        /* Logo y Botón abajo */
        .sidebar-footer {
            margin-top: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .sidebar-logo {
            width: 160px;
            height: auto;
            filter: brightness(0); /* Logo en negro como en la imagen */
        }

        .btn-logout {
            width: 100%;
            background-color: black;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            text-transform: lowercase;
            transition: 0.3s;
        }

        /* Contenido Principal */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .top-bar {
            height: 80px;
            background-color: #744d2d; /* Color café de la imagen */
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 40px;
        }

        .profile-icon {
            width: 50px;
            height: 50px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #744d2d;
        }

        .dashboard-grid {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 40px;
            padding: 40px;
        }

        /* Tarjetas de Usuarios */
        .user-card {
            width: 320px; /* Más ancho */
            height: 450px; /* Más alto */
            background-color: #6ab06a;
            border-radius: 25px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            padding: 60px 30px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
            transition: transform 0.3s;
        }

        .user-card:hover { transform: translateY(-10px); }

        .icon-circle {
            width: 160px; /* Círculo más grande */
            height: 160px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #744d2d;
        }

        .action-btn {
            width: 100%;
            background-color: #3d5a44;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 10px;
            font-size: 1rem;
            cursor: pointer;
            transition: 0.3s;
        }

        .action-btn:hover { background-color: #2d4433; }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h1 class="admin-title">Admin panel</h1>
        
        <nav>
            <a href="{{ route('usuarios.index') }}" class="menu-item {{ Request::is('admin/usuarios*') ? 'active' : '' }}">
                <i data-lucide="users"></i> Usuarios
            </a>
            <a href="{{ route('admin.retos') }}" class="menu-item {{ Request::is('admin/retos*') ? 'active' : '' }}">
                <i data-lucide="leaf"></i> Retos ecológicos
            </a>
            <a href="{{ route('admin.comunidad') }}" class="menu-item {{ Request::is('admin/comunidad*') ? 'active' : '' }}">
                <i data-lucide="flower-2"></i> Comunidad ambiental
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

    <!-- Main Content -->
    <div class="main-content">
        <div class="top-bar">
            <!-- Mensajes de Alerta -->
            <div style="flex: 1; display: flex; justify-content: center; align-items: center; padding: 0 20px;">
                @if(session('success'))
                    <div style="background: #dcfce7; color: #15803d; padding: 10px 20px; border-radius: 10px; border: 1px solid #bbf7d0; font-weight: 600; font-size: 0.9rem;">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div style="background: #fee2e2; color: #b91c1c; padding: 10px 20px; border-radius: 10px; border: 1px solid #fecaca; font-weight: 600; font-size: 0.9rem;">
                        {{ session('error') }}
                    </div>
                @endif
            </div>

            <div class="profile-icon">
                <i data-lucide="user" size="30"></i>
            </div>
        </div>

        <div class="dashboard-grid">
            <!-- Agregar Usuario -->
            <div class="user-card">
                <div class="icon-circle">
                    <i data-lucide="user-plus" size="120"></i>
                </div>
                <a href="{{ route('usuarios.create') }}" class="action-btn" style="text-decoration: none; text-align: center;">Agregar usuario</a>
            </div>
        </div>
    </div>

    <script>
        // Inicializar iconos
        lucide.createIcons();
    </script>
</body>
</html>
