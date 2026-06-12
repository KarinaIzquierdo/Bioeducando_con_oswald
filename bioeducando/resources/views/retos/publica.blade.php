<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retos Ecológicos - Bioeducando</title>
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

        .retos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 30px;
        }

        .reto-card {
            background: white;
            border-radius: 25px;
            padding: 30px;
            position: relative;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            border-left: 8px solid #6ab06a;
            transition: 0.3s;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .reto-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        }

        .mission-tag {
            font-size: 0.7rem;
            font-weight: 800;
            color: #6ab06a;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 10px;
            display: block;
        }

        .reto-title {
            font-size: 1.6rem;
            color: #1a3a2a;
            font-weight: 800;
            margin-bottom: 15px;
        }

        .reto-stats {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }

        .stat-badge {
            background: #f0fdf4;
            color: #166534;
            padding: 5px 12px;
            border-radius: 10px;
            font-size: 0.8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .reto-desc {
            color: #64748b;
            line-height: 1.5;
            margin-bottom: 25px;
            font-size: 0.95rem;
        }

        .points-badge {
            background: #000;
            color: white;
            padding: 10px 20px;
            border-radius: 15px;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-aceptar {
            background-color: #3d5a44;
            color: white;
            padding: 10px 20px;
            border-radius: 15px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.9rem;
            transition: 0.3s;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-aceptar:hover {
            background-color: #1a3a2a;
            transform: scale(1.05);
        }

        .insignia-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            opacity: 0.1;
        }

        /* Estilos para el Modal de Avance */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            backdrop-filter: blur(5px);
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: white;
            padding: 40px;
            border-radius: 30px;
            width: 90%;
            max-width: 500px;
            text-align: center;
            box-shadow: 0 25px 50px rgba(0,0,0,0.2);
            position: relative;
            border-top: 10px solid #6ab06a;
        }

        .modal-icon {
            width: 80px;
            height: 80px;
            background: #f0fdf4;
            color: #6ab06a;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .modal h3 {
            font-size: 1.8rem;
            color: #1a3a2a;
            margin-bottom: 15px;
            font-weight: 800;
        }

        .modal p {
            color: #64748b;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .progress-container {
            width: 100%;
            height: 12px;
            background: #e2e8f0;
            border-radius: 10px;
            margin-bottom: 10px;
            overflow: hidden;
        }

        .progress-bar {
            width: 0%;
            height: 100%;
            background: #6ab06a;
            border-radius: 10px;
            transition: width 1s ease-in-out;
        }

        .progress-text {
            font-weight: 700;
            color: #1a3a2a;
            margin-bottom: 30px;
            display: block;
        }

        .btn-entendido {
            background-color: #000;
            color: white;
            padding: 12px 40px;
            border-radius: 15px;
            border: none;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-entendido:hover {
            transform: scale(1.05);
            background-color: #333;
        }

        .close-modal {
            position: absolute;
            top: 20px;
            right: 20px;
            cursor: pointer;
            color: #94a3b8;
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
        <div class="top-bar">
            <h2>Retos Ecológicos</h2>
            <div class="profile-icon-container">
                @if(Auth::user()->avatar)
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Perfil" style="border-radius: 50%; width: 50px; height: 50px; object-fit: cover;">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=fff&color=744d2d&size=50" alt="Perfil" style="border-radius: 50%; width: 50px; height: 50px;">
                @endif
            </div>
        </div>

        <div class="container">
            <div class="retos-grid">
                @foreach($retos as $reto)
                <div class="reto-card" onclick="window.location.href='{{ route('retos.seguimiento', $reto->id) }}'" style="cursor: pointer;">
                    <i data-lucide="award" class="insignia-icon" size="48"></i>
                    <div>
                        <span class="mission-tag">Misión {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <h3 class="reto-title">{{ $reto->titulo }}</h3>
                        
                        <div class="reto-stats">
                            <div class="stat-badge"><i data-lucide="clock" size="14"></i> {{ $reto->duracion }}</div>
                            <div class="stat-badge"><i data-lucide="bar-chart" size="14"></i> {{ ucfirst($reto->dificultad) }}</div>
                            <div class="stat-badge"><i data-lucide="tag" size="14"></i> {{ ucfirst($reto->categoria) }}</div>
                        </div>

                        <p class="reto-desc">{{ $reto->descripcion }}</p>
                    </div>

                    <div style="display: flex; justify-content: center; margin-top: 20px;">
                        <button class="btn-aceptar" onclick="event.stopPropagation(); mostrarProgreso('{{ $reto->titulo }}', {{ $reto->id }})">
                            Dar inicio al reto
                            <i data-lucide="play" size="16"></i>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>

            @if($retos->isEmpty())
                <div style="text-align: center; padding: 100px; color: #1a3a2a;">
                    <i data-lucide="leaf" size="60" style="margin-bottom: 20px; opacity: 0.5;"></i>
                    <h2 style="font-size: 1.5rem; font-weight: 800;">No hay retos activos en este momento</h2>
                    <p style="margin-top: 10px; opacity: 0.7;">¡Vuelve pronto para nuevas misiones ecológicas!</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal de Avance -->
    <div id="progresoModal" class="modal">
        <div class="modal-content">
            <i data-lucide="x" class="close-modal" onclick="cerrarModal()"></i>
            <div class="modal-icon">
                <i data-lucide="trending-up" size="40"></i>
            </div>
            <h3 id="modalTitle">¡Misión Iniciada!</h3>
            <p>Has comenzado este reto ecológico. ¡Sigue así para ganar tus puntos y ayudar al planeta!</p>
            
            <div class="progress-container">
                <div id="progressBar" class="progress-bar"></div>
            </div>
            <span class="progress-text">Progreso: <span id="progressValue">0</span>%</span>

            <button class="btn-entendido" onclick="irAlReto()">¡A por ello!</button>
        </div>
    </div>

    <script>
        lucide.createIcons();
        let currentRetoId = null;

        function mostrarProgreso(titulo, id) {
            currentRetoId = id;
            const modal = document.getElementById('progresoModal');
            const bar = document.getElementById('progressBar');
            const val = document.getElementById('progressValue');
            const title = document.getElementById('modalTitle');

            title.innerText = "¡" + titulo + " Iniciado!";
            modal.style.display = 'flex';
            
            // Simular carga de progreso
            setTimeout(() => {
                bar.style.width = '15%';
                val.innerText = '15';
            }, 500);
        }

        function irAlReto() {
            if (currentRetoId) {
                window.location.href = "/mis-retos/" + currentRetoId;
            }
        }

        function cerrarModal() {
            const modal = document.getElementById('progresoModal');
            const bar = document.getElementById('progressBar');
            const val = document.getElementById('progressValue');
            
            modal.style.display = 'none';
            bar.style.width = '0%';
            val.innerText = '0';
        }

        // Cerrar modal si se hace clic fuera de él
        window.onclick = function(event) {
            const modal = document.getElementById('progresoModal');
            if (event.target == modal) {
                cerrarModal();
            }
        }
    </script>
</body>
</html>
