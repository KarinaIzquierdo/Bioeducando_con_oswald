<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco-Estudio - Bioeducando</title>
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

        .main-content { flex: 1; margin-left: 260px; display: flex; flex-direction: column; min-height: 100vh; }
        .top-bar { height: 100px; background-color: #744d2d; display: flex; align-items: center; justify-content: space-between; padding: 0 40px; width: 100%; position: sticky; top: 0; z-index: 900; }
        .top-bar h2 { color: white; font-size: 1.8rem; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; margin: 0; }
        .profile-icon { width: 50px; height: 50px; background-color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #744d2d; border: 2px solid white; overflow: hidden; flex-shrink: 0; }
        .profile-icon img { width: 100%; height: 100%; object-fit: cover; }

        .container { padding: 40px; flex: 1; width: 100%; max-width: 1200px; margin: 0 auto; }
        .header-content { text-align: center; margin-bottom: 40px; }
        .header-content h1 { font-size: 2.5rem; color: #1a3a2a; font-weight: 800; margin-bottom: 10px; }
        .header-content p { color: #64748b; font-size: 1.1rem; }
        .studio-grid { display: grid; grid-template-columns: 1fr 1.5fr; gap: 40px; align-items: start; }
        .card { background: white; border-radius: 30px; padding: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .tool-item { display: flex; align-items: center; gap: 20px; padding: 20px; border-radius: 20px; text-decoration: none; transition: 0.3s; margin-bottom: 15px; border: 1px solid #f1f5f9; }
        .tool-item:hover { transform: translateX(10px); background: #f8fafc; border-color: #6ab06a; }
        .tool-icon { width: 50px; height: 50px; border-radius: 15px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
        .tool-info h3 { font-size: 1.1rem; color: #1a3a2a; font-weight: 700; }
        .tool-info p { font-size: 0.9rem; color: #64748b; }
        .upload-title { font-size: 1.5rem; color: #1a3a2a; font-weight: 800; margin-bottom: 25px; display: flex; align-items: center; gap: 12px; }
        .form-group { margin-bottom: 25px; }
        .form-group label { display: block; font-weight: 700; color: #1a3a2a; margin-bottom: 10px; }
        .form-control { width: 100%; padding: 15px; border: 2px solid #e2e8f0; border-radius: 15px; font-size: 1rem; transition: 0.3s; outline: none; }
        .form-control:focus { border-color: #6ab06a; }
        .file-upload-zone { border: 2px dashed #cbd5e1; border-radius: 20px; padding: 40px; text-align: center; cursor: pointer; transition: 0.3s; position: relative; }
        .file-upload-zone:hover { border-color: #6ab06a; background: #f0fdf4; }
        .btn-publish { width: 100%; padding: 18px; background: #1a3a2a; color: white; border: none; border-radius: 15px; font-weight: 800; font-size: 1.1rem; cursor: pointer; transition: 0.3s; display: flex; align-items: center; justify-content: center; gap: 12px; }
        .btn-publish:hover { background: #2d4433; transform: translateY(-3px); box-shadow: 0 10px 20px rgba(26, 58, 42, 0.2); }
        #preview-container { margin-top: 20px; border-radius: 15px; overflow: hidden; display: none; }
        #preview-container img, #preview-container video { width: 100%; max-height: 400px; object-fit: contain; }
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
            <a href="{{ route('contenido.creacion') }}" class="menu-item active"><i data-lucide="clapperboard"></i> Eco-Estudio</a>
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
            <h2>Eco-Estudio</h2>
            <div class="profile-icon">
                @if(Auth::check() && Auth::user()->foto_path)
                    <img src="{{ asset(Auth::user()->foto_path) }}" alt="Perfil">
                @else
                    <i data-lucide="user" style="width: 28px; height: 28px;"></i>
                @endif
            </div>
        </div>
        <div class="container">
            <div class="header-content"><h1>¡Sé un Creador Eco! 🌱</h1><p>Utiliza estas herramientas para crear y compartir tus avances ecológicos con el mundo.</p></div>
            <div class="studio-grid">
                <div class="card">
                    <h2 class="upload-title"><i data-lucide="wrench"></i> Herramientas</h2>
                    <a href="https://www.capcut.com" target="_blank" class="tool-item">
                        <div class="tool-icon" style="background: #f8fafc;"><i data-lucide="video"></i></div>
                        <div class="tool-info"><h3>CapCut</h3><p>Edita tus videos profesionalmente.</p></div>
                    </a>
                    <a href="https://www.canva.com" target="_blank" class="tool-item">
                        <div class="tool-icon" style="background: #f0f9ff;"><i data-lucide="palette"></i></div>
                        <div class="tool-info"><h3>Canva</h3><p>Diseña posters increíbles.</p></div>
                    </a>
                    <a href="https://www.tiktok.com" target="_blank" class="tool-item">
                        <div class="tool-icon" style="background: #fff1f2;"><i data-lucide="music"></i></div>
                        <div class="tool-info"><h3>TikTok</h3><p>Comparte y hazte viral.</p></div>
                    </a>
                </div>
                <div class="card">
                    <h2 class="upload-title"><i data-lucide="share-2"></i> Compartir</h2>
                    <form action="{{ route('comunidad.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group"><label>Descripción</label><textarea name="contenido" class="form-control" rows="4" placeholder="Cuéntanos sobre tu creación..."></textarea></div>
                        <div class="form-group"><label>Tu Obra Maestra (Video o Imagen)</label><div class="file-upload-zone" onclick="document.getElementById('file-input').click()"><i data-lucide="clapperboard" size="40" style="color: #64748b; margin-bottom: 10px;"></i><p id="file-name">Seleccionar archivo</p><input type="file" id="file-input" name="media" style="display: none;" accept="video/*,image/*" onchange="previewFile(this)"></div><div id="preview-container"></div></div>
                        <div class="form-group"><label>Documento PDF (Opcional)</label><div class="file-upload-zone" onclick="document.getElementById('pdf-input').click()" style="border-color: #e2e8f0;"><i data-lucide="file-text" size="40" style="color: #b91c1c; margin-bottom: 10px;"></i><p id="pdf-name">Seleccionar PDF</p><input type="file" id="pdf-input" name="pdf" style="display: none;" accept="application/pdf" onchange="previewPdf(this)"></div><div id="pdf-preview-container" style="margin-top: 15px; display: none;"><div style="display: flex; align-items: center; gap: 15px; background: #f8fafc; padding: 15px; border-radius: 15px; border: 1px solid #e2e8f0;"><i data-lucide="file-text" size="32" style="color: #b91c1c;"></i><div><p id="pdf-preview-name" style="font-weight: 700; color: #1a3a2a; margin: 0;"></p><p style="font-size: 0.85rem; color: #64748b; margin: 0;">Documento PDF listo para publicar</p></div></div></div></div>
                        <button type="submit" class="btn-publish">Publicar <i data-lucide="send"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        lucide.createIcons();
        function previewFile(input) {
            const file = input.files[0];
            const previewContainer = document.getElementById('preview-container');
            const fileName = document.getElementById('file-name');
            if (file) {
                fileName.textContent = file.name;
                previewContainer.style.display = 'block';
                previewContainer.innerHTML = '';
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (file.type.startsWith('video/')) {
                        const video = document.createElement('video');
                        video.src = e.target.result;
                        video.controls = true;
                        previewContainer.appendChild(video);
                    } else {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        previewContainer.appendChild(img);
                    }
                };
                reader.readAsDataURL(file);
            }
        }
        function previewPdf(input) {
            const file = input.files[0];
            const previewContainer = document.getElementById('pdf-preview-container');
            const fileName = document.getElementById('pdf-name');
            const previewName = document.getElementById('pdf-preview-name');
            if (file) {
                fileName.textContent = file.name;
                previewName.textContent = file.name;
                previewContainer.style.display = 'block';
            }
        }
    </script>
</body>
</html>
