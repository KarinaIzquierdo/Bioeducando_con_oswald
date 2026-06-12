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
        body { 
            background-color: #f0fdf4;
            min-height: 100vh;
        }

        .sidebar { 
            width: 260px; 
            background-color: #6ab06a; 
            display: flex; 
            flex-direction: column; 
            padding: 20px; 
            position: fixed;
            height: 100vh;
            z-index: 1000;
        }
        
        .sidebar-title { 
            font-size: 2.2rem; 
            font-weight: 600; 
            color: #000; 
            margin-bottom: 40px; 
            padding-left: 10px;
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
            background-color: #000;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            transition: 0.3s;
            text-transform: lowercase;
        }

        /* Contenido Principal */
        .main-content { margin-left: 260px; min-height: 100vh; display: flex; flex-direction: column; }
        
        .top-bar { 
            height: 100px; 
            background-color: #744d2d; 
            display: flex; 
            align-items: center; 
            justify-content: space-between;
            padding: 0 40px; 
        }

        .top-bar h2 {
            color: white;
            font-size: 1.8rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .profile-icon-container {
            background: white;
            padding: 5px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container { 
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 20px; 
            width: 100%;
        }

        .post-card {
            background: white;
            border-radius: 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .post-header {
            padding: 25px 30px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .avatar-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
        }

        .user-meta h4 {
            color: #1a3a2a;
            font-weight: 800;
            font-size: 1.1rem;
        }

        .user-meta span {
            color: #94a3b8;
            font-size: 0.85rem;
        }

        .post-body {
            padding: 0 30px 25px;
            font-size: 1.1rem;
            color: #334155;
            line-height: 1.6;
        }

        .media-box {
            margin: 0 25px 25px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .media-box img, .media-box video {
            width: 100%;
            display: block;
        }

        .post-actions {
            padding: 15px 30px;
            background: #fafafa;
            border-top: 1px solid #f0f0f0;
            display: flex;
            gap: 15px;
        }

        .action-btn {
            background: #1a3a2a;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: 0.3s;
        }

        .action-btn:hover {
            background: #6ab06a;
            transform: translateY(-2px);
        }

        .action-btn.liked {
            background: #ff4d4d;
        }

        .action-btn.liked i {
            fill: white;
        }

        /* Comentarios */
        .comments-area {
            padding: 25px 30px;
            background: #fcfdfc;
            border-top: 1px solid #eee;
        }

        .comment-item {
            display: flex;
            gap: 12px;
            margin-bottom: 15px;
        }

        .comment-bubble {
            background: white;
            border: 1px solid #e2e8f0;
            padding: 12px 18px;
            border-radius: 20px;
            flex: 1;
        }

        .comment-user {
            font-weight: 800;
            color: #1a3a2a;
            font-size: 0.9rem;
            margin-bottom: 3px;
        }

        .comment-text {
            color: #475569;
            font-size: 0.95rem;
            line-height: 1.4;
        }

        .comment-form {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .comment-input {
            flex: 1;
            padding: 12px 20px;
            border-radius: 15px;
            border: 1px solid #e2e8f0;
            outline: none;
            font-size: 1rem;
            transition: 0.3s;
        }

        .comment-input:focus {
            border-color: #6ab06a;
            box-shadow: 0 0 0 3px rgba(106, 176, 106, 0.1);
        }

        .send-btn {
            background: #6ab06a;
            color: white;
            border: none;
            padding: 0 20px;
            border-radius: 15px;
            font-weight: 700;
            cursor: pointer;
        }

    </style>
</head>
<body>

    <div class="sidebar">
        <h1 class="sidebar-title">Usuario</h1>
        <nav>
            <a href="{{ route('profile.edit') }}" class="menu-item">
                <i data-lucide="user"></i> Perfil
            </a>
            <a href="{{ route('retos.publica') }}" class="menu-item">
                <i data-lucide="leaf"></i> Retos Ecológicos
            </a>
            <a href="{{ route('comunidad.publica') }}" class="menu-item active">
                <i data-lucide="flower-2"></i> Comunidad Ambiental
            </a>
            <a href="{{ route('contenido.creacion') }}" class="menu-item">
                <i data-lucide="clapperboard"></i> Eco-Estudio
            </a>
            <a href="{{ route('steam.proyectos') }}" class="menu-item">
                <i data-lucide="microscope"></i> Proyectos STEAM
            </a>
            <a href="{{ route('prae.proyectos') }}" class="menu-item">
                <i data-lucide="book-open"></i> Proyectos PRAE
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

    <div class="main-content">
        <div class="top-bar">
            <h2>Comunidad Ambiental</h2>
            <div class="profile-icon-container">
                @if(Auth::user()->avatar)
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Perfil" style="border-radius: 50%; width: 50px; height: 50px; object-fit: cover;">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=fff&color=744d2d&size=50" alt="Perfil" style="border-radius: 50%; width: 50px; height: 50px;">
                @endif
            </div>
        </div>

        <div class="container">
            @foreach($publicaciones as $post)
            <div class="post-card">
                <div class="post-header">
                    <div class="avatar-circle" style="background: {{ $post->user->id % 2 == 0 ? '#6ab06a' : '#744d2d' }}; overflow: hidden;">
                        @if($post->user->avatar)
                            <img src="{{ asset('storage/' . $post->user->avatar) }}" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            {{ substr($post->user->name, 0, 1) }}
                        @endif
                    </div>
                    <div class="user-meta" style="flex: 1;">
                        <h4>{{ $post->user->name }}</h4>
                        <span>{{ $post->created_at->diffForHumans() }}</span>
                    </div>
                    @if(Auth::id() == $post->user_id || (Auth::user()->role && Auth::user()->role->name == 'admin'))
                    <div class="post-options">
                        <form action="{{ route('comunidad.destroy', $post->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta publicación?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: #94a3b8; cursor: pointer; transition: 0.3s; padding: 5px;" onmouseover="this.style.color='#ff4d4d'" onmouseout="this.style.color='#94a3b8'">
                                <i data-lucide="trash-2" size="20"></i>
                            </button>
                        </form>
                    </div>
                    @endif
                </div>

                <div class="post-body">
                    {{ $post->contenido }}
                </div>

                @if($post->media_path)
                    <div class="media-box">
                        @if($post->media_type == 'image')
                            <img src="{{ asset('storage/' . $post->media_path) }}" alt="Post">
                        @elseif($post->media_type == 'video')
                            <video controls>
                                <source src="{{ asset('storage/' . $post->media_path) }}" type="video/mp4">
                            </video>
                        @endif
                    </div>
                @endif

                <div class="post-actions">
                    <button class="action-btn like-btn" onclick="toggleLike(this)">
                        <i data-lucide="heart"></i>
                        Me gusta
                    </button>
                    <button class="action-btn" onclick="toggleComments({{ $post->id }})">
                        <i data-lucide="message-square"></i>
                        Comentar
                    </button>
                </div>

                <div id="comments-{{ $post->id }}" class="comments-area" style="display: none;">
                    <div class="comments-list">
                        @forelse($post->comentarios as $comentario)
                            <div class="comment-item">
                                <div class="avatar-circle" style="width: 35px; height: 35px; font-size: 0.8rem; background: #6ab06a;">
                                    {{ substr($comentario->user->name ?? 'U', 0, 1) }}
                                </div>
                                <div class="comment-bubble">
                                    <div class="comment-user">{{ $comentario->user->name ?? 'Usuario' }}</div>
                                    <div class="comment-text">{{ $comentario->contenido }}</div>
                                </div>
                            </div>
                        @empty
                            <p style="text-align: center; color: #94a3b8; font-style: italic; font-size: 0.9rem;">Sé el primero en comentar...</p>
                        @endforelse
                    </div>

                    <form action="{{ route('comentarios.store') }}" method="POST" class="comment-form">
                        @csrf
                        <input type="hidden" name="publicacion_id" value="{{ $post->id }}">
                        <input type="text" name="contenido" class="comment-input" placeholder="Escribe un comentario..." required>
                        <button type="submit" class="send-btn">
                            <i data-lucide="send" size="20"></i>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach

            @if($publicaciones->isEmpty())
                <div style="text-align: center; padding: 60px; color: #94a3b8;">
                    <i data-lucide="message-square" size="60" style="opacity: 0.3; margin-bottom: 20px;"></i>
                    <p>No hay publicaciones en la comunidad todavía.</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        lucide.createIcons();

        function toggleLike(btn) {
            btn.classList.toggle('liked');
        }

        function toggleComments(postId) {
            const area = document.getElementById('comments-' + postId);
            area.style.display = area.style.display === 'none' ? 'block' : 'none';
        }

        // Mantener abiertos los comentarios después de publicar si hay una sesión activa
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success') && str_contains(session('success'), 'Comentario'))
                // Si acabamos de comentar, podríamos intentar encontrar el último post comentado
                // Por ahora, el redirect back recarga la página, así que esto es para futuras mejoras AJAX
            @endif
        });
    </script>
</body>
</html>
