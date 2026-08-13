<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Noticia - Admin</title>
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

        .content-padding { padding: 40px; max-width: 900px; margin: 0 auto; width: 100%; }
        .form-card { background: white; border-radius: 25px; padding: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .form-group { margin-bottom: 25px; }
        .form-group label { display: block; margin-bottom: 8px; color: #444; font-weight: 600; font-size: 0.9rem; }
        .form-group label .opt { color: #94a3b8; font-weight: 400; font-size: 0.8rem; }
        .form-control { width: 100%; padding: 15px 20px; border-radius: 15px; border: 2px solid #e2e8f0; outline: none; font-size: 1rem; transition: 0.3s; }
        .form-control:focus { border-color: #6ab06a; }
        textarea.form-control { resize: vertical; min-height: 100px; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .btn-submit { width: 100%; padding: 15px; background: #6ab06a; color: white; border: none; border-radius: 15px; font-weight: 700; font-size: 1rem; cursor: pointer; transition: 0.3s; }
        .btn-submit:hover { background: #3d5a44; }
        .btn-back { color: #666; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 6px; margin-bottom: 20px; }
        .section-title { font-size: 1.1rem; color: #1a3a2a; font-weight: 700; margin: 30px 0 15px; padding-bottom: 10px; border-bottom: 2px solid #e2e8f0; }
        .file-upload-area { border: 2px dashed #e2e8f0; border-radius: 15px; padding: 40px; text-align: center; cursor: pointer; transition: 0.3s; background: #fafafa; }
        .file-upload-area:hover { border-color: #6ab06a; background: #f0fdf4; }
        .file-upload-area:active { transform: scale(0.98); }
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
            <h2><i data-lucide="newspaper"></i> Nueva Noticia</h2>
            <div style="width: 50px; height: 50px; background-color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #744d2d; border: 2px solid white; overflow: hidden; flex-shrink: 0;">
                @if(Auth::check() && Auth::user()->foto_path)
                    <img src="{{ asset(Auth::user()->foto_path) }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    <i data-lucide="user" style="width: 28px; height: 28px;"></i>
                @endif
            </div>
        </div>

        <div class="content-padding">
            <a href="{{ route('admin.noticias') }}" class="btn-back"><i data-lucide="arrow-left"></i> Volver</a>
            <div class="form-card">
                <form action="{{ route('admin.noticias.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="section-title">Campos de Texto para los Titulares</div>

                    <div class="form-group">
                        <label>Antetitulo <span class="opt">(opcional)</span></label>
                        <input type="text" name="antetitulo" class="form-control" value="{{ old('antetitulo') }}" placeholder="Contextualiza el tema">
                    </div>
                    <div class="form-group">
                        <label>Titulo <span style="color:#b91c1c">*</span></label>
                        <input type="text" name="titulo" class="form-control" value="{{ old('titulo') }}" required placeholder="El encabezado principal de la noticia">
                    </div>
                    <div class="form-group">
                        <label>Subtitulo <span class="opt">(opcional)</span></label>
                        <textarea name="subtitulo" class="form-control" placeholder="Amplia la información del título">{{ old('subtitulo') }}</textarea>
                    </div>

                    <div class="section-title">Campos para el Contenido Principal</div>

                    <div class="form-group">
                        <label>Entradilla o Lead <span style="color:#b91c1c">*</span></label>
                        <textarea name="entradilla" class="form-control" required placeholder="Primer párrafo de introducción">{{ old('entradilla') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Cuerpo de la noticia <span style="color:#b91c1c">*</span></label>
                        <textarea name="cuerpo" class="form-control" rows="10" required placeholder="Escribe aquí el cuerpo completo de la noticia">{{ old('cuerpo') }}</textarea>
                    </div>

                    <div class="section-title">Campos para Contenido Multimedia</div>

                    <div class="form-group">
                        <label>Archivo principal <span class="opt">(imagen, video o PDF)</span></label>
                        <div class="file-upload-area" onclick="document.getElementById('file-input').click()">
                            <i data-lucide="upload-cloud" size="40" style="color: #6ab06a; margin-bottom: 10px;"></i>
                            <p style="color: #64748b; font-size: 0.9rem;">Arrastra un archivo aquí o <strong style="color: #6ab06a;">haz clic para seleccionar</strong></p>
                            <p class="file-name" id="file-name" style="color: #1a3a2a; font-weight: 600; margin-top: 8px; font-size: 0.85rem;"></p>
                        </div>
                        <input type="file" name="imagen" id="file-input" accept="image/*,video/*,.pdf" style="display: none;" onchange="updateFileName(this)">
                    </div>
                    <div class="form-group">
                        <label>Pie de archivo <span class="opt">(opcional)</span></label>
                        <input type="text" name="pie_foto" class="form-control" value="{{ old('pie_foto') }}" placeholder="Texto descriptivo del archivo">
                    </div>

                    <div class="section-title">Campos de Control y Metadatos</div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Fecha de publicación <span style="color:#b91c1c">*</span></label>
                            <input type="date" name="fecha_publicacion" class="form-control" value="{{ old('fecha_publicacion', date('Y-m-d')) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Categoria <span style="color:#b91c1c">*</span></label>
                            <select name="categoria" class="form-control" required>
                                <option value="">Selecciona...</option>
                                <option value="Biodiversidad" {{ old('categoria') == 'Biodiversidad' ? 'selected' : '' }}>Biodiversidad</option>
                                <option value="Cambio Climatico" {{ old('categoria') == 'Cambio Climatico' ? 'selected' : '' }}>Cambio Climático</option>
                                <option value="Reciclaje" {{ old('categoria') == 'Reciclaje' ? 'selected' : '' }}>Reciclaje</option>
                                <option value="Energia Renovable" {{ old('categoria') == 'Energia Renovable' ? 'selected' : '' }}>Energía Renovable</option>
                                <option value="Conservacion" {{ old('categoria') == 'Conservacion' ? 'selected' : '' }}>Conservación</option>
                                <option value="Educacion Ambiental" {{ old('categoria') == 'Educacion Ambiental' ? 'selected' : '' }}>Educación Ambiental</option>
                                <option value="Agua" {{ old('categoria') == 'Agua' ? 'selected' : '' }}>Agua</option>
                                <option value="General" {{ old('categoria') == 'General' ? 'selected' : '' }}>General</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Estado <span style="color:#b91c1c">*</span></label>
                            <select name="estado" class="form-control" required>
                                <option value="activa" {{ old('estado') == 'activa' ? 'selected' : '' }}>Activa</option>
                                <option value="inactiva" {{ old('estado') == 'inactiva' ? 'selected' : '' }}>Inactiva</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">Publicar Noticia</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
        function updateFileName(input) {
            const nameEl = document.getElementById('file-name');
            if (input.files && input.files[0]) {
                nameEl.textContent = 'Archivo: ' + input.files[0].name;
            } else {
                nameEl.textContent = '';
            }
        }
    </script>
</body>
</html>
