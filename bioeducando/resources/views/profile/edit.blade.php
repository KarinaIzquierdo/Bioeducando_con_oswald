<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - Bioeducando</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { display: flex; height: 100vh; background-color: #f4f7f4; }
        .sidebar { width: 260px; background-color: #6ab06a; display: flex; flex-direction: column; padding: 20px; position: fixed; height: 100vh; z-index: 1000; }
        .sidebar-title { font-size: 2.2rem; font-weight: 600; color: #000; margin-bottom: 40px; padding-left: 10px; }
        .menu-item { display: flex; align-items: center; padding: 12px 15px; color: white; text-decoration: none; margin-bottom: 10px; border-radius: 10px; transition: 0.3s; font-size: 1rem; }
        .menu-item i { margin-right: 12px; width: 20px; }
        .menu-item.active { background-color: #3d5a44; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .menu-item:hover:not(.active) { background-color: rgba(255,255,255,0.1); }
        .sidebar-footer { margin-top: auto; display: flex; flex-direction: column; align-items: center; gap: 15px; padding: 20px 0; width: 100%; }
        .sidebar-logo { width: 140px; filter: brightness(0); margin-bottom: 5px; }
        .btn-logout { width: 100%; padding: 12px; background-color: #000; color: white; border: none; border-radius: 10px; cursor: pointer; display: flex; align-items: center; justify-content: center; font-weight: 600; transition: 0.3s; text-transform: lowercase; }
        .main-content { flex: 1; display: flex; flex-direction: column; margin-left: 260px; min-height: 100vh; }
        .top-bar { height: 100px; background-color: #744d2d; display: flex; align-items: center; justify-content: space-between; padding: 0 40px; position: sticky; top: 0; z-index: 900; }
        .top-bar h2 { color: white; font-size: 1.8rem; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; margin: 0; }
        .profile-icon { width: 50px; height: 50px; background-color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #744d2d; border: 2px solid white; overflow: hidden; flex-shrink: 0; }
        .profile-icon img { width: 100%; height: 100%; object-fit: cover; }
        .content-padding { padding: 40px; max-width: 1000px; margin: 0 auto; width: 100%; }
        .profile-container { display: grid; grid-template-columns: 300px 1fr; gap: 30px; }
        .card { background: white; padding: 30px; border-radius: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .avatar-section { display: flex; flex-direction: column; align-items: center; text-align: center; }
        .avatar-circle { width: 140px; height: 140px; background: #f0fdf4; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #6ab06a; margin-bottom: 20px; border: 4px solid white; box-shadow: 0 5px 15px rgba(0,0,0,0.1); overflow: hidden; cursor: pointer; transition: 0.3s; }
        .avatar-circle:hover { transform: scale(1.05); border-color: #6ab06a; }
        .avatar-circle img { width: 100%; height: 100%; object-fit: cover; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-weight: 600; color: #444; margin-bottom: 8px; font-size: 0.9rem; }
        .form-control { width: 100%; padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 12px; font-size: 1rem; transition: 0.3s; outline: none; }
        .form-control:focus { border-color: #6ab06a; box-shadow: 0 0 0 4px rgba(106, 176, 106, 0.1); }
        .btn-save { background: #6ab06a; color: white; padding: 12px 25px; border: none; border-radius: 12px; font-weight: 600; cursor: pointer; transition: 0.3s; display: flex; align-items: center; gap: 10px; }
        .btn-save:hover { background: #5aa05a; transform: translateY(-2px); }
        .section-title { font-size: 1.2rem; color: #1a3a2a; font-weight: 700; margin-bottom: 25px; display: flex; align-items: center; gap: 10px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h1 class="sidebar-title">Usuario</h1>
        <nav>
            <a href="{{ route('profile.edit') }}" class="menu-item active"><i data-lucide="user"></i> Perfil</a>
            <a href="{{ route('retos.usuario') }}" class="menu-item"><i data-lucide="leaf"></i> Retos Ecológicos</a>
            <a href="{{ route('noticias.usuario') }}" class="menu-item"><i data-lucide="newspaper"></i> Noticias Ambientales</a>
            <a href="{{ route('comunidad.usuario') }}" class="menu-item"><i data-lucide="flower-2"></i> Comunidad Ambiental</a>
            <a href="{{ route('contenido.creacion') }}" class="menu-item"><i data-lucide="clapperboard"></i> Eco-Estudio</a>
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
            <h2>Mi Perfil</h2>
            <div class="profile-icon">
                @if(Auth::check() && Auth::user()->foto_path)
                    <img src="{{ asset(Auth::user()->foto_path) }}" alt="Perfil" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                    <i data-lucide="user" style="width: 28px; height: 28px; display: none;"></i>
                @else
                    <i data-lucide="user" style="width: 28px; height: 28px;"></i>
                @endif
            </div>
        </div>
        <div class="content-padding">
            @if(session('success'))<div style="background: #dcfce7; color: #15803d; padding: 15px; border-radius: 12px; margin-bottom: 25px; font-weight: 600;">{{ session('success') }}</div>@endif
            @if($errors->any())
                <div style="background: #fee2e2; color: #b91c1c; padding: 15px; border-radius: 12px; margin-bottom: 25px; font-weight: 600;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="profile-container">
                <div class="avatar-section card">
                    <div class="avatar-circle" onclick="document.getElementById('foto-input').click()">
                        @if($user->foto_path)<img src="{{ asset($user->foto_path) }}" alt="Avatar" id="avatar-preview" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <i data-lucide="camera" size="40" style="display: none;"></i>
                        @else<i data-lucide="camera" size="40"></i>@endif
                    </div>
                    <h3>{{ $user->name }}</h3>
                    <p>Usuario Bioeducando</p>
                    <p style="margin-top: 20px; font-size: 0.85rem; color: #94a3b8;">Miembro desde {{ $user->created_at->format('M Y') }}</p>
                </div>
                <div class="forms-section">
                    <div class="card" style="margin-bottom: 30px;">
                        <h2 class="section-title"><i data-lucide="user-cog"></i> Datos Personales</h2>
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <input type="file" name="foto_perfil" id="foto-input" style="display: none;" accept="image/png, image/jpeg" onchange="previewAvatar(this)">
                            <div class="form-group"><label>Nombre Completo</label><input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}"></div>
                            <div class="form-group"><label>Correo Electrónico</label><input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}"></div>
                            <div class="form-group"><label>Número Telefónico</label><input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone ?? '') }}" placeholder="Ej: +57 300 123 4567"></div>
                            <button type="submit" class="btn-save"><i data-lucide="save"></i> Guardar Cambios</button>
                        </form>
                    </div>
                    <div class="card">
                        <h2 class="section-title"><i data-lucide="lock"></i> Seguridad</h2>
                        <form action="{{ route('profile.password') }}" method="POST">
                            @csrf @method('PUT')
                            <div class="form-group password-group">
                                <label>Contraseña Actual</label>
                                <div class="password-wrapper">
                                    <input type="password" id="current_password" name="current_password" class="form-control" placeholder="••••••••">
                                    <button type="button" class="toggle-password" onclick="togglePassword('current_password', this)">
                                        <i data-lucide="eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group password-group">
                                <label>Nueva Contraseña</label>
                                <div class="password-wrapper">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Mínimo 8 caracteres">
                                    <button type="button" class="toggle-password" onclick="togglePassword('password', this)">
                                        <i data-lucide="eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group password-group">
                                <label>Confirmar Nueva Contraseña</label>
                                <div class="password-wrapper">
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Repite la nueva contraseña">
                                    <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation', this)">
                                        <i data-lucide="eye"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="submit" class="btn-save" style="background: #1a3a2a;"><i data-lucide="shield-check"></i> Actualizar Contraseña</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .password-wrapper { position: relative; display: flex; align-items: center; }
        .password-wrapper input { width: 100%; padding-right: 50px; }
        .toggle-password {
            position: absolute;
            right: 12px;
            background: none;
            border: none;
            cursor: pointer;
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5px;
            transition: color 0.2s;
        }
        .toggle-password:hover { color: #6ab06a; }
        .toggle-password svg { width: 20px; height: 20px; }
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
    <script>
        lucide.createIcons();
        function previewAvatar(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const circle = document.querySelector('.avatar-circle');
                    circle.innerHTML = `<img src="${e.target.result}" alt="Preview" style="width: 100%; height: 100%; object-fit: cover;">`;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            const icon = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.setAttribute('data-lucide', 'eye-off');
            } else {
                input.type = 'password';
                icon.setAttribute('data-lucide', 'eye');
            }
            lucide.createIcons();
        }
    </script>
</body>
</html>
