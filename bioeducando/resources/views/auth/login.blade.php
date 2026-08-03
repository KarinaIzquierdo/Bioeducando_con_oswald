<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bioeducando con Oswald - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body, html { height: 100%; overflow: hidden; }

        .login-container { display: flex; height: 100vh; width: 100vw; }

        /* Lado Izquierdo */
        .left-side {
            width: 50%;
            background-color: #1a3a2a;
            background-image: linear-gradient(rgba(26, 58, 42, 0.4), rgba(10, 26, 16, 0.6)), 
                              url('/imagenes/bosque.png');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            padding: 20px;
        }

        .logo-img-original {
            width: 320px;
            height: auto;
            margin-bottom: 20px;
            filter: drop-shadow(0 5px 15px rgba(0,0,0,0.2));
        }

        .brand-name { font-size: 3.5rem; font-weight: 300; letter-spacing: 12px; text-transform: uppercase; color: white; margin-bottom: -10px; }
        .brand-sub { font-size: 2.8rem; font-weight: 300; letter-spacing: 6px; color: white; opacity: 0.9; }
        .slogan { font-size: 2.2rem; font-style: italic; font-weight: 300; margin-top: 50px; color: white; opacity: 0.9; }

        /* Lado Derecho */
        .right-side {
            width: 50%;
            background: linear-gradient(135deg, #1a3a2a, #0a1a10);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .form-card {
            background: #ededed;
            width: 100%;
            max-width: 450px;
            padding: 50px;
            border-radius: 50px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.3);
        }

        .tabs {
            background: white;
            display: flex;
            padding: 5px;
            border-radius: 50px;
            margin-bottom: 40px;
        }

        .tab {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            cursor: pointer;
            transition: 0.3s;
            background: transparent;
            color: #666;
            font-weight: 600;
            text-decoration: none;
            text-align: center;
        }

        .tab.active { background: #6ab06a; color: white; }

        .form-group { margin-bottom: 25px; }
        .form-group label { display: block; margin-bottom: 10px; margin-left: 15px; color: #444; font-weight: 600; font-size: 0.9rem; }
        
        .form-group input {
            width: 100%;
            padding: 18px 25px;
            border-radius: 20px;
            border: 2px solid transparent;
            background: white;
            outline: none;
            font-size: 1rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            transition: 0.3s;
        }

        .form-group input:focus {
            border-color: #6ab06a;
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            padding-right: 50px;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #888;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5px;
        }

        .toggle-password:hover {
            color: #444;
        }

        .checkbox-group { display: flex; align-items: center; margin-left: 10px; margin-bottom: 30px; }
        .checkbox-group input { width: 18px; height: 18px; margin-right: 12px; cursor: pointer; }
        .checkbox-group label { color: #444; font-weight: 600; cursor: pointer; }

        .btn-login {
            width: 100%;
            background: #6ab06a;
            color: white;
            border: none;
            padding: 18px;
            border-radius: 20px;
            font-size: 1rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(106, 176, 106, 0.3);
            transition: 0.3s;
        }

        .btn-login:hover { background: #5aa05a; transform: translateY(-2px); }

        .forgot-link {
            display: block;
            text-align: center;
            margin-top: 25px;
            color: #2563eb;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .login-container { flex-direction: column; height: auto; overflow-y: auto; }
            body, html { height: auto; overflow-y: auto; }
            .left-side {
                width: 100%;
                height: auto;
                min-height: auto;
                padding: 20px 15px;
                position: relative;
                z-index: 1;
                overflow: hidden;
            }
            .right-side {
                width: 100%;
                height: auto;
                min-height: auto;
                padding: 10px;
                position: relative;
                z-index: 2;
                background: #ededed;
            }
            .logo-img-original { width: 120px; margin-bottom: 8px; }
            .slogan { font-size: 0.95rem; margin-top: 8px; }
            .form-card {
                max-width: 100%;
                width: 100%;
                padding: 10px 5px;
                border-radius: 0;
                margin: 0;
                background: transparent;
                box-shadow: none;
            }
            .tabs { border-radius: 15px; margin-bottom: 15px; }
            .tab { padding: 8px 5px; font-size: 0.8rem; }
            .form-group { margin-bottom: 10px; }
            .form-group label { margin-left: 0; font-size: 0.85rem; }
            .form-group input { padding: 10px 12px; border-radius: 12px; font-size: 0.95rem; }
            .password-wrapper input { padding-right: 35px; }
            .toggle-password { right: 10px; }
            .btn-login { padding: 12px; font-size: 0.85rem; letter-spacing: 1px; border-radius: 15px; }
            .forgot-link { margin-top: 15px; font-size: 0.85rem; }
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="left-side">
        <!-- Ajuste para cargar Logo.svg y convertirlo a blanco -->
        <img src="/imagenes/Logo.svg" alt="Bioeducando" class="logo-img-original" style="filter: brightness(0) invert(1);">
        <p class="slogan">Una comunidad ambiental</p>
    </div>

    <div class="right-side">
        <div class="form-card">
            <div class="tabs">
                <a href="{{ route('login') }}" class="tab active">iniciar sesión</a>
                <a href="{{ route('register') }}" class="tab">registrarse</a>
            </div>

            @if(session('success'))
                <div style="background: #dcfce7; border-radius: 15px; padding: 15px; margin-bottom: 20px; border: 1px solid #bbf7d0; text-align: center;">
                    <p style="color: #15803d; font-size: 0.9rem; font-weight: 600;">{{ session('success') }}</p>
                </div>
            @endif

            @if($errors->any())
                <p style="color: red; font-size: 0.8rem; text-align: center; margin-bottom: 15px;">{{ $errors->first() }}</p>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>correo electrónico</label>
                    <input type="email" name="email" required value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label>contraseña</label>
                    <div class="password-wrapper">
                        <input type="password" name="password" id="password" required>
                        <button type="button" class="toggle-password" id="toggle-password">
                            <i data-lucide="eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-login">iniciar sesión</button>
            </form>

            <a href="{{ route('recuperar') }}" class="forgot-link">¿olvidaste tu contraseña?</a>
        </div>
    </div>
</div>

<script>
    lucide.createIcons();

    const toggleBtn = document.getElementById('toggle-password');
    const passInput = document.getElementById('password');
    let isVisible = false;

    toggleBtn.addEventListener('click', function() {
        isVisible = !isVisible;
        passInput.type = isVisible ? 'text' : 'password';
        // Cambiar el icono
        const icon = this.querySelector('i');
        icon.setAttribute('data-lucide', isVisible ? 'eye-off' : 'eye');
        lucide.createIcons();
    });
</script>

</body>
</html>
