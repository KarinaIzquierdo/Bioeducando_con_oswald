<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguimiento de Reto - Bioeducando</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
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

        .sidebar-logo { width: 140px; filter: brightness(0); margin-bottom: 5px; }
        .sidebar-footer { margin-top: auto; display: flex; flex-direction: column; align-items: center; gap: 15px; padding: 20px 0; width: 100%; }
        .sidebar-logo-img { width: 140px; filter: brightness(0); margin-bottom: 5px; }
        .btn-logout { width: 100%; padding: 12px; background-color: #000; color: white; border: none; border-radius: 10px; cursor: pointer; display: flex; align-items: center; justify-content: center; font-weight: 600; transition: 0.3s; text-transform: lowercase; }

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

        .container { 
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 20px; 
            width: 100%;
        }

        .challenge-card {
            background: white;
            border-radius: 30px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            border-top: 10px solid #6ab06a;
        }

        .challenge-header {
            margin-bottom: 30px;
        }

        .challenge-header h1 {
            color: #1a3a2a;
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .day-badge {
            display: inline-block;
            background: #f0fdf4;
            color: #166534;
            padding: 5px 15px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.9rem;
        }

        /* Checklist */
        .checklist {
            margin: 30px 0;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .check-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 20px;
            background: #f8fafc;
            border-radius: 15px;
            cursor: pointer;
            transition: 0.3s;
            border: 1px solid transparent;
        }

        .check-item:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
        }

        .check-item input[type="checkbox"] {
            width: 22px;
            height: 22px;
            accent-color: #6ab06a;
            cursor: pointer;
        }

        .check-item label {
            font-size: 1.1rem;
            color: #334155;
            cursor: pointer;
            font-weight: 500;
        }

        /* Evidence Section */
        .evidence-section {
            margin: 40px 0;
            padding: 25px;
            border: 2px dashed #cbd5e1;
            border-radius: 20px;
            text-align: center;
            background: #fafafa;
            transition: 0.3s;
            cursor: pointer;
            position: relative;
            min-height: 150px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        #preview-container {
            width: 100%;
            height: 100%;
            display: none;
            border-radius: 15px;
            overflow: hidden;
        }

        #preview-image {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
        }

        .remove-img {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(255,0,0,0.8);
            color: white;
            border-radius: 50%;
            padding: 5px;
            display: none;
            z-index: 10;
        }

        .evidence-section:hover {
            border-color: #6ab06a;
            background: #f0fdf4;
        }

        .evidence-icon {
            color: #64748b;
            margin-bottom: 10px;
        }

        .evidence-text {
            color: #64748b;
            font-weight: 600;
        }

        /* Progress Footer */
        .progress-footer {
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px solid #e2e8f0;
        }

        .progress-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            font-weight: 700;
            color: #1a3a2a;
        }

        .progress-bar-container {
            width: 100%;
            height: 12px;
            background: #e2e8f0;
            border-radius: 10px;
            margin-bottom: 30px;
            overflow: hidden;
        }

        .progress-bar-fill {
            width: 28%;
            height: 100%;
            background: #6ab06a;
            border-radius: 10px;
            transition: width 1s ease;
        }

        .btn-save-progress {
            width: 100%;
            background: #000;
            color: white;
            padding: 18px;
            border-radius: 20px;
            border: none;
            font-size: 1.1rem;
            font-weight: 800;
            cursor: pointer;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-save-progress:hover {
            background: #333;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
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
            <a href="{{ route('retos.publica') }}" class="menu-item active">
                <i data-lucide="leaf"></i> Retos Ecológicos
            </a>
            <a href="{{ route('comunidad.publica') }}" class="menu-item">
                <i data-lucide="flower-2"></i> Comunidad Ambiental
            </a>
            <a href="{{ route('contenido.creacion') }}" class="menu-item">
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
        <div class="top-bar" style="height: 100px; background-color: #744d2d; display: flex; align-items: center; justify-content: flex-end; padding: 0 40px; width: 100%; box-sizing: border-box;">
            <div style="width: 50px; height: 50px; background-color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #744d2d; border: 2px solid white; overflow: hidden; flex-shrink: 0;">
                @if(Auth::check() && Auth::user()->foto_path)
                    <img src="{{ asset(Auth::user()->foto_path) }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    <i data-lucide="user" style="width: 28px; height: 28px;"></i>
                @endif
            </div>
        </div>
        </div>
        </div>

        <div class="container">
            <div class="challenge-card">
                <div class="challenge-header">
                    <h1>{{ $reto->titulo }}</h1>
                    <span class="day-badge" id="current-day-title">Día {{ $diaActual }} de {{ $totalDias }}</span>
                </div>

                <div class="checklist">
                    <div class="check-item">
                        <input type="checkbox" id="task1">
                        <label for="task1">Separé residuos reciclables hoy</label>
                    </div>
                    <div class="check-item">
                        <input type="checkbox" id="task2">
                        <label for="task2">Separé residuos orgánicos hoy</label>
                    </div>
                    <div class="check-item">
                        <input type="checkbox" id="task3">
                        <label for="task3">Separé residuos no aprovechables hoy</label>
                    </div>
                </div>

                <div class="evidence-section" onclick="document.getElementById('foto-evidencia').click()">
                    <input type="file" id="foto-evidencia" style="display: none;" accept="image/*" onchange="previewImage(this)">
                    <i data-lucide="x" class="remove-img" id="remove-btn" onclick="removeImage(event)"></i>
                    <div id="upload-placeholder">
                        <i data-lucide="camera" class="evidence-icon" size="32"></i>
                        <div class="evidence-text">Subir foto de evidencia</div>
                    </div>
                    <div id="preview-container">
                        <img id="preview-image" src="" alt="Vista previa">
                    </div>
                </div>

                <div style="margin-top: 20px; margin-bottom: 30px;">
                    <label style="display: block; font-weight: 700; color: #1a3a2a; margin-bottom: 10px;">Cuéntanos tu experiencia de hoy:</label>
                    <textarea id="comentario-usuario" placeholder="Ej: ¡Hoy aprendí a separar mejor los plásticos!" 
                        style="width: 100%; padding: 15px; border-radius: 15px; border: 1px solid #e2e8f0; outline: none; font-size: 1rem; transition: 0.3s; resize: none; height: 100px;"></textarea>
                </div>

                <div class="progress-footer">
                    <div class="progress-info">
                        <span>Progreso: <span id="days-completed">{{ $diaActual }}</span>/{{ $totalDias }} días completados</span>
                        <span id="progress-percent">0%</span>
                    </div>
                    <div class="progress-bar-container">
                        <div class="progress-bar-fill" id="bar-fill" style="width: 0%;"></div>
                    </div>

                    <button class="btn-save-progress" onclick="guardarAvance()">
                        <i data-lucide="save"></i>
                        Guardar progreso
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        function previewImage(input) {
            const placeholder = document.getElementById('upload-placeholder');
            const container = document.getElementById('preview-container');
            const preview = document.getElementById('preview-image');
            const removeBtn = document.getElementById('remove-btn');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    placeholder.style.display = 'none';
                    container.style.display = 'block';
                    removeBtn.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeImage(event) {
            event.stopPropagation();
            const input = document.getElementById('foto-evidencia');
            const placeholder = document.getElementById('upload-placeholder');
            const container = document.getElementById('preview-container');
            const removeBtn = document.getElementById('remove-btn');
            
            input.value = '';
            placeholder.style.display = 'block';
            container.style.display = 'none';
            removeBtn.style.display = 'none';
        }

        let diaActual = {{ $diaActual }};
        const totalDias = {{ $totalDias }};
        const retoId = {{ $reto->id }};

        async function guardarAvance() {
            const checks = document.querySelectorAll('input[type="checkbox"]:checked');
            if (checks.length === 0) {
                alert("Por favor selecciona al menos una tarea completada hoy.");
                return;
            }

            const fotoInput = document.getElementById('foto-evidencia');
            const foto = fotoInput.files[0];
            if (!foto) {
                alert("Por favor sube una foto de evidencia.");
                return;
            }

            // Crear FormData para enviar la imagen y los datos
            const formData = new FormData();
            formData.append('reto_id', retoId);
            formData.append('dia_completado', diaActual + 1);
            formData.append('foto', foto);
            formData.append('comentario', document.getElementById('comentario-usuario').value);
            formData.append('_token', '{{ csrf_token() }}');

            try {
                // Mostrar un mensaje de carga o deshabilitar botón si lo deseas
                const btn = document.querySelector('.btn-save-progress');
                btn.disabled = true;
                btn.innerText = "Guardando...";

                const response = await fetch('{{ route("retos.storeProgress") }}', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();

                if (result.success) {
                    // Incrementar día si no ha llegado al final
                    if (diaActual < totalDias) {
                        diaActual++;
                        
                        // Actualizar interfaz
                        document.getElementById('days-completed').innerText = diaActual;
                        
                        // Cálculo exacto: Día 1 de 7 es ~14%, Día 7 de 7 es 100%
                        let percent = Math.round((diaActual / totalDias) * 100);
                        if (diaActual === totalDias) percent = 100;

                        document.getElementById('progress-percent').innerText = percent + "%";
                        document.getElementById('bar-fill').style.width = percent + "%";
                        
                        // Actualizar el título del día
                        const dayBadge = document.getElementById('current-day-title');
                        dayBadge.innerText = `Día ${diaActual} de ${totalDias}`;

                        if (diaActual === totalDias) {
                            alert("¡Felicidades! Has completado los 7 días del reto al 100% y se ha compartido tu logro final en la comunidad.");
                        } else {
                            alert("¡Excelente! Tu progreso se ha guardado y compartido automáticamente en la comunidad ambiental.");
                            
                            // Limpiar para la simulación del siguiente día
                            document.querySelectorAll('input[type="checkbox"]').forEach(c => c.checked = false);
                            document.getElementById('comentario-usuario').value = '';
                            removeImage({stopPropagation: () => {}});
                        }
                    }
                } else {
                    alert("Error al guardar: " + (result.message || "Intente de nuevo"));
                }
            } catch (error) {
                console.error("Error:", error);
                alert("Hubo un problema al conectar con el servidor.");
            } finally {
                const btn = document.querySelector('.btn-save-progress');
                btn.disabled = false;
                btn.innerHTML = '<i data-lucide="save"></i> Guardar progreso';
                lucide.createIcons();
            }
        }
    </script>
</body>
</html>
