<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Noticias Ambientales - Bioeducando</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #f0fdf4; min-height: 100vh; }

        .noticias-header {
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
        .noticias-header h1 { font-size: 1.6rem; font-weight: 700; display: flex; align-items: center; gap: 12px; }
        .header-actions { display: flex; align-items: center; gap: 15px; }
        .header-btn {
            background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3); color: white;
            padding: 8px 18px; border-radius: 20px; text-decoration: none;
            font-size: 0.85rem; font-weight: 600; transition: 0.3s;
            display: flex; align-items: center; gap: 6px;
        }
        .header-btn:hover { background: rgba(255,255,255,0.25); }

        .container { padding: 40px 20px; max-width: 720px; margin: 0 auto; }
        .feed { display: flex; flex-direction: column; gap: 20px; }
        .noticia-card { background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1); transition: 0.2s; user-select: none; -webkit-user-select: none; }
        .noticia-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.15); }
        .noticia-card ::selection { background: transparent; }
        .noticia-img { width: 100%; max-height: 400px; object-fit: cover; display: block; user-select: none; -webkit-user-select: none; }
        .noticia-video { width: 100%; max-height: 400px; display: block; background: #000; user-select: none; -webkit-user-select: none; }
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
        .noticia-meta-row { padding: 0 20px 12px; display: flex; justify-content: space-between; align-items: center; }
        .noticia-categoria { background: #e8f5e9; color: #166534; padding: 3px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; }
        .noticia-date { font-size: 0.75rem; color: #94a3b8; }
        .noticia-footer { padding: 10px 20px; border-top: 1px solid #f0f0f0; display: flex; gap: 20px; }
        .noticia-action { color: #64748b; font-size: 0.85rem; font-weight: 600; display: flex; align-items: center; gap: 6px; cursor: pointer; transition: 0.2s; padding: 4px 0; text-decoration: none; }
        .noticia-action:hover { color: #6ab06a; }
        .noticia-action.liked { color: #e11d48; }
        .noticia-action.liked:hover { color: #be123c; }
        .heart-icon { fill: none !important; color: currentColor !important; }
        .heart-icon.filled { fill: #e11d48 !important; color: #e11d48 !important; }
    </style>
</head>
<body>
    <div class="noticias-header">
        <h1><i data-lucide="newspaper"></i> Noticias Ambientales</h1>
        <div class="header-actions">
            @auth
            <a href="{{ route('dashboard') }}" class="header-btn"><i data-lucide="layout-dashboard" size="16"></i> Mi Panel</a>
            @else
            <a href="{{ route('login') }}" class="header-btn"><i data-lucide="log-in" size="16"></i> Ingresar</a>
            @endauth
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

                <div class="noticia-footer">
                    <div class="noticia-action {{ in_array($noticia->id, $likedNoticias) ? 'liked' : '' }}" onclick="toggleLike(this, {{ $noticia->id }})" style="cursor: pointer;">
                        <i data-lucide="heart" size="18" class="heart-icon {{ in_array($noticia->id, $likedNoticias) ? 'filled' : '' }}"></i>
                        <span class="like-text">{{ in_array($noticia->id, $likedNoticias) ? 'Te gusta' : 'Me gusta' }}</span>
                        <span class="like-count">({{ $noticia->likes_count }})</span>
                    </div>
                </div>

                <div class="noticia-meta-row">
                    <span class="noticia-categoria">{{ $noticia->categoria }}</span>
                    <span class="noticia-date">{{ $noticia->pie_foto ?? 'Noticia ambiental' }}</span>
                </div>
            </div>
            @endforeach
        </div>

        @if($noticias->isEmpty())
            <div style="text-align: center; padding: 100px; color: #1a3a2a;">
                <i data-lucide="newspaper" size="60" style="margin-bottom: 20px; opacity: 0.5;"></i>
                <h2 style="font-size: 1.5rem; font-weight: 800;">No hay noticias aún</h2>
                <p style="margin-top: 10px; opacity: 0.7;">Pronto compartiremos noticias ambientales.</p>
            </div>
        @endif
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
                    if (text) text.textContent = 'Te gusta';
                } else {
                    btn.classList.remove('liked');
                    heart.classList.remove('filled');
                    if (text) text.textContent = 'Me gusta';
                }
                if (count) count.textContent = '(' + data.likes_count + ')';
            } catch (err) {
                console.error('Error:', err);
            }
        }
    </script>
</body>
</html>
