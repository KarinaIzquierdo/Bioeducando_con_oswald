<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Arial', sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 20px auto; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .header { background: #1a3a2a; padding: 30px; text-align: center; }
        .content { padding: 40px; text-align: center; color: #333; }
        h1 { color: #1a3a2a; font-size: 24px; margin-bottom: 20px; }
        p { line-height: 1.6; margin-bottom: 30px; }
        .btn { display: inline-block; padding: 15px 30px; background: #6ab06a; color: white !important; text-decoration: none; border-radius: 50px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; }
        .footer { background: #f9f9f9; padding: 20px; text-align: center; font-size: 12px; color: #777; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2 style="color: white; margin: 0;">Bioeducando con Oswald</h2>
        </div>
        <div class="content">
            <h1>¿Restablecer tu contraseña?</h1>
            <p>Hola, recibimos una solicitud para restablecer la contraseña de tu cuenta. Si no hiciste esta solicitud, puedes ignorar este correo.</p>
            <p>Para elegir una nueva contraseña, haz clic en el siguiente botón:</p>
            
            <a href="{{ url('/restablecer/'.$token.'?email='.$email) }}" class="btn">Restablecer Contraseña</a>
            
            <p style="margin-top: 30px; font-size: 13px; color: #999;">Este enlace expirará en 60 minutos por tu seguridad.</p>
        </div>
        <div class="footer">
            © {{ date('Y') }} Bioeducando con Oswald. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>
