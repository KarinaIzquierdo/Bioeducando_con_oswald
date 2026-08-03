<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRAE - Bioeducando</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #f8fafc; min-height: 100vh; display: flex; }

        /* Sidebar Estandarizada */
        .sidebar { width: 260px; background-color: #6ab06a; display: flex; flex-direction: column; padding: 20px; position: fixed; height: 100vh; z-index: 1000; }
        .sidebar-title { font-size: 2.2rem; font-weight: 600; color: #000; margin-bottom: 40px; padding-left: 10px; }
        .menu-item { display: flex; align-items: center; padding: 12px 15px; color: white; text-decoration: none; margin-bottom: 10px; border-radius: 10px; transition: 0.3s; font-size: 1rem; }
        .menu-item i { margin-right: 12px; width: 20px; }
        .menu-item.active { background-color: #3d5a44; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .menu-item:hover:not(.active) { background-color: rgba(255,255,255,0.1); }
        .sidebar-footer { margin-top: auto; display: flex; flex-direction: column; align-items: center; gap: 15px; padding: 20px 0; width: 100%; }
        .sidebar-logo { width: 140px; filter: brightness(0); margin-bottom: 5px; }
        .btn-logout { width: 100%; padding: 12px; background-color: #000; color: white; border: none; border-radius: 10px; cursor: pointer; display: flex; align-items: center; justify-content: center; font-weight: 600; transition: 0.3s; text-transform: lowercase; }

        /* Main Content */
        .main-content { flex: 1; margin-left: 260px; display: flex; flex-direction: column; min-height: 100vh; }
        .top-bar { height: 100px; background-color: #744d2d; display: flex; align-items: center; justify-content: space-between; padding: 0 40px; width: 100%; position: sticky; top: 0; z-index: 900; }
        .top-bar h2 { color: white; font-size: 1.8rem; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; margin: 0; }
        .profile-icon { width: 50px; height: 50px; background-color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #744d2d; border: 2px solid white; overflow: hidden; flex-shrink: 0; }
        .profile-icon img { width: 100%; height: 100%; object-fit: cover; }

        .container { padding: 40px; flex: 1; width: 100%; max-width: 1200px; margin: 0 auto; }
        .hero-prae { background: linear-gradient(135deg, #1a3a2a 0%, #3d5a44 100%); padding: 60px; border-radius: 30px; color: white; margin-bottom: 40px; text-align: center; box-shadow: 0 15px 35px rgba(26, 58, 42, 0.2); }
        .hero-prae h1 { font-size: 2.5rem; font-weight: 800; margin-bottom: 15px; }
        .hero-prae p { font-size: 1.1rem; opacity: 0.9; max-width: 700px; margin: 0 auto; }

        .section-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 30px; }
        .card { background: white; padding: 35px; border-radius: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); margin-bottom: 30px; }
        .section-title { font-size: 1.4rem; color: #1a3a2a; font-weight: 800; margin-bottom: 25px; display: flex; align-items: center; gap: 12px; }
        .section-title i { color: #6ab06a; }

        .info-content { line-height: 1.8; color: #475569; font-size: 1.05rem; }
        .activity-item { padding: 20px; border-left: 5px solid #6ab06a; background: #f8fafc; border-radius: 0 20px 20px 0; margin-bottom: 20px; transition: 0.3s; }
        .activity-item:hover { background: #f1f5f9; transform: translateX(10px); }
        .activity-item.finalizada { border-left-color: #94a3b8; opacity: 0.8; }
        .activity-date { font-size: 0.85rem; font-weight: 800; color: #6ab06a; text-transform: uppercase; letter-spacing: 1px; }
        .activity-title { font-weight: 800; font-size: 1.2rem; margin: 8px 0; color: #1a3a2a; }

        .doc-item { display: flex; align-items: center; gap: 20px; padding: 20px; background: #f8fafc; border-radius: 20px; text-decoration: none; color: #1e293b; transition: 0.3s; margin-bottom: 15px; border: 1px solid #f1f5f9; }
        .doc-item:hover { background: #f1f5f9; border-color: #6ab06a; transform: scale(1.02); }
        .doc-icon { width: 50px; height: 50px; background: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #6ab06a; box-shadow: 0 4px 10px rgba(0,0,0,0.05); flex-shrink: 0; }
        .doc-info { display: flex; flex-direction: column; }
        .doc-info span { font-weight: 700; font-size: 1.05rem; color: #1a3a2a; }
        .doc-info small { color: #6ab06a; font-weight: 600; font-size: 0.85rem; }
        
        @media (max-width: 1024px) { .section-grid { grid-template-columns: 1fr; } .main-content { margin-left: 0; } .sidebar { display: none; } }
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
        <h1 class="sidebar-title">Usuario</h1>
        <nav>
            <a href="{{ route('profile.edit') }}" class="menu-item"><i data-lucide="user"></i> Perfil</a>
            <a href="{{ route('retos.usuario') }}" class="menu-item"><i data-lucide="leaf"></i> Retos Ecológicos</a>
            <a href="{{ route('noticias.usuario') }}" class="menu-item"><i data-lucide="newspaper"></i> Noticias Ambientales</a>
            <a href="{{ route('comunidad.usuario') }}" class="menu-item"><i data-lucide="flower-2"></i> Comunidad Ambiental</a>
            <a href="{{ route('contenido.creacion') }}" class="menu-item"><i data-lucide="clapperboard"></i> Eco-Estudio</a>
            <a href="{{ route('steam.proyectos') }}" class="menu-item"><i data-lucide="microscope"></i> Proyectos STEAM</a>
            <a href="{{ route('prae.proyectos') }}" class="menu-item active"><i data-lucide="book-open"></i> Proyectos PRAE</a>
            <a href="#" class="menu-item"><i data-lucide="settings"></i> Configuración</a>
        </nav>
        <div class="sidebar-footer">
            <img src="/imagenes/Logo.svg" alt="Logo" class="sidebar-logo">
            <form action="{{ route('logout') }}" method="POST" style="width: 100%;">@csrf<button type="submit" class="btn-logout">cerrar sesión</button></form>
        </div>
    </div>

    <div class="main-content">
        <div class="top-bar">
            <h2>Proyectos PRAE</h2>
            <div class="profile-icon">
                @if(Auth::check() && Auth::user()->foto_path)
                    <img src="{{ asset(Auth::user()->foto_path) }}" alt="Perfil">
                @else
                    <i data-lucide="user" style="width: 28px; height: 28px;"></i>
                @endif
            </div>
        </div>

        <div class="container">
            <div class="hero-prae">
                <h1>Proyecto Ambiental Escolar (PRAE)</h1>
                <p>Transformando nuestra institución a través de la conciencia y la acción ecológica.</p>
            </div>

            <div class="section-grid">
                <div class="main-info">
                    <div class="card">
                        <h2 class="section-title"><i data-lucide="info"></i> ¿Qué es el PRAE?</h2>
                        <div class="info-content"><p>{{ $info->descripcion ?? 'La información se está actualizando...' }}</p></div>
                    </div>
                    <div class="card">
                        <h2 class="section-title"><i data-lucide="target"></i> Nuestros Objetivos</h2>
                        <div class="info-content"><p>{{ $info->objetivos ?? 'Los objetivos estarán disponibles pronto.' }}</p></div>
                    </div>
                    <div class="card">
                        <h2 class="section-title"><i data-lucide="calendar"></i> Cronograma Ambiental</h2>
                        @foreach($actividadesProximas as $act)
                            <div class="activity-item">
                                <div class="activity-date">{{ \Carbon\Carbon::parse($act->fecha)->format('d M, Y') }}</div>
                                <div class="activity-title">{{ $act->titulo }}</div>
                                <div class="activity-desc">{{ $act->descripcion }}</div>
                            </div>
                        @endforeach
                        @foreach($actividadesRealizadas as $act)
                            <div class="activity-item finalizada">
                                <div class="activity-date">{{ \Carbon\Carbon::parse($act->fecha)->format('d M, Y') }}</div>
                                <div class="activity-title">{{ $act->titulo }}</div>
                                <div class="activity-desc">{{ $act->descripcion }}</div>
                            </div>
                        @endforeach
                        @if($actividadesProximas->isEmpty() && $actividadesRealizadas->isEmpty())
                            <p style="color: #64748b; font-style: italic;">No hay actividades registradas actualmente.</p>
                        @endif
                    </div>
                </div>

                <div class="sidebar-info">
                    <div class="card">
                        <h2 class="section-title"><i data-lucide="file-text"></i> Documentos</h2>
                        @forelse($documentos as $doc)
                            <a href="{{ asset('storage/' . $doc->archivo_path) }}" class="doc-item" target="_blank" download="{{ $doc->titulo }}.pdf">
                                <div class="doc-icon"><i data-lucide="download"></i></div>
                                <div class="doc-info"><span>{{ $doc->titulo }}</span><small>PDF para descargar</small></div>
                            </a>
                        @empty
                            <p style="color: #64748b; font-style: italic;">No hay documentos disponibles.</p>
                        @endforelse
                    </div>
                    <div class="card" style="background: #f0fdf4; border: 1px solid #dcfce7;">
                        <h3 style="color: #166534; font-size: 1.2rem; font-weight: 800; margin-bottom: 12px;">¿Tienes una duda?</h3>
                        <p style="font-size: 0.95rem; color: #166534; line-height: 1.6;">Contacta al comité ambiental para más información.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>lucide.createIcons();</script>
</body>
</html>
