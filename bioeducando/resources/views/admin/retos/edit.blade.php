<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Misión - Bioeducando</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { display: flex; height: 100vh; background-color: #f4f7f4; }

        /* Sidebar similar a los anteriores */
        .sidebar { width: 260px; background-color: #6ab06a; display: flex; flex-direction: column; padding: 20px; }
        .admin-title { font-size: 2rem; font-weight: 400; color: #000; margin-bottom: 40px; }
        .menu-item { display: flex; align-items: center; padding: 12px 15px; color: white; text-decoration: none; margin-bottom: 10px; border-radius: 10px; transition: 0.3s; }
        .menu-item i { margin-right: 12px; }
        .menu-item.active { background-color: #3d5a44; }
        .sidebar-footer { margin-top: auto; text-align: center; }
        .sidebar-logo { width: 140px; filter: brightness(0); margin-bottom: 20px; }

        .btn-logout {
            width: 100%;
            padding: 12px;
            background-color: black;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-weight: 600;
            transition: 0.3s;
            margin-top: 10px;
            text-transform: lowercase;
        }
        .btn-logout:hover {
            background-color: #333;
        }

        /* Contenido */
        .main-content { flex: 1; display: flex; flex-direction: column; overflow-y: auto; }
        .top-bar { height: 80px; background-color: #744d2d; display: flex; align-items: center; padding: 0 40px; color: white; }
        
        .content-padding { padding: 40px; max-width: 800px; margin: 0 auto; width: 100%; }
        
        .form-card {
            background: white;
            padding: 40px;
            border-radius: 24px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        .form-header { margin-bottom: 30px; border-bottom: 2px solid #f0f0f0; padding-bottom: 20px; }
        .form-header h2 { color: #1a3a2a; font-size: 1.8rem; display: flex; align-items: center; gap: 12px; }

        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-weight: 600; color: #444; margin-bottom: 8px; font-size: 0.95rem; }
        
        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            transition: 0.3s;
            outline: none;
        }
        .form-control:focus { border-color: #6ab06a; box-shadow: 0 0 0 4px rgba(106, 176, 106, 0.1); }
        
        textarea.form-control { height: 120px; resize: none; }

        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

        .checkbox-group {
            background: #f8faf8;
            padding: 15px;
            border-radius: 12px;
            margin-top: 10px;
        }
        .checkbox-item { display: flex; align-items: center; gap: 10px; margin-bottom: 8px; cursor: pointer; }
        .checkbox-item input { width: 18px; height: 18px; accent-color: #6ab06a; }

        .btn-submit {
            background: #6ab06a;
            color: white;
            width: 100%;
            padding: 16px;
            border: none;
            border-radius: 14px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .btn-submit:hover { background: #5aa05a; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(106, 176, 106, 0.3); }

        .back-link { display: flex; align-items: center; gap: 5px; color: #666; text-decoration: none; margin-bottom: 20px; font-weight: 600; }
        .back-link:hover { color: #6ab06a; }
    </style>
</head>
<body>

    <div class="sidebar">
        <h1 class="admin-title">Admin panel</h1>
        <nav>
            <a href="{{ route('usuarios.index') }}" class="menu-item">
                <i data-lucide="users"></i> Usuarios
            </a>
            <a href="{{ route('admin.retos') }}" class="menu-item active">
                <i data-lucide="leaf"></i> Retos ecológicos
            </a>
            <a href="{{ route('admin.comunidad') }}" class="menu-item">
                <i data-lucide="flower-2"></i> Comunidad ambiental
            </a>
        </nav>
        <div class="sidebar-footer">
            <img src="/imagenes/Logo.svg" alt="Logo" class="sidebar-logo">
        </div>
    </div>

    <div class="main-content">
        <div class="top-bar">
            <span>Bioeducando con Oswald - Gestión de Retos</span>
        </div>

        <div class="content-padding">
            <a href="{{ route('admin.retos') }}" class="back-link">
                <i data-lucide="chevron-left" size="20"></i> Volver a retos
            </a>

            <div class="form-card">
                <div class="form-header">
                    <h2><i data-lucide="edit-3"></i> Editar misión</h2>
                </div>

                <form action="{{ route('admin.retos.update', $reto->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label>Título</label>
                        <input type="text" class="form-control" name="titulo" value="{{ old('titulo', $reto->titulo) }}" placeholder="Ej: Clasificador experto">
                    </div>

                    <div class="form-group">
                        <label>Descripción</label>
                        <textarea class="form-control" name="descripcion" placeholder="Escribe aquí los detalles de la misión...">{{ old('descripcion', $reto->descripcion) }}</textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Estado</label>
                            <select class="form-control" name="estado">
                                <option value="activa" {{ $reto->estado == 'activa' ? 'selected' : '' }}>Activa ▼</option>
                                <option value="inactiva" {{ $reto->estado == 'inactiva' ? 'selected' : '' }}>Inactiva</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Categoría</label>
                            <select class="form-control" name="categoria">
                                <option value="reciclaje" {{ $reto->categoria == 'reciclaje' ? 'selected' : '' }}>Reciclaje ▼</option>
                                <option value="agua" {{ $reto->categoria == 'agua' ? 'selected' : '' }}>Cuidado del Agua</option>
                                <option value="energia" {{ $reto->categoria == 'energia' ? 'selected' : '' }}>Ahorro de Energía</option>
                                <option value="biodiversidad" {{ $reto->categoria == 'biodiversidad' ? 'selected' : '' }}>Biodiversidad</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Dificultad</label>
                            <select class="form-control" name="dificultad">
                                <option value="facil" {{ $reto->dificultad == 'facil' ? 'selected' : '' }}>Fácil</option>
                                <option value="intermedio" {{ $reto->dificultad == 'intermedio' ? 'selected' : '' }}>Intermedio ▼</option>
                                <option value="dificil" {{ $reto->dificultad == 'dificil' ? 'selected' : '' }}>Difícil</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Puntos</label>
                            <input type="number" class="form-control" name="puntos" value="{{ old('puntos', $reto->puntos) }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Duración</label>
                            <input type="text" class="form-control" name="duracion" value="{{ old('duracion', $reto->duracion) }}">
                        </div>
                        <div class="form-group">
                            <label>Insignia</label>
                            <select class="form-control" name="insignia">
                                <option value="experto" {{ $reto->insignia == 'experto' ? 'selected' : '' }}>Reciclador Experto ▼</option>
                                <option value="guardian" {{ $reto->insignia == 'guardian' ? 'selected' : '' }}>Guardián del Bosque</option>
                                <option value="maestro" {{ $reto->insignia == 'maestro' ? 'selected' : '' }}>Maestro Ambiental</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Evidencia requerida</label>
                        <div class="checkbox-group">
                            @php
                                $evidencias = is_array($reto->evidencias) ? $reto->evidencias : [];
                            @endphp
                            <label class="checkbox-item">
                                <input type="checkbox" name="evidencias[]" value="foto" {{ in_array('foto', $evidencias) ? 'checked' : '' }}>
                                <span>Foto</span>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="evidencias[]" value="reflexion" {{ in_array('reflexion', $evidencias) ? 'checked' : '' }}>
                                <span>Reflexión</span>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="evidencias[]" value="video" {{ in_array('video', $evidencias) ? 'checked' : '' }}>
                                <span>Video</span>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">
                        <i data-lucide="save"></i> Guardar cambios
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
