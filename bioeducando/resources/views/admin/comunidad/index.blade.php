<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comunidad Activa - EcoMuro</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { display: flex; height: 100vh; background-color: #f0f2f0; }

        /* Sidebar */
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
        .main-content { flex: 1; display: flex; flex-direction: column; overflow-y: auto; }
        .top-bar { height: 80px; background-color: #744d2d; display: flex; align-items: center; padding: 0 40px; color: white; font-weight: 600; font-size: 1.2rem; }

        .container { display: flex; gap: 30px; padding: 40px; max-width: 1200px; margin: 0 auto; width: 100%; }

        /* Muro de Publicaciones */
        .feed { flex: 2; display: flex; flex-direction: column; gap: 25px; }

        /* Caja de Crear Post */
        .create-post { background: white; border-radius: 20px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .create-post-header { display: flex; gap: 15px; margin-bottom: 15px; }
        .avatar-small { width: 45px; height: 45px; background: #6ab06a; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; }
        .post-input { width: 100%; border: none; background: #f4f7f4; padding: 15px; border-radius: 15px; outline: none; font-size: 1rem; resize: none; }
        .post-actions { display: flex; justify-content: space-between; align-items: center; margin-top: 15px; }
        .action-icon { display: flex; align-items: center; gap: 8px; color: #555; cursor: pointer; font-weight: 600; font-size: 0.9rem; }
        .btn-post { background: #6ab06a; color: white; border: none; padding: 8px 25px; border-radius: 50px; font-weight: 700; cursor: pointer; transition: 0.3s; }
        .btn-post:hover { background: #3d5a44; }

        /* Tarjeta de Publicación */
        .post-card { background: white; border-radius: 20px; padding: 0; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .post-header { padding: 20px; display: flex; align-items: center; gap: 15px; }
        .post-user-info h4 { color: #333; font-size: 1rem; }
        .post-user-info span { color: #888; font-size: 0.8rem; }
        .post-content { padding: 0 20px 20px 20px; font-size: 1rem; color: #444; line-height: 1.5; }
        .post-image { width: 100%; height: 350px; background-color: #ddd; background-size: cover; background-position: center; }
        .post-footer { padding: 20px; border-top: 1px solid #eee; display: flex; gap: 25px; }
        .footer-item { display: flex; align-items: center; gap: 8px; color: #666; font-size: 0.9rem; font-weight: 600; cursor: pointer; }
        .footer-item:hover { color: #6ab06a; }

        /* Barra Lateral Derecha */
        .sidebar-right { flex: 1; display: flex; flex-direction: column; gap: 25px; }
        .widget { background: white; border-radius: 20px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .widget-title { font-size: 1.1rem; font-weight: 700; color: #1a3a2a; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
        .trending-item { padding: 12px 0; border-bottom: 1px solid #f0f0f0; }
        .trending-item:last-child { border: none; }
        .trending-item h5 { font-size: 0.95rem; color: #333; margin-bottom: 5px; }
        .trending-item p { font-size: 0.85rem; color: #888; }
    </style>
</head>
<body>

    <!-- Sidebar Izquierda -->
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

    <!-- Contenido Principal -->
    <div class="main-content">
        <div class="top-bar" style="height: 100px; background-color: #744d2d; display: flex; align-items: center; justify-content: flex-end; padding: 0 40px; width: 100%; box-sizing: border-box;">
            <div style="width: 50px; height: 50px; background-color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #744d2d; border: 2px solid white; overflow: hidden; flex-shrink: 0;">
                @if(Auth::check() && Auth::user()->avatar)
                    <img src="{{ asset("storage/" . Auth::user()->avatar) }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    <i data-lucide="user" style="width: 28px; height: 28px;"></i>
                @endif
            </div>
        </div>
        </div>
                @endif
                <!-- Caja de Publicación -->
                <div class="create-post">
                    <form action="{{ route('admin.comunidad_activa.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="create-post-header">
                            <div class="avatar-small"><i data-lucide="user"></i></div>
                            <textarea class="post-input" name="contenido" placeholder="¿Qué acción ambiental realizaste hoy?" rows="2" required></textarea>
                        </div>
                        <div class="post-actions">
                            <div style="display: flex; gap: 20px;">
                                <!-- Input de archivo oculto -->
                                <input type="file" id="media-upload" name="media" style="display: none;" accept="image/*,video/*" onchange="document.getElementById('file-name-display').innerText = this.files[0].name">
                                <div class="action-icon" onclick="document.getElementById('media-upload').click()">
                                    <i data-lucide="image" style="color: #6ab06a"></i> Foto/Video
                                </div>
                            </div>
                            <button type="submit" class="btn-post">Publicar</button>
                        </div>
                        <div id="file-name-display" style="margin-top: 10px; font-size: 0.85rem; color: #6ab06a; font-weight: 600; padding-left: 60px;"></div>
                    </form>
                </div>

                <!-- Feed Dinámico -->
                @foreach($publicaciones as $post)
                <div class="post-card">
                    <div class="post-header" style="justify-content: space-between;">
                        <div style="display: flex; gap: 15px; align-items: center;">
                            <div class="avatar-small" style="background: {{ $post->user->id % 2 == 0 ? '#6ab06a' : '#744d2d' }};">
                                <i data-lucide="user"></i>
                            </div>
                            <div class="post-user-info">
                                <h4>{{ $post->user->name }}</h4>
                                <span>{{ $post->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        
                        @php
                            $isAdmin = Auth::user() && Auth::user()->role && Auth::user()->role->name == 'admin';
                        @endphp

                        @if(Auth::id() == $post->user_id || $isAdmin)
                        <form action="{{ route('admin.comunidad_activa.destroy', $post->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta publicación?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: #ff4d4d; cursor: pointer; padding: 5px;">
                                <i data-lucide="trash-2" size="18"></i>
                            </button>
                        </form>
                        @endif
                    </div>
                    <div class="post-content">
                        {{ $post->contenido }}
                    </div>
                    
                    @if($post->media_path)
                        @if($post->media_type == 'image')
                            <div class="post-image" style="background-image: url('{{ asset('storage/' . $post->media_path) }}')"></div>
                        @elseif($post->media_type == 'video')
                            <div style="padding: 0 20px 20px 20px;">
                                <video controls style="width: 100%; border-radius: 15px; max-height: 400px;">
                                    <source src="{{ asset('storage/' . $post->media_path) }}" type="video/mp4">
                                    Tu navegador no soporta videos.
                                </video>
                            </div>
                        @endif
                    @endif

                    <div class="post-footer">
                        <button class="footer-item like-btn" onclick="toggleLike(this)" style="background: none; border: none; font-family: inherit; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                            <i data-lucide="heart"></i> Me gusta
                        </button>
                        <button class="footer-item comment-btn" onclick="toggleComments({{ $post->id }})" style="background: none; border: none; font-family: inherit; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                            <i data-lucide="message-square"></i> Comentar
                        </button>
                    </div>

                    <!-- Sección de Comentarios -->
                    <div id="comments-{{ $post->id }}" class="comments-section" style="display: none; padding: 15px 25px; border-top: 1px solid #eee; background: #fcfdfc;">
                        <div class="comments-list" style="margin-bottom: 15px;">
                            @forelse($post->comentarios as $comentario)
                                <div class="comment-item" style="margin-bottom: 10px; display: flex; gap: 10px;">
                                    <div style="width: 30px; height: 30px; background: #eee; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.7rem;">
                                        <i data-lucide="user" size="14"></i>
                                    </div>
                                    <div style="background: #f1f5f9; padding: 8px 15px; border-radius: 15px; flex: 1;">
                                        <div style="font-weight: 700; font-size: 0.85rem; color: #1a3a2a;">{{ $comentario->user->name ?? 'Usuario' }}</div>
                                        <div style="font-size: 0.9rem; color: #334155;">{{ $comentario->contenido }}</div>
                                    </div>
                                </div>
                            @empty
                                <p style="font-size: 0.85rem; color: #888; font-style: italic;">No hay comentarios todavía. ¡Sé el primero!</p>
                            @endforelse
                        </div>
                        <form action="{{ route('comentarios.store') }}" method="POST" style="display: flex; gap: 10px;">
                            @csrf
                            <input type="hidden" name="publicacion_id" value="{{ $post->id }}">
                            <input type="text" name="contenido" placeholder="Escribe un comentario..." style="flex: 1; padding: 8px 15px; border-radius: 20px; border: 1px solid #ddd; outline: none; font-size: 0.9rem;" required>
                            <button type="submit" class="btn-post" style="padding: 5px 15px; font-size: 0.85rem;">Enviar</button>
                        </form>
                    </div>
                </div>
                @endforeach

                @if($publicaciones->isEmpty())
                <div class="post-card" style="padding: 40px; text-align: center; color: #888;">
                    <i data-lucide="message-circle" size="48" style="margin-bottom: 15px;"></i>
                    <p>No hay publicaciones aún. ¡Sé el primero en compartir algo!</p>
                </div>
                @endif
            </div>

            <!-- Barra Derecha -->
            <div class="sidebar-right">
                <div class="widget">
                    <h3 class="widget-title"><i data-lucide="trending-up"></i> Tendencias Eco</h3>
                    <div class="trending-item">
                        <h5>#Reforestación</h5>
                        <p>128 publicaciones hoy</p>
                    </div>
                    <div class="trending-item">
                        <h5>#ZeroWaste</h5>
                        <p>85 publicaciones hoy</p>
                    </div>
                    <div class="trending-item">
                        <h5>#BioeducandoOswald</h5>
                        <p>56 publicaciones hoy</p>
                    </div>
                </div>

                <div class="widget">
                    <h3 class="widget-title"><i data-lucide="lightbulb"></i> Eco-Consejo</h3>
                    <p style="font-size: 0.9rem; color: #555; line-height: 1.6;">
                        "Sabías que reciclar una tonelada de papel salva 17 árboles y ahorra 26,000 litros de agua."
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        function toggleLike(btn) {
            const svg = btn.querySelector('svg');
            btn.classList.toggle('liked');
            if (btn.classList.contains('liked')) {
                svg.style.fill = '#ff4d4d';
                svg.style.stroke = '#ff4d4d';
                btn.style.color = '#ff4d4d';
            } else {
                svg.style.fill = 'none';
                svg.style.stroke = 'currentColor';
                btn.style.color = 'inherit';
            }
        }

        function toggleComments(postId) {
            const section = document.getElementById('comments-' + postId);
            if (section.style.display === 'none') {
                section.style.display = 'block';
            } else {
                section.style.display = 'none';
            }
        }
    </script>
</body>
</html>
