<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comunidad Ambiental - Bioeducando</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #f8fafc; min-height: 100vh; }
        .sidebar { width: 260px; background-color: #6ab06a; display: flex; flex-direction: column; padding: 20px; position: fixed; height: 100vh; z-index: 1000; }
        .sidebar-title { font-size: 2.2rem; font-weight: 600; color: #000; margin-bottom: 40px; padding-left: 10px; }
        .menu-item { display: flex; align-items: center; padding: 12px 15px; color: white; text-decoration: none; margin-bottom: 10px; border-radius: 10px; transition: 0.3s; font-size: 1rem; }
        .menu-item i { margin-right: 12px; width: 20px; }
        .menu-item.active { background-color: #3d5a44; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .menu-item:hover:not(.active) { background-color: rgba(255,255,255,0.1); }
        .sidebar-footer { margin-top: auto; display: flex; flex-direction: column; align-items: center; gap: 15px; padding: 20px 0; width: 100%; }
        .sidebar-logo { width: 140px; filter: brightness(0); margin-bottom: 5px; }
        .btn-logout { width: 100%; padding: 12px; background-color: #000; color: white; border: none; border-radius: 10px; cursor: pointer; display: flex; align-items: center; justify-content: center; font-weight: 600; transition: 0.3s; text-transform: lowercase; }
        .main-content { margin-left: 260px; min-height: 100vh; display: flex; flex-direction: column; }
        .top-bar { height: 100px; background-color: #744d2d; display: flex; align-items: center; justify-content: space-between; padding: 0 40px; width: 100%; box-sizing: border-box; }
        .top-bar h2 { color: white; font-size: 1.8rem; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; margin: 0; }
        .profile-icon { width: 50px; height: 50px; background-color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #744d2d; border: 2px solid white; overflow: hidden; flex-shrink: 0; }
        .profile-icon img { width: 100%; height: 100%; object-fit: cover; }
        .container { padding: 40px; flex: 1; max-width: 1000px; margin: 0 auto; width: 100%; }
        .post-card { background: white; border-radius: 25px; padding: 30px; margin-bottom: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .post-header { display: flex; align-items: center; gap: 15px; margin-bottom: 20px; }
        .user-avatar { width: 45px; height: 45px; border-radius: 50%; background: #f0fdf4; display: flex; align-items: center; justify-content: center; color: #6ab06a; overflow: hidden; }
        .user-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .user-info h3 { font-size: 1rem; color: #1a3a2a; font-weight: 700; }
        .user-info span { font-size: 0.85rem; color: #64748b; }
        .post-content { color: #334155; line-height: 1.6; margin-bottom: 20px; font-size: 1.05rem; }
        .post-media { border-radius: 20px; overflow: hidden; background: #000; margin-bottom: 20px; }
        .post-media img, .post-media video { width: 100%; display: block; max-height: 600px; object-fit: contain; }
        .post-actions { display: flex; gap: 20px; padding-top: 15px; border-top: 1px solid #f1f5f9; }
        .action-btn { display: flex; align-items: center; gap: 8px; color: #64748b; text-decoration: none; font-size: 0.95rem; transition: 0.3s; }
        .action-btn:hover { color: #6ab06a; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h1 class="sidebar-title">Usuario</h1>
        <nav>
            <a href="{{ route('profile.edit') }}" class="menu-item"><i data-lucide="user"></i> Perfil</a>
            <a href="{{ route('retos.publica') }}" class="menu-item"><i data-lucide="leaf"></i> Retos Ecológicos</a>
            <a href="{{ route('comunidad.publica') }}" class="menu-item active"><i data-lucide="flower-2"></i> Comunidad Ambiental</a>
            <a href="{{ route('contenido.creacion') }}" class="menu-item"><i data-lucide="clapperboard"></i> Eco-Estudio</a>
            <a href="{{ route('steam.proyectos') }}" class="menu-item"><i data-lucide="microscope"></i> Proyectos STEAM</a>
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
            <h2>Comunidad Ambiental</h2>
            <div class="profile-icon">
                @if(Auth::check() && Auth::user()->avatar)
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Perfil">
                @else
                    <i data-lucide="user" style="width: 28px; height: 28px;"></i>
                @endif
            </div>
        </div>
        <div class="container">
            @forelse($publicaciones as $post)
            <div class="post-card">
                <div class="post-header">
                    <div class="user-avatar">
                        @if($post->user->avatar)<img src="{{ asset('storage/' . $post->user->avatar) }}" alt="">
                        @else<i data-lucide="user" size="20"></i>@endif
                    </div>
                    <div class="user-info"><h3>{{ $post->user->name }}</h3><span>{{ $post->created_at->diffForHumans() }}</span></div>
                </div>
                <div class="post-content">{{ $post->contenido }}</div>
                @if($post->media_path)
                <div class="post-media">
                    @if($post->media_type == 'video')<video src="{{ asset('storage/' . $post->media_path) }}" controls></video>
                    @else<img src="{{ asset('storage/' . $post->media_path) }}" alt="">@endif
                </div>
                @endif
                <div class="post-actions"><a href="#" class="action-btn"><i data-lucide="heart"></i> Me gusta</a><a href="#" class="action-btn"><i data-lucide="message-circle"></i> Comentar</a></div>
            </div>
            @empty
            <div style="text-align: center; padding: 100px; color: #64748b;"><i data-lucide="users" size="60" style="margin-bottom: 20px; opacity: 0.3;"></i><h2>Aún no hay publicaciones</h2><p>¡Sé el primero en compartir algo en Eco-Estudio!</p></div>
            @endforelse
        </div>
    </div>
    <script>lucide.createIcons();</script>
</body>
</html>
