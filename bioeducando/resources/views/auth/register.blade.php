<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse - Bioeducando con Oswald</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body, html { height: 100%; overflow: hidden; }

        .register-container { display: flex; height: 100vh; width: 100vw; }

        /* Lado Izquierdo: Estética Bosque */
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
            filter: brightness(0) invert(1);
        }

        .slogan { font-size: 2.2rem; font-style: italic; font-weight: 300; margin-top: 50px; color: white; opacity: 0.9; }

        /* Lado Derecho: Formulario */
        .right-side {
            width: 50%;
            background: linear-gradient(135deg, #1a3a2a, #0a1a10);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            overflow-y: auto;
        }

        .form-card {
            background: #ededed;
            width: 100%;
            max-width: 480px;
            padding: 40px 50px;
            border-radius: 50px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.3);
            margin: 20px 0;
        }

        .tabs {
            background: white;
            display: flex;
            padding: 5px;
            border-radius: 50px;
            margin-bottom: 30px;
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
            text-align: center;
            text-decoration: none;
        }

        .tab.active { background: #6ab06a; color: white; }

        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 8px; margin-left: 15px; color: #444; font-weight: 600; font-size: 0.9rem; }
        
        .form-group input {
            width: 100%;
            padding: 15px 25px;
            border-radius: 20px;
            border: none;
            background: white;
            outline: none;
            font-size: 0.95rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
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

        .btn-register {
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
            margin-top: 10px;
        }

        .btn-register:hover { background: #5aa05a; transform: translateY(-2px); }

        @media (max-width: 768px) {
            .register-container { flex-direction: column; height: auto; overflow-y: auto; }
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
            .btn-register { padding: 12px; font-size: 0.85rem; letter-spacing: 1px; border-radius: 15px; }
        }
    </style>
</head>
<body>

<div class="register-container">
    <div class="left-side">
        <!-- Logo cargando el archivo SVG original corregido a blanco -->
        <img src="/imagenes/Logo.svg" alt="Bioeducando" class="logo-img-original">
        <p class="slogan">Una comunidad ambiental</p>
    </div>

    <div class="right-side">
        <div class="form-card">
            <div class="tabs">
                <a href="{{ route('login') }}" class="tab">iniciar sesión</a>
                <a href="#" class="tab active">registrarse</a>
            </div>

            @if($errors->any())
                <div style="background: #fee2e2; border-radius: 15px; padding: 10px; margin-bottom: 20px; border: 1px solid #fecaca;">
                    <p style="color: #b91c1c; font-size: 0.85rem; text-align: center;">{{ $errors->first() }}</p>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>nombre completo</label>
                    <input type="text" name="name" required value="{{ old('name') }}" placeholder="Tu nombre">
                </div>

                <div class="form-group">
                    <label>correo electrónico</label>
                    <input type="email" name="email" required value="{{ old('email') }}" placeholder="ejemplo@correo.com">
                </div>

                <div class="form-group">
                    <label>contraseña</label>
                    <div class="password-wrapper">
                        <input type="password" name="password" id="password" required placeholder="Mínimo 8 caracteres">
                        <button type="button" class="toggle-password" data-target="password">
                            <i data-lucide="eye"></i>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label>confirmar contraseña</label>
                    <div class="password-wrapper">
                        <input type="password" name="password_confirmation" id="password-confirm" required placeholder="Repite tu contraseña">
                        <button type="button" class="toggle-password" data-target="password-confirm">
                            <i data-lucide="eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-register">crear cuenta</button>
            </form>
        </div>
    </div>
</div>

<script>
    lucide.createIcons();

    document.querySelectorAll('.toggle-password').forEach(btn => {
        btn.addEventListener('click', function() {
            const targetId = this.dataset.target;
            const input = document.getElementById(targetId);
            const isVisible = input.type === 'text';
            input.type = isVisible ? 'password' : 'text';

            const icon = this.querySelector('i');
            icon.setAttribute('data-lucide', isVisible ? 'eye' : 'eye-off');
            lucide.createIcons();
        });
    });
</script>

</body>
</html>
