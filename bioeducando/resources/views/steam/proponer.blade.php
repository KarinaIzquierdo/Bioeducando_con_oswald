<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proponer Proyecto STEAM - Bioeducando</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #f0fdf4; min-height: 100vh; display: flex; }

        .sidebar { width: 260px; background-color: #6ab06a; display: flex; flex-direction: column; padding: 20px; position: fixed; height: 100vh; z-index: 1000; }
        .sidebar-title { font-size: 2.2rem; font-weight: 600; color: #000; margin-bottom: 40px; padding-left: 10px; }
        .menu-item { display: flex; align-items: center; padding: 12px 15px; color: white; text-decoration: none; margin-bottom: 10px; border-radius: 10px; transition: 0.3s; font-size: 1rem; }
        .menu-item i { margin-right: 12px; width: 20px; }
        .menu-item.active { background-color: #3d5a44; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .menu-item:hover:not(.active) { background-color: rgba(255,255,255,0.1); }
        .sidebar-footer { margin-top: auto; display: flex; flex-direction: column; align-items: center; gap: 15px; padding: 20px 0; width: 100%; }
        .sidebar-logo { width: 140px; filter: brightness(0); margin-bottom: 5px; }
        .btn-logout { width: 100%; padding: 12px; background-color: #000; color: white; border: none; border-radius: 10px; cursor: pointer; display: flex; align-items: center; justify-content: center; font-weight: 600; transition: 0.3s; text-transform: lowercase; }

        .main-content { margin-left: 260px; min-height: 100vh; flex: 1; display: flex; flex-direction: column; }
        .top-bar { height: 100px; background-color: #744d2d; display: flex; align-items: center; justify-content: space-between; padding: 0 40px; }
        .top-bar h2 { color: white; font-size: 1.8rem; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; }

        .container { padding: 40px; max-width: 900px; margin: 0 auto; width: 100%; }
        .form-card { background: white; padding: 40px; border-radius: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .form-header { margin-bottom: 30px; }
        .form-header h1 { font-size: 2rem; color: #1a3a2a; font-weight: 800; margin-bottom: 10px; }
        .form-header p { color: #64748b; }

        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-weight: 700; color: #1a3a2a; margin-bottom: 8px; font-size: 0.9rem; }
        .form-control { width: 100%; padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 12px; font-size: 1rem; transition: 0.3s; outline: none; }
        .form-control:focus { border-color: #6ab06a; box-shadow: 0 0 0 4px rgba(106, 176, 106, 0.1); }
        textarea.form-control { resize: none; }

        .btn-submit { background: #1a3a2a; color: white; width: 100%; padding: 16px; border: none; border-radius: 15px; font-size: 1.1rem; font-weight: 700; cursor: pointer; transition: 0.3s; display: flex; align-items: center; justify-content: center; gap: 10px; margin-top: 20px; }
        .btn-submit:hover { background: #6ab06a; transform: translateY(-2px); }

        .back-link { display: inline-flex; align-items: center; gap: 8px; color: #64748b; text-decoration: none; margin-bottom: 20px; font-weight: 600; transition: 0.3s; }
        .back-link:hover { color: #6ab06a; }
        .file-upload-wrapper {
            position: relative;
            width: 100%;
            height: 60px;
            background: #f8fafc;
            border: 2px dashed #6ab06a;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: 0.3s;
            overflow: hidden;
        }
        .file-upload-wrapper:hover {
            background: #f0fdf4;
            border-color: #1a3a2a;
        }
        .file-upload-wrapper input[type="file"] {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }
        .file-upload-content {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #6ab06a;
            font-weight: 700;
        }
        .btn-remove-image {
            background: #fee2e2;
            color: #ef4444;
            border: none;
            padding: 8px 15px;
            border-radius: 10px;
            font-size: 0.8rem;
            font-weight: 700;
            cursor: pointer;
            margin-top: 10px;
            display: flex;
            align-items: center;
            gap: 5px;
            margin-left: auto;
            margin-right: auto;
            transition: 0.3s;
        }
        .btn-remove-image:hover {
            background: #fecaca;
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
            <a href="{{ route('contenido.creacion') }}" class="menu-item">
                <i data-lucide="clapperboard"></i> Eco-Estudio
            </a>
            <a href="{{ route('steam.proyectos') }}" class="menu-item active">
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
            <h2>Proponer Proyecto</h2>
        </div>

        <div class="container">
            <a href="{{ route('steam.proyectos') }}" class="back-link">
                <i data-lucide="arrow-left" size="18"></i> Volver a Proyectos
            </a>

            <div class="form-card">
                <div class="form-header">
                    <h1>Propón tu Proyecto STEAM 🔬</h1>
                    <p>Comparte tus ideas innovadoras para ayudar al medio ambiente.</p>
                </div>

                <form action="{{ route('steam.store_propuesta') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Título del Proyecto</label>
                        <input type="text" name="titulo" class="form-control" placeholder="Ej: Cargador Solar Casero" required>
                    </div>

                    <div class="form-group">
                        <label>Categoría</label>
                        <input type="text" name="categoria" class="form-control" placeholder="Ej: Energía Renovable + Electrónica" required>
                    </div>

                    <div class="form-group">
                        <label>Descripción / Pasos</label>
                        <textarea name="descripcion" class="form-control" rows="5" placeholder="Explica detalladamente de qué trata el proyecto..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Objetivos</label>
                        <textarea name="objetivos" class="form-control" rows="3" placeholder="¿Qué quieres lograr con este proyecto?" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Materiales Necesarios</label>
                        <textarea name="materiales" class="form-control" rows="3" placeholder="Lista de materiales..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Impacto Ambiental</label>
                        <textarea name="impacto_ambiental" class="form-control" rows="3" placeholder="¿Cómo beneficia esto al planeta?" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Imagen del Proyecto (Opcional)</label>
                        
                        <!-- Contenedor de previsualización con botón de eliminar -->
                        <div id="image-preview-container" style="display: none; margin-bottom: 20px; text-align: center; background: #f8fafc; padding: 15px; border-radius: 20px; border: 2px dashed #6ab06a;">
                            <p style="font-size: 0.8rem; color: #6ab06a; font-weight: 700; margin-bottom: 10px;">Vista previa de tu imagen:</p>
                            <img id="image-preview" src="#" alt="Previsualización" style="max-width: 100%; height: 250px; object-fit: contain; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                            <button type="button" class="btn-remove-image" onclick="removeImage()">
                                <i data-lucide="image-minus" size="16"></i> Quitar imagen
                            </button>
                        </div>

                        <!-- Botón personalizado de subida -->
                        <div class="file-upload-wrapper" id="upload-wrapper">
                            <input type="file" name="imagen" id="imagen-input" accept="image/*" onchange="previewImage(this)">
                            <div class="file-upload-content">
                                <i data-lucide="image-plus"></i>
                                <span id="file-name-text">Seleccionar imagen del proyecto</span>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">
                        Enviar Propuesta <i data-lucide="send" size="20"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        function previewImage(input) {
            const container = document.getElementById('image-preview-container');
            const preview = document.getElementById('image-preview');
            const wrapper = document.getElementById('upload-wrapper');
            const fileNameText = document.getElementById('file-name-text');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    container.style.display = 'block';
                    wrapper.style.display = 'none'; // Ocultamos el botón de subida cuando hay preview
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeImage() {
            const input = document.getElementById('imagen-input');
            const container = document.getElementById('image-preview-container');
            const wrapper = document.getElementById('upload-wrapper');
            
            input.value = ''; // Limpiamos el input
            container.style.display = 'none';
            wrapper.style.display = 'flex'; // Volvemos a mostrar el botón de subida
        }
    </script>
</body>
</html>
