<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Usuario - Bioeducando</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background: linear-gradient(135deg, #1a3a2a, #0a1a10); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }

        .form-card {
            background: #ededed;
            width: 100%;
            max-width: 500px;
            padding: 40px;
            border-radius: 40px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.3);
        }

        .header { text-align: center; margin-bottom: 30px; }
        .header h2 { color: #333; font-size: 1.8rem; margin-top: 10px; }
        .icon-circle { width: 80px; height: 80px; background: #6ab06a; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; color: white; }

        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; margin-left: 15px; color: #444; font-weight: 600; font-size: 0.9rem; }
        
        .form-group input, .form-group select {
            width: 100%;
            padding: 15px 25px;
            border-radius: 20px;
            border: 2px solid transparent;
            background: white;
            outline: none;
            font-size: 1rem;
            transition: 0.3s;
        }

        .form-group input:focus, .form-group select:focus { border-color: #6ab06a; }

        .btn-submit {
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
            transition: 0.3s;
            margin-top: 10px;
        }

        .btn-submit:hover { background: #5aa05a; transform: translateY(-2px); }

        .back-link { display: block; text-align: center; margin-top: 20px; color: #666; text-decoration: none; font-size: 0.9rem; font-weight: 600; }
        .back-link:hover { color: #6ab06a; }

        .error-msg { color: #b91c1c; font-size: 0.8rem; margin-top: 5px; margin-left: 15px; }
    </style>
</head>
<body>

<div class="form-card">
    <div class="header">
        <div class="icon-circle">
            <i data-lucide="user-plus" size="40"></i>
        </div>
        <h2>Nuevo Usuario</h2>
    </div>

    <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nombre Completo</label>
            <input type="text" name="name" required value="{{ old('name') }}" placeholder="Nombre del usuario">
            @error('name') <p class="error-msg">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label>Correo Electrónico</label>
            <input type="email" name="email" required value="{{ old('email') }}" placeholder="correo@ejemplo.com">
            @error('email') <p class="error-msg">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="password" required placeholder="Mínimo 8 caracteres">
            @error('password') <p class="error-msg">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label>Rol del Usuario</label>
            <select name="role_id" required>
                <option value="">Seleccione un rol</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                @endforeach
            </select>
            @error('role_id') <p class="error-msg">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="btn-submit">Guardar Usuario</button>
    </form>

    <a href="{{ route('admin.dashboard') }}" class="back-link">← Cancelar y volver</a>
</div>

<script>
    lucide.createIcons();
</script>

</body>
</html>
