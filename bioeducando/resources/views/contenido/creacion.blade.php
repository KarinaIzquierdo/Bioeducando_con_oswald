<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco-Estudio - Bioeducando</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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

        .container { padding: 40px; flex: 1; }

        .header-content {
            margin-bottom: 40px;
            text-align: center;
        }

        .header-content h1 {
            font-size: 2.5rem;
            color: #1a3a2a;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .header-content p {
            color: #64748b;
            font-size: 1.1rem;
        }

        .apps-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            max-width: 1000px;
            margin: 0 auto;
        }

        .app-card {
            background: white;
            border-radius: 30px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: 0.3s;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            border: 1px solid transparent;
        }

        .app-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            border-color: #6ab06a;
        }

        .app-icon {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            transition: 0.3s;
        }

        /* Estilos específicos para cada app */
        .capcut { background: #f8fafc; color: #000; }
        .canva { background: #f8fafc; color: #00c4cc; }
        .tiktok { background: #f8fafc; color: #fe2c55; }

        .app-card h3 {
            font-size: 1.5rem;
            color: #1a3a2a;
            font-weight: 800;
        }

        .app-card p {
            color: #64748b;
            font-size: 0.9rem;
            line-height: 1.4;
        }

        /* Estilos específicos para cada app */
        .capcut { background: #f8fafc; color: #000; }
        .canva { background: #f8fafc; color: #00c4cc; }
        .tiktok { background: #f8fafc; color: #fe2c55; }

        .btn-abrir {
            margin-top: 10px;
            padding: 10px 25px;
            background: #1a3a2a;
            color: white;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.9rem;
            transition: 0.3s;
        }

        .app-card:hover .btn-abrir {
            background: #6ab06a;
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
            <a href="{{ route('comunidad.publica') }}" class="menu-item">
                <i data-lucide="flower-2"></i> Comunidad Ambiental
            </a>
            <a href="{{ route('contenido.creacion') }}" class="menu-item active">
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
            <h2>Eco-Estudio</h2>
            <div class="profile-icon-container">
                @if(Auth::user()->avatar)
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Perfil" style="border-radius: 50%; width: 50px; height: 50px; object-fit: cover;">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=fff&color=744d2d&size=50" alt="Perfil" style="border-radius: 50%; width: 50px; height: 50px;">
                @endif
            </div>
        </div>

        <div class="container">
            <div class="header-content">
                <h1>¡Sé un Creador Eco! 🌱</h1>
                <p>Utiliza estas herramientas para crear y compartir tus avances ecológicos con el mundo.</p>
            </div>

            <div class="apps-grid">
                <!-- CapCut -->
                <a href="https://www.capcut.com/" target="_blank" class="app-card">
                    <div class="app-icon capcut">
                        <i class="bi bi-film"></i>
                    </div>
                    <h3>CapCut</h3>
                    <p>Edita tus videos de forma profesional con efectos y música ambiental.</p>
                    <div class="btn-abrir">Ir a editar</div>
                </a>

                <!-- Canva -->
                <a href="https://www.canva.com/" target="_blank" class="app-card">
                    <div class="app-icon canva">
                        <i class="bi bi-palette-fill"></i>
                    </div>
                    <h3>Canva</h3>
                    <p>Diseña posters, infografías y presentaciones sobre el medio ambiente.</p>
                    <div class="btn-abrir">Ir a diseñar</div>
                </a>

                <!-- TikTok -->
                <a href="https://www.tiktok.com/" target="_blank" class="app-card">
                    <div class="app-icon tiktok">
                        <i class="bi bi-tiktok"></i>
                    </div>
                    <h3>TikTok</h3>
                    <p>Comparte tus tips ecológicos en videos cortos y llega a miles de personas.</p>
                    <div class="btn-abrir">Ir a publicar</div>
                </a>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
