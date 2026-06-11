<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña - Bioeducando</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body, html { height: 100%; overflow: hidden; }

        .recover-container { display: flex; height: 100vh; width: 100vw; }

        /* Lado Izquierdo: Bosque */
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
            padding: 20px;
        }

        .logo-img-original {
            width: 320px;
            height: auto;
            margin-bottom: 20px;
            filter: brightness(0) invert(1);
        }

        /* Lado Derecho: Formulario */
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

        h2 { color: #333; margin-bottom: 15px; text-align: center; font-size: 1.8rem; }
        p.instruction { color: #666; text-align: center; margin-bottom: 30px; line-height: 1.5; }

        .form-group { margin-bottom: 25px; }
        .form-group label { display: block; margin-bottom: 10px; margin-left: 15px; color: #444; font-weight: 600; }
        
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

        .form-group input:focus { border-color: #6ab06a; }

        .btn-recover {
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

        .btn-recover:hover { background: #5aa05a; transform: translateY(-2px); }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 25px;
            color: #666;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .back-link:hover { color: #6ab06a; }

        @media (max-width: 768px) {
            .recover-container { flex-direction: column; }
            .left-side, .right-side { width: 100%; height: 50%; }
        }
    </style>
</head>
<body>

<div class="recover-container">
    <div class="left-side">
        <img src="/imagenes/Logo.svg" alt="Bioeducando" class="logo-img-original">
    </div>

    <div class="right-side">
        <div class="form-card">
            <h2>¿Olvidaste tu contraseña?</h2>
            <p class="instruction">Ingresa tu correo electrónico y te enviaremos las instrucciones para restablecerla.</p>

            @if(session('success'))
                <div style="background: #dcfce7; border-radius: 15px; padding: 15px; margin-bottom: 20px; border: 1px solid #bbf7d0; color: #15803d; text-align: center; font-size: 0.9rem;">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('recuperar') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Correo Electrónico</label>
                    <input type="email" name="email" required placeholder="tu@correo.com">
                </div>

                <button type="submit" class="btn-recover">Enviar Instrucciones</button>
            </form>

            <a href="{{ route('login') }}" class="back-link">← Volver al inicio de sesión</a>
        </div>
    </div>
</div>

</body>
</html>
