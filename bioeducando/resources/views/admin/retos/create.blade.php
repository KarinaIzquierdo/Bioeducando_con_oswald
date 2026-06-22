<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Reto - Bioeducando</title>
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
        .content-padding { padding: 40px; max-width: 800px; margin: 0 auto; width: 100%; }
        .form-card { background: white; padding: 40px; border-radius: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .form-header { margin-bottom: 30px; border-bottom: 2px solid #f0f0f0; padding-bottom: 20px; }
        .form-header h2 { color: #1a3a2a; font-size: 1.8rem; display: flex; align-items: center; gap: 12px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-weight: 600; color: #444; margin-bottom: 8px; font-size: 0.95rem; }
        .form-control { width: 100%; padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 12px; font-size: 1rem; transition: 0.3s; outline: none; }
        .form-control:focus { border-color: #6ab06a; box-shadow: 0 0 0 4px rgba(106, 176, 106, 0.1); }
        textarea.form-control { height: 120px; resize: none; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .checkbox-group { background: #f8faf8; padding: 15px; border-radius: 12px; margin-top: 10px; }
        .checkbox-item { display: flex; align-items: center; gap: 10px; margin-bottom: 8px; cursor: pointer; }
        .checkbox-item input { width: 18px; height: 18px; accent-color: #6ab06a; }
        .btn-submit { background: #6ab06a; color: white; width: 100%; padding: 16px; border: none; border-radius: 14px; font-size: 1.1rem; font-weight: 600; cursor: pointer; transition: 0.3s; margin-top: 20px; display: flex; align-items: center; justify-content: center; gap: 10px; }
        .btn-submit:hover { background: #5aa05a; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(106, 176, 106, 0.3); }
        .back-link { display: flex; align-items: center; gap: 5px; color: #666; text-decoration: none; margin-bottom: 20px; font-weight: 600; }
        .back-link:hover { color: #6ab06a; }
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
            <h2><i data-lucide="recycle"></i> Crear Misión</h2>
            <div style="width: 50px; height: 50px; background-color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #744d2d; border: 2px solid white; overflow: hidden; flex-shrink: 0;">
                @if(Auth::check() && Auth::user()->foto_path)
                    <img src="{{ asset(Auth::user()->foto_path) }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    <i data-lucide="user" style="width: 28px; height: 28px;"></i>
                @endif
            </div>
        </div>
                <form action="{{ route('admin.retos.store') }}" method="POST">
                    @csrf
                    <div class="form-group"><label>Título</label><input type="text" class="form-control" name="titulo" required placeholder="Ej: Clasificador experto"></div>
                    <div class="form-group"><label>Descripción</label><textarea class="form-control" name="descripcion" required placeholder="Escribe aquí los detalles de la misión..."></textarea></div>
                    <div class="form-row">
                        <div class="form-group"><label>Estado</label><select class="form-control" name="estado"><option value="activa">Activa ▼</option><option value="inactiva">Inactiva</option></select></div>
                        <div class="form-group"><label>Categoría</label><select class="form-control" name="categoria"><option value="reciclaje">Reciclaje ▼</option><option value="agua">Cuidado del Agua</option><option value="energia">Ahorro de Energía</option><option value="biodiversidad">Biodiversidad</option></select></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group"><label>Dificultad</label><select class="form-control" name="dificultad"><option value="facil">Fácil</option><option value="intermedio" selected>Intermedio ▼</option><option value="dificil">Difícil</option></select></div>
                        <div class="form-group"><label>Puntos</label><input type="number" class="form-control" name="puntos" value="100"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group"><label>Duración</label><input type="text" class="form-control" name="duracion" placeholder="Ej: 7 días"></div>
                        <div class="form-group"><label>Insignia</label><select class="form-control" name="insignia"><option value="experto">Reciclador Experto ▼</option><option value="guardian">Guardián del Bosque</option><option value="maestro">Maestro Ambiental</option></select></div>
                    </div>
                    <div class="form-group">
                        <label>Evidencia requerida</label>
                        <div class="checkbox-group">
                            <label class="checkbox-item"><input type="checkbox" name="evidencias[]" value="foto" checked><span>Foto</span></label>
                            <label class="checkbox-item"><input type="checkbox" name="evidencias[]" value="reflexion" checked><span>Reflexión</span></label>
                            <label class="checkbox-item"><input type="checkbox" name="evidencias[]" value="video"><span>Video</span></label>
                        </div>
                    </div>
                    <button type="submit" class="btn-submit"><i data-lucide="plus"></i> Crear Reto</button>
                </form>
            </div>
        </div>
    </div>
    <script>lucide.createIcons();</script>
</body>
</html>
