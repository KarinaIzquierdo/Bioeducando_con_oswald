<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Contraseña - Bioeducando</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* Mismos estilos elegantes del login */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body, html { height: 100%; overflow: hidden; }
        .reset-container { display: flex; height: 100vh; width: 100vw; }
        .left-side {
            width: 50%;
            background-color: #1a3a2a;
            background-image: linear-gradient(rgba(26, 58, 42, 0.4), rgba(10, 26, 16, 0.6)), url('/imagenes/bosque.png');
            background-size: cover; background-position: center;
            display: flex; align-items: center; justify-content: center;
        }
        .logo-img-original { width: 320px; filter: brightness(0) invert(1); }
        .right-side {
            width: 50%;
            background: linear-gradient(135deg, #1a3a2a, #0a1a10);
            display: flex; align-items: center; justify-content: center; padding: 40px;
        }
        .form-card { background: #ededed; width: 100%; max-width: 450px; padding: 50px; border-radius: 50px; box-shadow: 0 25px 50px rgba(0,0,0,0.3); }
        h2 { color: #333; margin-bottom: 25px; text-align: center; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; margin-left: 15px; color: #444; font-weight: 600; }
        .form-group input { width: 100%; padding: 15px 25px; border-radius: 20px; border: 2px solid transparent; outline: none; transition: 0.3s; }
        .form-group input:focus { border-color: #6ab06a; }
        .btn-reset { width: 100%; background: #6ab06a; color: white; border: none; padding: 18px; border-radius: 20px; font-weight: 700; cursor: pointer; text-transform: uppercase; }
    </style>
</head>
<body>
    <div class="reset-container">
        <div class="left-side">
            <img src="/imagenes/Logo.svg" alt="Logo" class="logo-img-original">
        </div>
        <div class="right-side">
            <div class="form-card">
                <h2>Crea tu nueva contraseña</h2>
                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ request()->email }}">

                    <div class="form-group">
                        <label>Nueva Contraseña</label>
                        <input type="password" name="password" required placeholder="Mínimo 8 caracteres">
                    </div>

                    <div class="form-group">
                        <label>Confirmar Nueva Contraseña</label>
                        <input type="password" name="password_confirmation" required placeholder="Repite tu contraseña">
                    </div>

                    <button type="submit" class="btn-reset">Cambiar Contraseña</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
