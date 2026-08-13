<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias Ambientales - Bioeducando</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #f0fdf4; min-min-height: 100vh; display: flex; }

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

        .container { padding: 40px 20px; flex: 1; width: 100%; margin: 0; display: flex; flex-direction: column; align-items: center; }
        .feed { width: 100%; max-width: 680px; display: flex; flex-direction: column; gap: 20px; }
        .noticia-card { background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1); transition: 0.2s; }
        .noticia-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.15); }
        .noticia-img { width: 100%; max-height: 400px; object-fit: cover; display: block; }
        .noticia-video { width: 100%; max-height: 400px; display: block; background: #000; }
        .noticia-pdf { width: 100%; height: 180px; background: #f0f0f0; display: flex; flex-direction: column; align-items: center; justify-content: center; color: #6ab06a; gap: 10px; }
        .noticia-body { padding: 16px 20px; }
        .noticia-header { display: flex; align-items: center; gap: 10px; margin-bottom: 10px; }
        .noticia-avatar { width: 40px; height: 40px; background: #6ab06a; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 0.9rem; }
        .noticia-author { font-size: 0.9rem; font-weight: 600; color: #1a3a2a; }
        .noticia-time { font-size: 0.75rem; color: #94a3b8; }
        .noticia-antetitulo { font-size: 0.75rem; font-weight: 700; color: #6ab06a; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 4px; }
        .noticia-title { font-size: 1.15rem; font-weight: 700; color: #1a3a2a; margin-bottom: 6px; }
        .noticia-subtitulo { font-size: 0.95rem; color: #64748b; margin-bottom: 8px; }
        .noticia-entradilla { color: #475569; line-height: 1.5; font-size: 0.9rem; }
        .noticia-footer { padding: 10px 20px; border-top: 1px solid #f0f0f0; display: flex; gap: 20px; }
        .noticia-action { color: #64748b; font-size: 0.85rem; font-weight: 600; display: flex; align-items: center; gap: 6px; cursor: pointer; transition: 0.2s; padding: 4px 0; }
        .noticia-action:hover { color: #6ab06a; }
        .noticia-action.liked { color: #e11d48; }
        .noticia-action.liked:hover { color: #be123c; }
        .heart-icon.filled { fill: #e11d48; color: #e11d48; }
        .noticia-meta-row { padding: 0 20px 12px; display: flex; justify-content: space-between; align-items: center; }
        .noticia-categoria { background: #e8f5e9; color: #166534; padding: 3px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; }
        .noticia-date { font-size: 0.75rem; color: #94a3b8; }
        .comments-section { padding: 0 20px 16px; border-top: 1px solid #f0f0f0; }
        .comments-list { max-height: 250px; overflow-y: auto; padding: 10px 0; }
        .comment-item { display: flex; gap: 10px; margin-bottom: 12px; }
        .comment-avatar { width: 32px; height: 32px; background: #e2e8f0; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #64748b; font-weight: 700; font-size: 0.75rem; flex-shrink: 0; }
        .comment-content { background: #f8fafc; padding: 8px 12px; border-radius: 12px; flex: 1; }
        .comment-author { font-size: 0.8rem; font-weight: 700; color: #1a3a2a; margin-bottom: 2px; }
        .comment-text { font-size: 0.85rem; color: #475569; line-height: 1.4; }
        .comment-time { font-size: 0.7rem; color: #94a3b8; margin-top: 4px; }
        .comment-input-area { display: flex; gap: 8px; align-items: center; padding-top: 8px; }
        .comment-input { flex: 1; padding: 10px 14px; border-radius: 20px; border: 1px solid #e2e8f0; outline: none; font-size: 0.85rem; background: #f8fafc; }
        .comment-input:focus { border-color: #6ab06a; }
        .comment-btn { background: #6ab06a; color: white; border: none; width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: 0.2s; }
        .comment-btn:hover { background: #3d5a44; }
        @media (max-width: 768px) {
            body { flex-direction: column; }

            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                padding: 15px;
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
            }

            .sidebar-title {
                font-size: 1.5rem;
                margin-bottom: 15px;
                width: 100%;
                text-align: center;
            }

            nav {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 5px;
                width: 100%;
            }

            .menu-item {
                padding: 8px 12px;
                font-size: 0.8rem;
                margin-bottom: 0;
            }

            .menu-item i {
                margin-right: 6px;
                width: 16px;
            }

            .sidebar-footer {
                display: none;
            }

            .main-content {
                margin-left: 0;
            }

            .top-bar {
                height: auto;
                padding: 15px 20px;
            }

            .top-bar h2 {
                font-size: 1.4rem;
            }

            .container {
                padding: 20px 15px;
            }

            .noticia-img, .noticia-video {
                max-height: 250px;
            }

            .noticia-body {
                padding: 12px 16px;
            }

            .noticia-header {
                flex-wrap: wrap;
            }

            .noticia-title {
                font-size: 1rem;
            }

            .noticia-subtitulo, .noticia-entradilla {
                font-size: 0.85rem;
            }

            .noticia-meta-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
                padding: 0 16px 12px;
            }

            .noticia-footer {
                flex-wrap: wrap;
                gap: 12px;
                padding: 10px 16px;
            }

            .noticia-action {
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h1 class="sidebar-title">Usuario</h1>
        <nav>
            <a href="{{ route('profile.edit') }}" class="menu-item"><i data-lucide="user"></i> Perfil</a>
            <a href="{{ route('retos.usuario') }}" class="menu-item"><i data-lucide="leaf"></i> Retos Ecológicos</a>
            <a href="{{ route('noticias.usuario') }}" class="menu-item active"><i data-lucide="newspaper"></i> Noticias Ambientales</a>
            <a href="{{ route('comunidad.usuario') }}" class="menu-item"><i data-lucide="flower-2"></i> Comunidad Ambiental</a>
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
            <h2>Noticias Ambientales</h2>
            <div class="profile-icon">
                @if(Auth::check() && Auth::user()->foto_path)
                    <img src="{{ asset(Auth::user()->foto_path) }}" alt="Perfil">
                @else
                    <i data-lucide="user" style="width: 28px; height: 28px;"></i>
                @endif
            </div>
        </div>

        <div class="container">
            <div class="feed">
                @foreach($noticias as $noticia)
                @php
                    $ext = $noticia->imagen ? pathinfo($noticia->imagen, PATHINFO_EXTENSION) : null;
                    $isImg = $ext && in_array(strtolower($ext), ['jpg','jpeg','png','gif','webp']);
                    $isVideo = $ext && in_array(strtolower($ext), ['mp4','mov','avi']);
                    $initials = strtoupper(substr($noticia->user->name ?? 'A', 0, 1));
                @endphp
                <div class="noticia-card">
                    <div class="noticia-body">
                        <div class="noticia-header">
                            <div class="noticia-avatar">{{ $initials }}</div>
                            <div>
                                <div class="noticia-author">{{ $noticia->user->name ?? 'Administrador' }}</div>
                                <div class="noticia-time">{{ $noticia->fecha_publicacion ? \Carbon\Carbon::parse($noticia->fecha_publicacion)->format('d/m/Y') : $noticia->created_at->format('d/m/Y') }}</div>
                            </div>
                        </div>
                        @if($noticia->antetitulo)
                            <span class="noticia-antetitulo">{{ $noticia->antetitulo }}</span>
                        @endif
                        <h3 class="noticia-title">{{ $noticia->titulo }}</h3>
                        @if($noticia->subtitulo)
                            <p class="noticia-subtitulo">{{ $noticia->subtitulo }}</p>
                        @endif
                        <p class="noticia-entradilla">{{ $noticia->entradilla }}</p>
                    </div>

                    @if($noticia->imagen)
                        @if($isImg)
                            <img src="{{ asset('storage/' . $noticia->imagen) }}" alt="{{ $noticia->titulo }}" class="noticia-img">
                        @elseif($isVideo)
                            <video src="{{ asset('storage/' . $noticia->imagen) }}" class="noticia-video" controls></video>
                        @else
                            <div class="noticia-pdf">
                                <i data-lucide="file-text" size="48"></i>
                                <span style="color: #444; font-weight: 600; font-size: 0.9rem;">Documento PDF</span>
                                <a href="{{ asset('storage/' . $noticia->imagen) }}" target="_blank" style="color: #6ab06a; font-size: 0.85rem; font-weight: 600; text-decoration: none;">Descargar archivo</a>
                            </div>
                        @endif
                    @endif

                    <div class="noticia-meta-row">
                        <span class="noticia-categoria">{{ $noticia->categoria }}</span>
                        <span class="noticia-date">{{ $noticia->pie_foto ?? 'Noticia ambiental' }}</span>
                    </div>

                    <div class="noticia-footer">
                        @php
                            $userLiked = Auth::check() && $noticia->isLikedByUser(Auth::id());
                        @endphp
                        <div class="noticia-action like-btn {{ $userLiked ? 'liked' : '' }}" data-id="{{ $noticia->id }}" onclick="toggleLike(this, {{ $noticia->id }})">
                            <i data-lucide="heart" size="18" class="heart-icon {{ $userLiked ? 'filled' : '' }}"></i>
                            <span class="like-text">{{ $userLiked ? 'Te gusta' : 'Me gusta' }}</span>
                            <span class="like-count">({{ $noticia->likes_count }})</span>
                        </div>
                        <div class="noticia-action" onclick="toggleComments({{ $noticia->id }})">
                            <i data-lucide="message-circle" size="18"></i>
                            <span>Comentar</span>
                            <span class="comment-count-{{ $noticia->id }}">({{ $noticia->comentarios->count() }})</span>
                        </div>
                    </div>

                    <div class="comments-section" id="comments-{{ $noticia->id }}" style="display: none;">
                        <div class="comments-list" id="comments-list-{{ $noticia->id }}">
                            @foreach($noticia->comentarios as $comentario)
                            <div class="comment-item">
                                <div class="comment-avatar">{{ strtoupper(substr($comentario->user->name ?? 'A', 0, 1)) }}</div>
                                <div class="comment-content">
                                    <div class="comment-author">{{ $comentario->user->name ?? 'Usuario' }}</div>
                                    <div class="comment-text">{{ $comentario->comentario }}</div>
                                    <div class="comment-time">{{ $comentario->created_at->format('d/m/Y H:i') }}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="comment-input-area">
                            <input type="text" class="comment-input" id="comment-input-{{ $noticia->id }}" placeholder="Escribe un comentario..." onkeydown="if(event.key === 'Enter') enviarComentario({{ $noticia->id }})">
                            <button class="comment-btn" onclick="enviarComentario({{ $noticia->id }})"><i data-lucide="send" size="16"></i></button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @if($noticias->isEmpty())
                <div style="text-align: center; padding: 100px; color: #1a3a2a; max-width: 500px;">
                    <i data-lucide="newspaper" size="60" style="margin-bottom: 20px; opacity: 0.5;"></i>
                    <h2 style="font-size: 1.5rem; font-weight: 800;">No hay noticias aún</h2>
                    <p style="margin-top: 10px; opacity: 0.7;">Pronto compartiremos noticias ambientales.</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        lucide.createIcons();

        async function toggleLike(btn, noticiaId) {
            const token = document.querySelector('meta[name="csrf-token"]')?.content || '';
            try {
                const res = await fetch(`/noticias/${noticiaId}/like`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    credentials: 'same-origin'
                });
                const data = await res.json();

                const heart = btn.querySelector('.heart-icon');
                const text = btn.querySelector('.like-text');
                const count = btn.querySelector('.like-count');

                if (data.liked) {
                    btn.classList.add('liked');
                    heart.classList.add('filled');
                    text.textContent = 'Te gusta';
                } else {
                    btn.classList.remove('liked');
                    heart.classList.remove('filled');
                    text.textContent = 'Me gusta';
                }
                count.textContent = '(' + data.likes_count + ')';
            } catch (err) {
                console.error('Error:', err);
            }
        }

        function toggleComments(noticiaId) {
            const section = document.getElementById('comments-' + noticiaId);
            section.style.display = section.style.display === 'none' ? 'block' : 'none';
        }

        async function enviarComentario(noticiaId) {
            const input = document.getElementById('comment-input-' + noticiaId);
            const texto = input.value.trim();
            if (!texto) return;

            const token = document.querySelector('meta[name="csrf-token"]')?.content || '';
            try {
                const res = await fetch(`/noticias/${noticiaId}/comentar`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify({ comentario: texto })
                });
                const data = await res.json();

                const list = document.getElementById('comments-list-' + noticiaId);
                const newComment = document.createElement('div');
                newComment.className = 'comment-item';
                newComment.innerHTML = `
                    <div class="comment-avatar">${data.user_name.charAt(0).toUpperCase()}</div>
                    <div class="comment-content">
                        <div class="comment-author">${data.user_name}</div>
                        <div class="comment-text">${data.comentario.comentario}</div>
                        <div class="comment-time">${data.created_at}</div>
                    </div>
                `;
                list.insertBefore(newComment, list.firstChild);
                input.value = '';

                const countEl = document.querySelector('.comment-count-' + noticiaId);
                if (countEl) countEl.textContent = '(' + data.total + ')';
            } catch (err) {
                console.error('Error:', err);
            }
        }
    </script>
</body>
</html>
