<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Proyecto PRAE - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { display: flex; height: 100vh; background-color: #f4f7f4; }
        .sidebar { width: 260px; background-color: #6ab06a; display: flex; flex-direction: column; padding: 20px; }
        .admin-title { font-size: 2rem; font-weight: 600; color: #000; margin-bottom: 40px; text-align: center; }
        .menu-item { display: flex; align-items: center; padding: 12px 15px; color: white; text-decoration: none; margin-bottom: 10px; border-radius: 10px; transition: 0.3s; }
        .menu-item i { margin-right: 12px; }
        .menu-item.active { background-color: #3d5a44; }
        .main-content { flex: 1; display: flex; flex-direction: column; overflow-y: auto; }
        .top-bar { height: 80px; background-color: #744d2d; display: flex; align-items: center; padding: 0 40px; color: white; }
        .content-padding { padding: 40px; }
        .form-card { background: white; padding: 40px; border-radius: 30px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); max-width: 800px; margin: 0 auto; }
        .form-group { margin-bottom: 25px; }
        .form-group label { display: block; font-weight: 600; color: #1a3a2a; margin-bottom: 10px; }
        .form-group input, .form-group textarea { width: 100%; padding: 12px 20px; border-radius: 12px; border: 1px solid #e2e8f0; outline: none; transition: 0.3s; }
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
        <div class="top-bar">
            <span>Nuevo Proyecto PRAE</span>
        </div>

        <div class="content-padding">
            <div class="form-card">
                <form action="{{ route('admin.prae.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Título del Proyecto PRAE</label>
                        <input type="text" name="titulo" placeholder="Ej: Recuperación de la Cuenca del Río" required>
                    </div>
                    <div class="form-group">
                        <label>Institución Educativa</label>
                        <input type="text" name="institucion" placeholder="Nombre del colegio o institución" required>
                    </div>
                    <div class="form-group">
                        <label>Descripción detallada</label>
                        <textarea name="descripcion" rows="6" placeholder="Explica los objetivos y el impacto del proyecto..." required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Imagen de Portada</label>
                        <input type="file" name="imagen" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label>Documento del Proyecto (PDF)</label>
                        <input type="file" name="archivo_pdf" accept="application/pdf">
                    </div>
                    <button type="submit" class="btn-save">Publicar Proyecto PRAE</button>
                </form>
            </div>
        </div>
    </div>
    <script>lucide.createIcons();</script>
</body>
</html>
