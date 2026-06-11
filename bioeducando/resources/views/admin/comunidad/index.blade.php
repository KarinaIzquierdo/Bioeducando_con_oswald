<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comunidad Ambiental - EcoMuro</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { display: flex; height: 100vh; background-color: #f0f2f0; }

        /* Sidebar */
        .sidebar { width: 260px; background-color: #6ab06a; display: flex; flex-direction: column; padding: 20px; }
        .admin-title { font-size: 2rem; font-weight: 400; color: #000; margin-bottom: 40px; }
        .menu-item { display: flex; align-items: center; padding: 12px 15px; color: white; text-decoration: none; margin-bottom: 10px; border-radius: 10px; transition: 0.3s; }
        .menu-item i { margin-right: 12px; }
        .menu-item.active { background-color: #3d5a44; }
        .sidebar-logo { width: 140px; filter: brightness(0); margin-top: auto; align-self: center; }

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
        <h1 class="admin-title">Admin panel</h1>
        <nav>
            <a href="{{ route('usuarios.index') }}" class="menu-item {{ Request::is('admin/usuarios*') ? 'active' : '' }}">
                <i data-lucide="users"></i> Usuarios
            </a>
            <a href="{{ route('admin.retos') }}" class="menu-item {{ Request::is('admin/retos*') ? 'active' : '' }}">
                <i data-lucide="leaf"></i> Retos ecológicos
            </a>
            <a href="{{ route('admin.comunidad') }}" class="menu-item {{ Request::is('admin/comunidad*') ? 'active' : '' }}">
                <i data-lucide="flower-2"></i> Comunidad ambiental
            </a>
            <a href="#" class="menu-item">
                <i data-lucide="settings"></i> Configuración
            </a>
        </nav>
        <div class="sidebar-footer" style="margin-top: auto; text-align: center; padding: 20px;">
            <img src="/imagenes/Logo.svg" alt="Logo" class="sidebar-logo">
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="main-content">
        <div class="top-bar">Eco-Muro: Comunidad Bioeducando</div>

        <div class="container">
            <!-- Feed Central -->
            <div class="feed">
                <!-- Caja de Publicación -->
                <div class="create-post">
                    <div class="create-post-header">
                        <div class="avatar-small"><i data-lucide="user"></i></div>
                        <textarea class="post-input" placeholder="¿Qué acción ambiental realizaste hoy?" rows="2"></textarea>
                    </div>
                    <div class="post-actions">
                        <div class="action-icon"><i data-lucide="image" style="color: #6ab06a"></i> Foto/Video</div>
                        <div class="action-icon"><i data-lucide="map-pin" style="color: #744d2d"></i> Ubicación</div>
                        <button class="btn-post">Publicar</button>
                    </div>
                </div>

                <!-- Ejemplo Post 1 -->
                <div class="post-card">
                    <div class="post-header">
                        <div class="avatar-small" style="background: #744d2d;"><i data-lucide="user"></i></div>
                        <div class="post-user-info">
                            <h4>María Gómez</h4>
                            <span>Hace 2 horas • Escuela Ambiental</span>
                        </div>
                    </div>
                    <div class="post-content">
                        🌳 Hoy sembramos 10 árboles nativos en nuestra escuela. 
                        ¡Fue una experiencia increíble ver a todos participar por el planeta! #Reforestación #Bioeducando
                    </div>
                    <!-- Simulamos una foto con un fondo -->
                    <div class="post-image" style="background-image: url('https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')"></div>
                    <div class="post-footer">
                        <div class="footer-item" style="color: #e63946;"><i data-lucide="heart"></i> 25 Me gusta</div>
                        <div class="footer-item"><i data-lucide="message-square"></i> 8 Comentarios</div>
                        <div class="footer-item"><i data-lucide="share-2"></i> Compartir</div>
                    </div>
                </div>

                <!-- Ejemplo Post 2 -->
                <div class="post-card">
                    <div class="post-header">
                        <div class="avatar-small"><i data-lucide="user"></i></div>
                        <div class="post-user-info">
                            <h4>Carlos Ruiz</h4>
                            <span>Hace 5 horas</span>
                        </div>
                    </div>
                    <div class="post-content">
                        ♻️ ¡Misión cumplida! Completé el reto de "Clasificador experto". He separado mis residuos durante toda la semana y es más fácil de lo que parece. 
                    </div>
                    <div class="post-footer">
                        <div class="footer-item"><i data-lucide="heart"></i> 12 Me gusta</div>
                        <div class="footer-item"><i data-lucide="message-square"></i> 3 Comentarios</div>
                    </div>
                </div>
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
    </script>
</body>
</html>
