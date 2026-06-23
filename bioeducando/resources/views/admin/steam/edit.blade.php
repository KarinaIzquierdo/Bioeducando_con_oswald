<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Proyecto STEAM - Admin</title>
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
        .top-bar { height: 100px; background-color: #744d2d; display: flex; align-items: center; justify-content: space-between; padding: 0 40px; color: white; }
        .top-bar h2 { color: white; font-size: 1.8rem; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; margin: 0; display: flex; align-items: center; gap: 12px; }
        .content-padding { padding: 40px; }
        .form-card { background: white; padding: 40px; border-radius: 30px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); max-width: 800px; margin: 0 auto; }
        .form-group { margin-bottom: 25px; }
        .form-group label { display: block; font-weight: 600; color: #1a3a2a; margin-bottom: 10px; }
        .form-group input, .form-group textarea { width: 100%; padding: 12px 20px; border-radius: 12px; border: 1px solid #e2e8f0; outline: none; transition: 0.3s; }
        .form-group input:focus, .form-group textarea:focus { border-color: #6ab06a; }
        .btn-save { width: 100%; padding: 15px; background: #1a3a2a; color: white; border: none; border-radius: 15px; font-weight: 700; cursor: pointer; transition: 0.3s; }
        .btn-save:hover { background: #6ab06a; transform: translateY(-3px); }
        /* Estilos para el botón de subida moderno */
        .file-upload-wrapper {
            position: relative;
            width: 100%;
            height: 60px;
            background: #f8fafc;
            border: 2px dashed #6ab06a;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: 0.3s;
            overflow: hidden;
            margin-top: 10px;
        }
        .file-upload-wrapper:hover {
            background: #f0fdf4;
            border-color: #1a3a2a;
        }
        .file-upload-wrapper input[type="file"] {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }
        .file-upload-content {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #6ab06a;
            font-weight: 700;
        }
        .image-preview-admin {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 20px;
            margin-bottom: 15px;
            border: 3px solid #f0fdf4;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
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
            <a href="{{ route('admin.noticias') }}" class="menu-item {{ Request::is('admin/noticias*') ? 'active' : '' }}">
                <i data-lucide="newspaper"></i> Noticias
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
            <h2><i data-lucide="microscope"></i> Editar Proyecto STEAM</h2>
            <div style="width: 50px; height: 50px; background-color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #744d2d; border: 2px solid white; overflow: hidden; flex-shrink: 0;">
                @if(Auth::check() && Auth::user()->foto_path)
                    <img src="{{ asset(Auth::user()->foto_path) }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    <i data-lucide="user" style="width: 28px; height: 28px;"></i>
                @endif
            </div>
        </div>

        <div class="content-padding">
            <div class="form-card">
                <form action="{{ route('admin.steam.update', $proyecto->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Título del Proyecto</label>
                        <input type="text" name="titulo" value="{{ $proyecto->titulo }}" required>
                    </div>
                    <div class="form-group">
                        <label>Categoría</label>
                        <input type="text" name="categoria" value="{{ $proyecto->categoria }}" required>
                    </div>
                    <div class="form-group">
                        <label>Descripción / Pasos</label>
                        <textarea name="descripcion" rows="6" required>{{ $proyecto->descripcion }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Objetivos</label>
                        <textarea name="objetivos" rows="3" required>{{ $proyecto->objetivos }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Materiales Necesarios</label>
                        <textarea name="materiales" rows="3" required>{{ $proyecto->materiales }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Impacto Ambiental</label>
                        <textarea name="impacto_ambiental" rows="3" required>{{ $proyecto->impacto_ambiental }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Estado del Proyecto</label>
                        <select name="estado" class="form-control" style="width: 100%; padding: 12px; border-radius: 12px; border: 1px solid #e2e8f0;">
                            <option value="pendiente" {{ $proyecto->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="aprobado" {{ $proyecto->estado == 'aprobado' ? 'selected' : '' }}>Aprobado</option>
                            <option value="rechazado" {{ $proyecto->estado == 'rechazado' ? 'selected' : '' }}>Rechazado</option>
                        </select>
                    </div>
                    <div class="form-group" style="display: flex; align-items: center; gap: 10px; background: #f0fdf4; padding: 15px; border-radius: 12px;">
                        <input type="checkbox" name="destacado" id="destacado" {{ $proyecto->destacado ? 'checked' : '' }} style="width: 20px; height: 20px; accent-color: #6ab06a;">
                        <label for="destacado" style="margin-bottom: 0; cursor: pointer;">Marcar como Proyecto Destacado</label>
                    </div>
                    <div class="form-group">
                        <label>Imagen del Proyecto</label>
                        @if($proyecto->imagen)
                            <img id="admin-preview" src="{{ asset('storage/' . $proyecto->imagen) }}" class="image-preview-admin">
                        @else
                            <div id="no-image-placeholder" style="height: 200px; background: #eee; display: flex; align-items: center; justify-content: center; border-radius: 15px; margin-bottom: 10px;">
                                <i data-lucide="image" size="40" color="#ccc"></i>
                            </div>
                            <img id="admin-preview" src="#" class="image-preview-admin" style="display: none;">
                        @endif

                        <div class="file-upload-wrapper">
                            <input type="file" name="imagen" accept="image/*" onchange="previewAdminImage(this)">
                            <div class="file-upload-content">
                                <i data-lucide="image-plus"></i>
                                <span>Cambiar imagen del proyecto</span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn-save">Actualizar Proyecto STEAM</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        lucide.createIcons();

        function previewAdminImage(input) {
            const preview = document.getElementById('admin-preview');
            const placeholder = document.getElementById('no-image-placeholder');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    if(placeholder) placeholder.style.display = 'none';
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>
