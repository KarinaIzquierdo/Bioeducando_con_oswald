<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar PRAE - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { display: flex; height: 100vh; background-color: #f4f7f4; }
        .sidebar { width: 260px; background-color: #6ab06a; display: flex; flex-direction: column; padding: 20px; }
        .admin-title { font-size: 2rem; font-weight: 600; color: #000; margin-bottom: 40px; text-align: center; width: 100%; }
        .menu-item { display: flex; align-items: center; padding: 12px 15px; color: white; text-decoration: none; margin-bottom: 10px; border-radius: 10px; transition: 0.3s; }
        .menu-item i { margin-right: 12px; }
        .menu-item.active { background-color: #3d5a44; }
        .main-content { flex: 1; display: flex; flex-direction: column; overflow-y: auto; }
        .top-bar { height: 80px; background-color: #744d2d; display: flex; align-items: center; padding: 0 40px; color: white; justify-content: space-between; }
        .content-padding { padding: 40px; }
        .btn-add { background: white; color: #744d2d; border: none; padding: 10px 20px; border-radius: 12px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .proyectos-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 25px; }
        .proyecto-card { background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.05); transition: 0.3s; }
        .proyecto-img { width: 100%; height: 180px; object-fit: cover; }
        .proyecto-info { padding: 20px; }
        .proyecto-inst { font-size: 0.75rem; font-weight: 800; color: #6ab06a; text-transform: uppercase; }
        .proyecto-title { font-size: 1.2rem; font-weight: 700; margin: 10px 0; color: #333; }
        .actions { display: flex; gap: 10px; margin-top: 20px; }
        .btn-edit { flex: 1; padding: 10px; background: #f0f0f0; border-radius: 10px; text-align: center; text-decoration: none; color: #444; font-weight: 600; }
        .btn-delete { padding: 10px; background: #fee2e2; border: none; border-radius: 10px; color: #ef4444; cursor: pointer; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h1 class="admin-title">Admin</h1>
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="menu-item"><i data-lucide="layout-dashboard"></i> Dashboard</a>
            <a href="{{ route('usuarios.index') }}" class="menu-item"><i data-lucide="users"></i> Usuarios</a>
            <a href="{{ route('admin.retos') }}" class="menu-item"><i data-lucide="leaf"></i> Retos Ecológicos</a>
            <a href="{{ route('admin.comunidad') }}" class="menu-item"><i data-lucide="flower-2"></i> Comunidad Ambiental</a>
            <a href="{{ route('admin.steam.index') }}" class="menu-item"><i data-lucide="microscope"></i> Gestionar STEAM</a>
            <a href="{{ route('admin.prae.index') }}" class="menu-item active"><i data-lucide="book-open"></i> Gestionar PRAE</a>
        </nav>
    </div>

    <div class="main-content">
        <div class="top-bar">
            <span>Gestión de Proyectos PRAE</span>
            <a href="{{ route('admin.prae.create') }}" class="btn-add">
                <i data-lucide="plus-circle"></i> Nuevo Proyecto
            </a>
        </div>

        <div class="content-padding">
            @if(session('success'))
                <div style="background: #dcfce7; color: #15803d; padding: 15px; border-radius: 12px; margin-bottom: 20px;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="proyectos-grid">
                @foreach($proyectos as $proyecto)
                <div class="proyecto-card">
                    @if($proyecto->imagen)
                        <img src="{{ asset('storage/' . $proyecto->imagen) }}" class="proyecto-img">
                    @else
                        <div style="height: 180px; background: #eee; display: flex; align-items: center; justify-content: center;">
                            <i data-lucide="image" size="40" color="#ccc"></i>
                        </div>
                    @endif
                    <div class="proyecto-info">
                        <span class="proyecto-inst">{{ $proyecto->institucion }}</span>
                        <h3 class="proyecto-title">{{ $proyecto->titulo }}</h3>
                        <div class="actions">
                            <a href="{{ route('admin.prae.edit', $proyecto->id) }}" class="btn-edit">
                                <i data-lucide="edit-3" size="16"></i> Editar
                            </a>
                            <form action="{{ route('admin.prae.destroy', $proyecto->id) }}" method="POST" onsubmit="return confirm('¿Eliminar proyecto?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-delete"><i data-lucide="trash-2" size="16"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>lucide.createIcons();</script>
</body>
</html>
