<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Proyecto STEAM - Admin</title>
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
        .top-bar { height: 80px; background-color: #744d2d; display: flex; align-items: center; padding: 0 40px; color: white; }
        .content-padding { padding: 40px; }
        .form-card { background: white; padding: 40px; border-radius: 30px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); max-width: 800px; margin: 0 auto; }
        .form-group { margin-bottom: 25px; }
        .form-group label { display: block; font-weight: 600; color: #1a3a2a; margin-bottom: 10px; }
        .form-group input, .form-group textarea, .form-group select { width: 100%; padding: 12px 20px; border-radius: 12px; border: 1px solid #e2e8f0; outline: none; transition: 0.3s; }
        .form-group input:focus, .form-group textarea:focus { border-color: #6ab06a; }
        .btn-save { width: 100%; padding: 15px; background: #1a3a2a; color: white; border: none; border-radius: 15px; font-weight: 700; cursor: pointer; transition: 0.3s; }
        .btn-save:hover { background: #6ab06a; transform: translateY(-3px); }
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
        <div class="top-bar" style="height: 100px; background-color: #744d2d; display: flex; align-items: center; justify-content: flex-end; padding: 0 40px; width: 100%; box-sizing: border-box;">
            <div style="width: 50px; height: 50px; background-color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #744d2d; border: 2px solid white; overflow: hidden; flex-shrink: 0;">
                @if(Auth::check() && Auth::user()->foto_path)
                    <img src="{{ asset(Auth::user()->foto_path) }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    <i data-lucide="user" style="width: 28px; height: 28px;"></i>
                @endif
            </div>
        </div>
        </div>

        <div class="content-padding">
            <div class="form-card">
                <form action="{{ route('admin.steam.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Título del Proyecto</label>
                        <input type="text" name="titulo" placeholder="Ej: Riego Automático" required>
                    </div>
                    <div class="form-group">
                        <label>Categoría</label>
                        <input type="text" name="categoria" placeholder="Ej: Ingeniería + Tecnología" required>
                    </div>
                    <div class="form-group">
                        <label>Descripción / Pasos</label>
                        <textarea name="descripcion" rows="6" placeholder="Explica cómo realizar el proyecto..." required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Objetivos</label>
                        <textarea name="objetivos" rows="3" placeholder="¿Qué se busca lograr?"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Materiales Necesarios</label>
                        <textarea name="materiales" rows="3" placeholder="Lista de materiales..."></textarea>
                    </div>
                    <div class="form-group">
                        <label>Impacto Ambiental</label>
                        <textarea name="impacto_ambiental" rows="3" placeholder="¿Cómo ayuda al medio ambiente?"></textarea>
                    </div>
                    <div class="form-group" style="display: flex; align-items: center; gap: 10px; background: #f0fdf4; padding: 15px; border-radius: 12px;">
                        <input type="checkbox" name="destacado" id="destacado" style="width: 20px; height: 20px; accent-color: #6ab06a;">
                        <label for="destacado" style="margin-bottom: 0; cursor: pointer;">Marcar como Proyecto Destacado</label>
                    </div>
                    <div class="form-group">
                        <label>Imagen de Portada</label>
                        <input type="file" name="imagen" accept="image/*">
                    </div>
                    <button type="submit" class="btn-save">Publicar Proyecto Institucional</button>
                </form>
            </div>
        </div>
    </div>
    <script>lucide.createIcons();</script>
</body>
</html>
