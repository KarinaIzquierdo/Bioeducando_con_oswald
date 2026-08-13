<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias Ambientales - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { display: flex; min-height: 100vh; background-color: #f4f7f4; }

        .sidebar { width: 260px; background-color: #6ab06a; display: flex; flex-direction: column; padding: 20px; }
        .admin-title { font-size: 2rem; font-weight: 600; color: #000; margin-bottom: 40px; text-align: center; width: 100%; }
        .menu-item { display: flex; align-items: center; padding: 12px 15px; color: white; text-decoration: none; margin-bottom: 10px; border-radius: 10px; transition: 0.3s; }
        .menu-item i { margin-right: 12px; }
        .menu-item.active { background-color: #3d5a44; }
        .sidebar-footer { margin-top: auto; display: flex; flex-direction: column; align-items: center; gap: 15px; padding: 20px 0; width: 100%; }
        .sidebar-logo { width: 140px; filter: brightness(0); margin-bottom: 5px; }
        .btn-logout { width: 100%; padding: 12px; background-color: #3d5a44; color: white; border: none; border-radius: 10px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px; font-weight: 600; transition: 0.3s; font-size: 0.95rem; }
        .btn-logout:hover { background-color: #2d4433; }

        .main-content { flex: 1; display: flex; flex-direction: column; overflow-y: auto; }
        .top-bar { height: 100px; background-color: #744d2d; display: flex; align-items: center; padding: 0 40px; color: white; justify-content: space-between; }
        .top-bar h2 { color: white; font-size: 1.8rem; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; margin: 0; display: flex; align-items: center; gap: 12px; }

        .content-padding { padding: 40px; }
        .header-section { display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; }
        .header-section h2 { font-size: 2rem; color: #1a3a2a; }
        .btn-add { background: #6ab06a; color: white; padding: 12px 25px; border-radius: 12px; text-decoration: none; font-weight: 700; display: flex; align-items: center; gap: 8px; transition: 0.3s; }
        .btn-add:hover { background: #3d5a44; }

        .noticias-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 25px; }
        .noticia-card { background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.05); transition: 0.3s; }
        .noticia-card:hover { transform: translateY(-5px); box-shadow: 0 15px 35px rgba(0,0,0,0.1); }
        .noticia-img { width: 100%; height: 180px; object-fit: cover; background: #e8f5e9; display: flex; align-items: center; justify-content: center; color: #6ab06a; }
        .noticia-body { padding: 25px; }
        .noticia-title { font-size: 1.2rem; font-weight: 700; color: #1a3a2a; margin-bottom: 10px; }
        .noticia-desc { color: #666; font-size: 0.9rem; line-height: 1.5; margin-bottom: 15px; }
        .noticia-meta { display: flex; justify-content: space-between; align-items: center; font-size: 0.8rem; color: #888; margin-bottom: 15px; }
        .estado-badge { padding: 4px 10px; border-radius: 8px; font-size: 0.75rem; font-weight: 700; }
        .estado-activa { background: #dcfce7; color: #166534; }
        .estado-inactiva { background: #fee2e2; color: #991b1b; }
        .noticia-actions { display: flex; gap: 10px; }
        .btn-action { flex: 1; padding: 10px; border: none; border-radius: 10px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 6px; transition: 0.3s; text-decoration: none; font-size: 0.85rem; }
        .btn-edit { background: #f0f0f0; color: #444; }
        .btn-edit:hover { background: #3d5a44; color: white; }
        .btn-delete { background: #fee2e2; color: #b91c1c; }
        .btn-delete:hover { background: #b91c1c; color: white; }
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

            .sidebar-title,
            .admin-title {
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
                width: 100%;
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

            table {
                display: block;
                width: 100%;
                overflow-x: auto;
                white-space: nowrap;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h1 class="admin-title">Admin</h1>
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="menu-item"><i data-lucide="layout-dashboard"></i> Dashboard</a>
            <a href="{{ route('usuarios.index') }}" class="menu-item"><i data-lucide="users"></i> Usuarios</a>
            <a href="{{ route('admin.retos') }}" class="menu-item"><i data-lucide="leaf"></i> Retos Ecológicos</a>
            <a href="{{ route('admin.comunidad_activa') }}" class="menu-item"><i data-lucide="flower-2"></i> Comunidad Activa</a>
            <a href="{{ route('admin.steam.index') }}" class="menu-item"><i data-lucide="microscope"></i> Gestionar STEAM</a>
            <a href="{{ route('admin.prae.index') }}" class="menu-item"><i data-lucide="book-open"></i> Gestionar PRAE</a>
            <a href="{{ route('admin.noticias') }}" class="menu-item active"><i data-lucide="newspaper"></i> Noticias Ambientales</a>
            <a href="{{ route('admin.profile.edit') }}" class="menu-item"><i data-lucide="user"></i> Mi Perfil</a>
            <a href="#" class="menu-item"><i data-lucide="settings"></i> Configuración</a>
        </nav>
        <div class="sidebar-footer">
            <img src="/imagenes/Logo.svg" alt="Logo" class="sidebar-logo">
            <form action="{{ route('logout') }}" method="POST" style="width: 100%;">@csrf<button type="submit" class="btn-logout"><i data-lucide="log-out"></i> Cerrar Sesión</button></form>
        </div>
    </div>

    <div class="main-content">
        <div class="top-bar" style="width: 100%; box-sizing: border-box;">
            <h2><i data-lucide="newspaper"></i> Noticias Ambientales</h2>
            <div style="width: 50px; height: 50px; background-color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #744d2d; border: 2px solid white; overflow: hidden; flex-shrink: 0;">
                @if(Auth::check() && Auth::user()->foto_path)
                    <img src="{{ asset(Auth::user()->foto_path) }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    <i data-lucide="user" style="width: 28px; height: 28px;"></i>
                @endif
            </div>
        </div>

        <div class="content-padding">
            @if(session('success'))
                <div style="background: #dcfce7; color: #15803d; padding: 15px 25px; border-radius: 12px; border: 1px solid #bbf7d0; font-weight: 600; margin-bottom: 25px; display: flex; align-items: center; gap: 10px;">
                    <i data-lucide="check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <div class="header-section">
                <h2>Todas las Noticias</h2>
                <a href="{{ route('admin.noticias.create') }}" class="btn-add"><i data-lucide="plus"></i> Nueva Noticia</a>
            </div>

            <div class="noticias-grid">
                @foreach($noticias as $noticia)
                @php
                    $ext = $noticia->imagen ? pathinfo($noticia->imagen, PATHINFO_EXTENSION) : null;
                    $isImg = $ext && in_array(strtolower($ext), ['jpg','jpeg','png','gif','webp']);
                    $isVideo = $ext && in_array(strtolower($ext), ['mp4','mov','avi']);
                @endphp
                <div class="noticia-card">
                    @if($noticia->imagen)
                        @if($isImg)
                            <img src="{{ asset('storage/' . $noticia->imagen) }}" alt="{{ $noticia->titulo }}" class="noticia-img">
                        @elseif($isVideo)
                            <video src="{{ asset('storage/' . $noticia->imagen) }}" class="noticia-img" controls style="object-fit: cover;"></video>
                        @else
                            <div class="noticia-img" style="background: #e8f5e9; display: flex; align-items: center; justify-content: center; color: #6ab06a;"><i data-lucide="file-text" size="48"></i></div>
                        @endif
                    @else
                        <div class="noticia-img"><i data-lucide="image" size="48"></i></div>
                    @endif
                    <div class="noticia-body">
                        <h3 class="noticia-title">{{ $noticia->titulo }}</h3>
                        <p class="noticia-desc">{{ Str::limit($noticia->entradilla, 120) }}</p>
                        <div class="noticia-meta">
                            <span>{{ $noticia->fecha_publicacion ? \Carbon\Carbon::parse($noticia->fecha_publicacion)->format('d/m/Y') : $noticia->created_at->format('d/m/Y') }}</span>
                            <span style="background:#e8f5e9;color:#166534;padding:3px 8px;border-radius:6px;font-size:0.75rem;font-weight:700;">{{ $noticia->categoria }}</span>
                            <span class="estado-badge estado-{{ $noticia->estado }}">{{ ucfirst($noticia->estado) }}</span>
                        </div>
                        <div class="noticia-actions">
                            <a href="{{ route('admin.noticias.edit', $noticia->id) }}" class="btn-action btn-edit"><i data-lucide="edit-3"></i> Editar</a>
                            <form action="{{ route('admin.noticias.destroy', $noticia->id) }}" method="POST" style="flex: 1;" onsubmit="return confirm('¿Eliminar esta noticia?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" style="width: 100%;"><i data-lucide="trash-2"></i> Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @if($noticias->isEmpty())
                <div style="text-align: center; padding: 80px; color: #1a3a2a;">
                    <i data-lucide="newspaper" size="60" style="margin-bottom: 20px; opacity: 0.5;"></i>
                    <h2 style="font-size: 1.5rem; font-weight: 800;">No hay noticias aún</h2>
                    <p style="margin-top: 10px; opacity: 0.7;">Crea la primera noticia ambiental.</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
