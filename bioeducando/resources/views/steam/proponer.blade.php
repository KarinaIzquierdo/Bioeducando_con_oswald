<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proponer Proyecto - Bioeducando</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #f0f9ff; min-height: 100vh; display: flex; }
        .sidebar { width: 260px; background-color: #6ab06a; display: flex; flex-direction: column; padding: 20px; position: fixed; height: 100vh; z-index: 1000; }
        .sidebar-title { font-size: 2.2rem; font-weight: 600; color: #000; margin-bottom: 40px; padding-left: 10px; }
        .menu-item { display: flex; align-items: center; padding: 12px 15px; color: white; text-decoration: none; margin-bottom: 10px; border-radius: 10px; transition: 0.3s; font-size: 1rem; }
        .menu-item i { margin-right: 12px; width: 20px; }
        .menu-item.active { background-color: #3d5a44; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .menu-item:hover:not(.active) { background-color: rgba(255,255,255,0.1); }
        .sidebar-footer { margin-top: auto; display: flex; flex-direction: column; align-items: center; gap: 15px; padding: 20px 0; width: 100%; }
        .sidebar-logo { width: 140px; filter: brightness(0); margin-bottom: 5px; }
        .btn-logout { width: 100%; padding: 12px; background-color: #000; color: white; border: none; border-radius: 10px; cursor: pointer; display: flex; align-items: center; justify-content: center; font-weight: 600; transition: 0.3s; text-transform: lowercase; }
        .main-content { flex: 1; margin-left: 260px; display: flex; flex-direction: column; min-height: 100vh; }
        .top-bar { height: 100px; background-color: #744d2d; display: flex; align-items: center; justify-content: space-between; padding: 0 40px; width: 100%; position: sticky; top: 0; z-index: 900; }
        .top-bar h2 { color: white; font-size: 1.8rem; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; margin: 0; }
        .profile-icon { width: 50px; height: 50px; background-color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #744d2d; border: 2px solid white; overflow: hidden; flex-shrink: 0; }
        .profile-icon img { width: 100%; height: 100%; object-fit: cover; }
        .container { padding: 40px; flex: 1; width: 100%; max-width: 900px; margin: 0 auto; }
        .card { background: white; border-radius: 25px; padding: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .form-group { margin-bottom: 25px; }
        .form-group label { display: block; font-weight: 700; color: #1a3a2a; margin-bottom: 10px; }
        .form-control { width: 100%; padding: 15px; border: 2px solid #e2e8f0; border-radius: 15px; font-size: 1rem; transition: 0.3s; outline: none; }
        .form-control:focus { border-color: #6ab06a; }
        .btn-submit { width: 100%; padding: 18px; background: #6ab06a; color: white; border: none; border-radius: 15px; font-weight: 800; font-size: 1.1rem; cursor: pointer; transition: 0.3s; display: flex; align-items: center; justify-content: center; gap: 10px; }
        .btn-submit:hover { background: #5aa05a; transform: translateY(-3px); }
    </style>
</head>
<body>
    <div class="sidebar">
        <h1 class="sidebar-title">Usuario</h1>
        <nav>
            <a href="{{ route('profile.edit') }}" class="menu-item"><i data-lucide="user"></i> Perfil</a>
            <a href="{{ route('retos.publica') }}" class="menu-item"><i data-lucide="leaf"></i> Retos Ecológicos</a>
            <a href="{{ route('comunidad.publica') }}" class="menu-item"><i data-lucide="flower-2"></i> Comunidad Ambiental</a>
            <a href="{{ route('contenido.creacion') }}" class="menu-item"><i data-lucide="clapperboard"></i> Eco-Estudio</a>
            <a href="{{ route('steam.proyectos') }}" class="menu-item active"><i data-lucide="microscope"></i> Proyectos STEAM</a>
            <a href="{{ route('prae.proyectos') }}" class="menu-item"><i data-lucide="book-open"></i> Proyectos PRAE</a>
            <a href="#" class="menu-item"><i data-lucide="settings"></i> Configuración</a>
        </nav>
        <div class="sidebar-footer">
            <img src="/imagenes/Logo.svg" alt="Logo" class="sidebar-logo">
            <form action="{{ route('logout') }}" method="POST" style="width: 100%;">@csrf<button type="submit" class="btn-logout">cerrar sesión</button></form>
        </div>
    </div>
    <div class="main-content">
        <div class="top-bar">
            <h2>Proponer Proyecto</h2>
            <div class="profile-icon">
                @if(Auth::check() && Auth::user()->avatar)
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Perfil">
                @else
                    <i data-lucide="user" style="width: 28px; height: 28px;"></i>
                @endif
            </div>
        </div>
        <div class="container">
            <div class="card">
                <h1 style="font-size: 2rem; color: #1a3a2a; font-weight: 800; margin-bottom: 10px;">Nueva Propuesta STEAM</h1>
                <p style="color: #64748b; margin-bottom: 30px;">Comparte tu idea innovadora con la comunidad educativa.</p>
                <form action="{{ route('steam.store_propuesta') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group"><label>Título del Proyecto</label><input type="text" name="titulo" class="form-control" placeholder="Ej: Energía Solar Casera" required></div>
                    <div class="form-group"><label>Categoría</label><select name="categoria" class="form-control"><option value="ciencia">Ciencia</option><option value="tecnologia">Tecnología</option><option value="ingenieria">Ingeniería</option><option value="arte">Arte</option><option value="matematicas">Matemáticas</option></select></div>
                    <div class="form-group"><label>Descripción Detallada</label><textarea name="descripcion" class="form-control" rows="6" placeholder="Explica tu proyecto..." required></textarea></div>
                    <div class="form-group"><label>Imagen de Portada</label><input type="file" name="imagen" class="form-control" accept="image/*"></div>
                    <button type="submit" class="btn-submit">Enviar Propuesta <i data-lucide="send"></i></button>
                </form>
            </div>
        </div>
    </div>
    <script>lucide.createIcons();</script>
</body>
</html>
