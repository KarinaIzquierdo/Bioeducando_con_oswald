<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { display: flex; height: 100vh; background-color: #f4f7f4; }

        /* Sidebar Estandarizado */
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

        /* Contenido Principal */
        .main-content { flex: 1; display: flex; flex-direction: column; overflow-y: auto; }
        .top-bar { height: 80px; background-color: #744d2d; display: flex; align-items: center; padding: 0 40px; color: white; font-weight: 600; }
        
        .content-padding { padding: 40px; max-width: 900px; margin: 0 auto; width: 100%; }
        
        .profile-container {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 30px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 24px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        .avatar-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .avatar-circle {
            width: 120px;
            height: 120px;
            background: #f0fdf4;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6ab06a;
            margin-bottom: 20px;
            border: 4px solid white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .avatar-section h3 { color: #1a3a2a; margin-bottom: 5px; }
        .avatar-section p { color: #64748b; font-size: 0.9rem; }

        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-weight: 600; color: #444; margin-bottom: 8px; font-size: 0.9rem; }
        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            transition: 0.3s;
            outline: none;
        }
        .form-control:focus { border-color: #6ab06a; box-shadow: 0 0 0 4px rgba(106, 176, 106, 0.1); }

        .btn-save {
            background: #6ab06a;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .btn-save:hover { background: #5aa05a; transform: translateY(-2px); }

        .section-title {
            font-size: 1.2rem;
            color: #1a3a2a;
            font-weight: 700;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-weight: 600;
            font-size: 0.95rem;
        }
        .alert-success { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
        .alert-error { background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; }
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
        <div class="top-bar">
            <span>Bioeducando con Oswald - Gestión de Perfil</span>
        </div>

        <div class="content-padding">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="profile-container">
                <div class="avatar-section card">
                    <div class="avatar-circle">
                        <i data-lucide="user" size="60"></i>
                    </div>
                    <h3>{{ $user->name }}</h3>
                    <p>Administrador del Sistema</p>
                    <div style="margin-top: 20px; font-size: 0.85rem; color: #94a3b8;">
                        Miembro desde {{ $user->created_at->format('M Y') }}
                    </div>
                </div>

                <div class="forms-section">
                    <!-- Datos Personales -->
                    <div class="card" style="margin-bottom: 30px;">
                        <h2 class="section-title"><i data-lucide="user-cog"></i> Datos Personales</h2>
                        <form action="{{ route('admin.profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Nombre Completo</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                            </div>
                            <div class="form-group">
                                <label>Correo Electrónico</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                            </div>
                            <button type="submit" class="btn-save">
                                <i data-lucide="save"></i> Guardar Cambios
                            </button>
                        </form>
                    </div>

                    <!-- Cambio de Contraseña -->
                    <div class="card">
                        <h2 class="section-title"><i data-lucide="lock"></i> Seguridad</h2>
                        <form action="{{ route('admin.profile.password') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Contraseña Actual</label>
                                <input type="password" name="current_password" class="form-control" placeholder="••••••••">
                            </div>
                            <div class="form-group">
                                <label>Nueva Contraseña</label>
                                <input type="password" name="password" class="form-control" placeholder="Mínimo 8 caracteres">
                            </div>
                            <div class="form-group">
                                <label>Confirmar Nueva Contraseña</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Repite la nueva contraseña">
                            </div>
                            <button type="submit" class="btn-save" style="background: #1a3a2a;">
                                <i data-lucide="shield-check"></i> Actualizar Contraseña
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
