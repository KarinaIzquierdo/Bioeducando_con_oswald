<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Comunidad Ambiental - Bioeducando</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: "Inter", sans-serif; }
        body { background-color: #f0f2f0; min-min-height: 100vh; }

        /* Header público */
        .community-header {
            background: linear-gradient(135deg, #1a3a2a 0%, #2d5a3d 100%);
            padding: 25px 40px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }
        .community-header h1 { font-size: 1.6rem; font-weight: 700; display: flex; align-items: center; gap: 12px; }
        .header-actions { display: flex; align-items: center; gap: 15px; }
        .header-btn {
            background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3); color: white;
            padding: 8px 18px; border-radius: 20px; text-decoration: none;
            font-size: 0.85rem; font-weight: 600; transition: 0.3s;
            display: flex; align-items: center; gap: 6px;
        }
        .header-btn:hover { background: rgba(255,255,255,0.25); }
        .header-avatar {
            width: 42px; height: 42px; background: white; border-radius: 50%;
            display: flex; align-items: center; justify-content: center; color: #1a3a2a;
            overflow: hidden; border: 2px solid rgba(255,255,255,0.4); cursor: pointer;
        }
        .header-avatar img { width: 100%; height: 100%; object-fit: cover; }

        .container { padding: 30px 40px; max-width: 800px; margin: 0 auto; }
        .alert { padding: 15px; border-radius: 12px; margin-bottom: 20px; font-weight: 600; }
        .alert-success { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
        .create-post-card { background: white; border-radius: 30px; padding: 25px; margin-bottom: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .create-post-header { display: flex; gap: 15px; margin-bottom: 15px; }
        .avatar-circle { width: 45px; height: 45px; background: #6ab06a; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; flex-shrink: 0; overflow: hidden; }
        .avatar-circle img { width: 100%; height: 100%; object-fit: cover; }
        .create-post-header textarea { flex: 1; border: none; outline: none; font-size: 1.1rem; resize: none; min-height: 80px; padding-top: 10px; }
        .create-post-footer { display: flex; justify-content: space-between; align-items: center; padding-top: 15px; border-top: 1px solid #f1f5f9; }
        .upload-btn { display: flex; align-items: center; gap: 8px; color: #64748b; font-weight: 600; cursor: pointer; padding: 8px 15px; border-radius: 12px; transition: 0.3s; }
        .upload-btn:hover { background: #f8fafc; color: #6ab06a; }
        .btn-submit { background: #6ab06a; color: white; border: none; padding: 10px 25px; border-radius: 12px; font-weight: 700; cursor: pointer; transition: 0.3s; }
        .post-card { background: white; border-radius: 30px; margin-bottom: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); overflow: hidden; }
        .post-header { padding: 25px 30px; display: flex; align-items: center; gap: 15px; }
        .user-meta h4 { color: #1a3a2a; font-weight: 800; font-size: 1.1rem; }
        .user-meta span { color: #94a3b8; font-size: 0.85rem; }
        .post-body { padding: 0 30px 25px; font-size: 1.1rem; color: #334155; line-height: 1.6; }
        .media-box { margin: 0 25px 25px; border-radius: 20px; overflow: hidden; box-shadow: 0 8px 25px rgba(0,0,0,0.1); }
        .media-box img, .media-box video { width: 100%; display: block; }
        .post-actions { padding: 15px 30px; background: #fafafa; border-top: 1px solid #f0f0f0; display: flex; gap: 15px; }
        .action-btn { background: #1a3a2a; color: white; border: none; padding: 10px 20px; border-radius: 12px; font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: 8px; transition: 0.3s; }
        .action-btn:hover { background: #6ab06a; transform: translateY(-2px); }
        .action-btn.liked { background: #ef4444; }
        .action-btn.liked i { fill: white; }
        .likes-count { margin-left: 6px; font-weight: 700; }
        .comments-area { padding: 25px 30px; background: #fcfdfc; border-top: 1px solid #eee; }
        .comment-item { display: flex; gap: 12px; margin-bottom: 15px; }
        .comment-bubble { background: white; border: 1px solid #e2e8f0; padding: 12px 18px; border-radius: 20px; flex: 1; }
        .comment-user { font-weight: 800; color: #1a3a2a; font-size: 0.9rem; margin-bottom: 3px; }
        .comment-text { color: #475569; font-size: 0.95rem; line-height: 1.4; }
        .comment-form { display: flex; gap: 10px; margin-top: 20px; }
        .comment-input { flex: 1; padding: 12px 20px; border-radius: 15px; border: 1px solid #e2e8f0; outline: none; font-size: 1rem; transition: 0.3s; }
        .send-btn { background: #6ab06a; color: white; border: none; padding: 0 20px; border-radius: 15px; font-weight: 700; cursor: pointer; }
        @media (max-width: 768px) {
            .community-header {
                padding: 15px 20px;
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .community-header h1 {
                font-size: 1.2rem;
            }

            .header-actions {
                flex-wrap: wrap;
                gap: 10px;
                width: 100%;
            }

            .header-btn {
                padding: 6px 12px;
                font-size: 0.75rem;
            }

            .container {
                padding: 20px 15px;
            }

            .create-post-card {
                padding: 20px;
                border-radius: 20px;
            }

            .create-post-header textarea {
                font-size: 1rem;
            }

            .create-post-footer {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .btn-submit {
                width: 100%;
                text-align: center;
            }

            .post-card {
                border-radius: 20px;
            }

            .post-header {
                padding: 20px;
            }

            .post-body {
                padding: 0 20px 20px;
                font-size: 1rem;
            }

            .media-box {
                margin: 0 20px 20px;
            }

            .post-actions {
                padding: 15px 20px;
                flex-wrap: wrap;
            }

            .comments-area {
                padding: 20px;
            }

            .comment-form {
                flex-direction: column;
            }

            .send-btn {
                width: 100%;
                padding: 12px;
            }

            .comment-bubble {
                padding: 10px 14px;
            }
        }
    </style>
</head>
<body>
    <div class="community-header">
        <h1><i data-lucide="flower-2"></i> Comunidad Ambiental</h1>
        <div class="header-actions">
            @auth
            <a href="{{ route('comunidad.usuario') }}" class="header-btn"><i data-lucide="layout-dashboard" size="16"></i> Mi Panel</a>
            @else
            <a href="{{ route('login') }}" class="header-btn"><i data-lucide="log-in" size="16"></i> Ingresar</a>
            @endauth
        </div>
    </div>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @auth
        <div class="create-post-card">
            <form action="{{ route('comunidad.publicar_user') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="create-post-header">
                    <div class="avatar-circle">
                        @if(Auth::user()->foto_path)<img src="{{ asset(Auth::user()->foto_path) }}" alt="Avatar">
                        @else{{ substr(Auth::user()->name, 0, 1) }}@endif
                    </div>
                    <textarea name="contenido" placeholder="¿Qué quieres compartir hoy, {{ explode(' ', Auth::user()->name)[0] }}?" required></textarea>
                </div>
                <div class="create-post-footer">
                    <label class="upload-btn">
                        <i data-lucide="image"></i> Foto / Video
                        <input type="file" name="media" style="display: none;" accept="image/*,video/*" onchange="updateFileName(this)">
                    </label>
                    <span id="file-name" style="font-size: 0.85rem; color: #64748b; margin-left: 10px;"></span>
                    <button type="submit" class="btn-submit">Publicar</button>
                </div>
            </form>
        </div>
        @endauth
        @foreach($publicaciones as $post)
        <div class="post-card">
            <div class="post-header">
                <div class="avatar-circle" style="background: {{ ($post->user && $post->user->id % 2 == 0) ? '#6ab06a' : '#744d2d' }};">
                    @if($post->user && $post->user->foto_path)<img src="{{ asset($post->user->foto_path) }}" alt="Avatar">
                    @else{{ substr($post->user->name ?? 'U', 0, 1) }}@endif
                </div>
                <div class="user-meta" style="flex: 1;">
                    <h4>{{ $post->user->name ?? 'Usuario' }}</h4>
                    <span>{{ $post->created_at->diffForHumans() }}</span>
                </div>
                @if(Auth::check() && (Auth::id() == $post->user_id || (Auth::user()->role && Auth::user()->role->name == 'admin')))
                <div class="post-options">
                    <form action="{{ route('comunidad.destroy', $post->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro?')">
                        @csrf @method('DELETE')
                        <button type="submit" style="background: none; border: none; color: #94a3b8; cursor: pointer; transition: 0.3s;" onmouseover="this.style.color='#ff4d4d'" onmouseout="this.style.color='#94a3b8'"><i data-lucide="trash-2" size="20"></i></button>
                    </form>
                </div>
                @endif
            </div>
            <div class="post-body">{{ $post->contenido }}</div>
            @if($post->media_path)
                <div class="media-box">
                    @if($post->media_type == 'image')<img src="{{ asset('storage/' . $post->media_path) }}" alt="Post">
                    @elseif($post->media_type == 'video')<video controls><source src="{{ asset('storage/' . $post->media_path) }}" type="video/mp4"></video>
                    @elseif($post->media_type == 'pdf')<a href="{{ asset('storage/' . $post->media_path) }}" target="_blank" style="display: flex; align-items: center; gap: 12px; background: #fee2e2; color: #b91c1c; padding: 15px 20px; border-radius: 12px; text-decoration: none; font-weight: 700;"><i data-lucide="file-text"></i> Ver / Descargar PDF</a>@endif
                </div>
            @endif
            <div class="post-actions">
                <button class="action-btn like-btn" data-post-id="{{ $post->id }}">
                    <i data-lucide="heart" class="heart-icon"></i>
                    <span class="likes-count">{{ $post->likes_count }}</span>
                </button>
                <button class="action-btn" onclick="toggleComments({{ $post->id }})"><i data-lucide="message-square"></i> Comentar</button>
            </div>
            <div id="comments-{{ $post->id }}" class="comments-area" style="display: none;">
                <div class="comments-list">
                    @forelse($post->comentarios as $comentario)
                        <div class="comment-item">
                            <div class="avatar-circle" style="width: 35px; height: 35px; font-size: 0.8rem;">{{ substr($comentario->user->name ?? 'U', 0, 1) }}</div>
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
                    <button type="submit" class="send-btn"><i data-lucide="send" size="20"></i></button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    <script>
        lucide.createIcons();
        function updateFileName(input) { document.getElementById('file-name').textContent = input.files[0] ? input.files[0].name : ''; }

        // Cargar likes guardados en localStorage
        const likedPosts = JSON.parse(localStorage.getItem('likedPosts') || '[]');

        document.querySelectorAll('.like-btn').forEach(btn => {
            const postId = parseInt(btn.dataset.postId);
            if (likedPosts.includes(postId)) {
                btn.classList.add('liked');
            }
            btn.addEventListener('click', async function() {
                const isLiked = this.classList.contains('liked');
                const action = isLiked ? 'unlike' : 'like';
                const postId = this.dataset.postId;
                const countSpan = this.querySelector('.likes-count');

                try {
                    const response = await fetch(`/comunidad/${postId}/like`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ action: action })
                    });
                    const data = await response.json();
                    if (data.success) {
                        countSpan.textContent = data.likes_count;
                        this.classList.toggle('liked');

                        // Guardar/quitar de localStorage
                        let liked = JSON.parse(localStorage.getItem('likedPosts') || '[]');
                        if (action === 'like') {
                            liked.push(parseInt(postId));
                        } else {
                            liked = liked.filter(id => id !== parseInt(postId));
                        }
                        localStorage.setItem('likedPosts', JSON.stringify(liked));
                    }
                } catch (e) {
                    console.error('Error al dar like:', e);
                }
            });
        });

        function toggleComments(postId) {
            const area = document.getElementById('comments-' + postId);
            area.style.display = area.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</body>
</html>