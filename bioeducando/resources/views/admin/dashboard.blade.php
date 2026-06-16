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
            font-weight: 600;
            color: #000;
            margin-bottom: 40px;
            margin-top: 10px;
            text-align: center; /* Centrar la palabra Admin */
            width: 100%;
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
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            padding: 40px;
            align-content: start;
        }

        .welcome-section {
            grid-column: 1 / -1;
            background: linear-gradient(135deg, #1a3a2a 0%, #3d5a44 100%);
            padding: 50px;
            border-radius: 30px;
            color: white;
            margin-bottom: 10px;
            box-shadow: 0 15px 35px rgba(26, 58, 42, 0.2);
            position: relative;
            overflow: hidden;
        }

        .welcome-section::after {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
        }

        .welcome-section h1 { font-size: 2.8rem; font-weight: 800; margin-bottom: 12px; }
        .welcome-section p { font-size: 1.2rem; opacity: 0.9; font-weight: 300; }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 24px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.03);
            border: 1px solid rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        .stat-card:hover { 
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.08);
        }

        .stat-icon {
            width: 55px;
            height: 55px;
            background: #f0fdf4;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6ab06a;
        }

        .stat-info h3 { font-size: 1.8rem; color: #1a3a2a; font-weight: 800; }
        .stat-info p { color: #64748b; font-size: 0.95rem; font-weight: 500; }

        /* Sección de Actividad Reciente o Resumen */
        .profile-menu-container {
            position: relative;
            cursor: pointer;
        }

        .profile-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 200px;
            display: none;
            flex-direction: column;
            padding: 10px 0;
            margin-top: 10px;
            z-index: 1000;
        }

        .profile-dropdown.show {
            display: flex;
        }

        .dropdown-item {
            padding: 12px 20px;
            color: #333;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: 0.3s;
            font-size: 0.9rem;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }

        .dropdown-item:hover {
            background-color: #f8faf8;
            color: #6ab06a;
        }

        .dropdown-item i { width: 18px; }

        .dropdown-divider {
            height: 1px;
            background-color: #eee;
            margin: 5px 0;
        }

        .summary-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .summary-header h2 {
            font-size: 1.4rem;
            color: #1a3a2a;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            border-radius: 18px;
            background: #f8fafc;
            transition: 0.2s;
        }

        .activity-item:hover {
            background: #f1f5f9;
        }

        .activity-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #6ab06a;
        }

        .activity-text {
            flex: 1;
            font-size: 1rem;
            color: #334155;
        }

        .activity-time {
            font-size: 0.85rem;
            color: #94a3b8;
        }

        .action-btn:hover { background-color: #2d4433; }
    </style>
</head>
<body>

    <!-- Sidebar -->
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

            <div class="profile-menu-container" onclick="toggleProfileMenu()">
                <div class="profile-icon">
                    <i data-lucide="user" size="30"></i>
                </div>
                
                <div id="profileDropdown" class="profile-dropdown">
                    <a href="{{ route('admin.profile.edit') }}" class="dropdown-item">
                        Mi Perfil
                    </a>
                    <div class="dropdown-item">
                        Configuración
                    </div>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item" style="color: #ff4d4d; padding-left: 20px;">
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="welcome-section">
                <h1>¡Bienvenido, Administrador!</h1>
                <p>Gestiona la educación ambiental y supervisa el impacto de la comunidad.</p>
            </div>

            <!-- Estadísticas reales -->
            <div class="stat-card">
                <div class="stat-icon"><i data-lucide="users"></i></div>
                <div class="stat-info">
                    <h3>{{ $totalUsuarios }}</h3>
                    <p>Usuarios Registrados</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="color: #744d2d; background: #fdf8f4;"><i data-lucide="leaf"></i></div>
                <div class="stat-info">
                    <h3>{{ $totalRetos }}</h3>
                    <p>Misiones Activas</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="color: #3b82f6; background: #eff6ff;"><i data-lucide="message-square"></i></div>
                <div class="stat-info">
                    <h3>{{ $interaccionesHoy }}</h3>
                    <p>Interacciones Hoy</p>
                </div>
            </div>

            <!-- Resumen de Actividad Real -->
            <div class="summary-box">
                <div class="summary-header">
                    <h2><i data-lucide="activity"></i> Actividad del Sistema</h2>
                </div>
                <div class="activity-list">
                    @forelse($actividades as $actividad)
                    <div class="activity-item">
                        <div class="activity-dot" style="background: {{ $actividad['color'] }};"></div>
                        <div class="activity-text">{!! $actividad['texto'] !!}</div>
                        <div class="activity-time">{{ $actividad['tiempo'] }}</div>
                    </div>
                    @empty
                    <p style="text-align: center; color: #94a3b8; padding: 20px;">No hay actividad reciente registrada.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <script>
        // Inicializar iconos
        lucide.createIcons();

        function toggleProfileMenu() {
            const dropdown = document.getElementById('profileDropdown');
            dropdown.classList.toggle('show');
        }

        // Cerrar al hacer clic fuera
        window.onclick = function(event) {
            if (!event.target.closest('.profile-menu-container')) {
                const dropdowns = document.getElementsByClassName("profile-dropdown");
                for (let i = 0; i < dropdowns.length; i++) {
                    const openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</body>
</html>
