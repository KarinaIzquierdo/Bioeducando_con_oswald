<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar PRAE - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { display: flex; height: 100vh; background-color: #f4f7f4; }
        
        /* Sidebar */
        .sidebar { width: 260px; background-color: #6ab06a; display: flex; flex-direction: column; padding: 20px; }
        .admin-title { font-size: 2rem; font-weight: 600; color: #000; margin-bottom: 40px; text-align: center; width: 100%; }
        .menu-item { display: flex; align-items: center; padding: 12px 15px; color: white; text-decoration: none; margin-bottom: 10px; border-radius: 10px; transition: 0.3s; }
        .menu-item i { margin-right: 12px; }
        .menu-item.active { background-color: #3d5a44; }
        
        .sidebar-footer {
            margin-top: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            padding: 20px 0;
            width: 100%;
        }
        .sidebar-logo { width: 140px; filter: brightness(0); margin-bottom: 5px; }
        .btn-logout {
            width: 100%;
            padding: 12px;
            background-color: #3d5a44;
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
            font-size: 0.95rem;
        }
        .btn-logout:hover { background-color: #2d4433; }

        /* Contenido */
        .main-content { flex: 1; display: flex; flex-direction: column; overflow-y: auto; }
        .top-bar { height: 80px; background-color: #744d2d; display: flex; align-items: center; padding: 0 40px; color: white; }
        .content-padding { padding: 40px; }
        
        .section-card { background: white; border-radius: 20px; padding: 30px; margin-bottom: 30px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
        .section-title { font-size: 1.5rem; color: #1a3a2a; font-weight: 700; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
        
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-weight: 600; color: #444; margin-bottom: 8px; }
        .form-control { width: 100%; padding: 12px; border: 2px solid #e2e8f0; border-radius: 12px; font-size: 1rem; outline: none; transition: 0.3s; }
        .form-control:focus { border-color: #6ab06a; }
        
        .btn-save { background: #6ab06a; color: white; padding: 12px 25px; border: none; border-radius: 12px; font-weight: 600; cursor: pointer; transition: 0.3s; }
        .btn-save:hover { background: #5aa05a; }
        
        .btn-delete { color: #ef4444; background: none; border: none; cursor: pointer; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { text-align: left; padding: 15px; color: #64748b; font-size: 0.85rem; text-transform: uppercase; border-bottom: 2px solid #f1f5f9; }
        td { padding: 15px; border-bottom: 1px solid #f1f5f9; color: #334155; }
        
        .badge { padding: 5px 12px; border-radius: 50px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; }
        .badge-proxima { background: #fef9c3; color: #854d0e; }
        .badge-finalizada { background: #dcfce7; color: #166534; }

        .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); align-items: center; justify-content: center; }
        .modal-content { background: white; padding: 30px; border-radius: 20px; width: 100%; max-width: 500px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h1 class="admin-title">Admin</h1>
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="menu-item {{ Request::is('admin') ? 'active' : '' }}">
                <i data-lucide="layout-dashboard"></i> Dashboard
            </a>
            <a href="{{ route('usuarios.index') }}" class="menu-item {{ Request::is('admin/usuarios*') ? 'active' : '' }}">
                <i data-lucide="users"></i> Usuarios
            </a>
            <a href="{{ route('admin.retos') }}" class="menu-item {{ Request::is('admin/retos*') ? 'active' : '' }}">
                <i data-lucide="leaf"></i> Retos Ecológicos
            </a>
            <a href="{{ route('admin.comunidad_activa') }}" class="menu-item {{ Request::is('admin/comunidad-activa*') ? 'active' : '' }}">
                <i data-lucide="flower-2"></i> Comunidad Activa
            </a>
            <a href="{{ route('admin.steam.index') }}" class="menu-item {{ Request::is('admin/steam*') ? 'active' : '' }}">
                <i data-lucide="microscope"></i> Gestionar STEAM
            </a>
            <a href="{{ route('admin.prae.index') }}" class="menu-item {{ Request::is('admin/prae*') ? 'active' : '' }}">
                <i data-lucide="book-open"></i> Gestionar PRAE
            </a>
            <a href="#" class="menu-item">
                <i data-lucide="settings"></i> Configuración
            </a>
        </nav>
        <div class="sidebar-footer">
            <img src="/imagenes/Logo.svg" alt="Logo" class="sidebar-logo">
            <form action="{{ route('logout') }}" method="POST" style="width: 100%;">
                @csrf
                <button type="submit" class="btn-logout">
                    <i data-lucide="log-out"></i> Cerrar Sesión
                </button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <div class="top-bar">Bioeducando con Oswald - Gestión del PRAE</div>
        
        <div class="content-padding">
            @if(session('success'))
                <div style="background: #dcfce7; color: #15803d; padding: 15px; border-radius: 12px; margin-bottom: 20px;">
                    {{ session('success') }}
                </div>
            @endif

            <!-- 1. Información del PRAE -->
            <div class="section-card">
                <h2 class="section-title"><i data-lucide="info"></i> Información del PRAE</h2>
                <form action="{{ route('admin.prae.updateInfo') }}" method="POST">
                    @csrf @method('PUT')
                    <div class="form-group">
                        <label>Descripción General</label>
                        <textarea name="descripcion" class="form-control" rows="4" required>{{ $info->descripcion ?? '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Objetivos del Proyecto</label>
                        <textarea name="objetivos" class="form-control" rows="4" required>{{ $info->objetivos ?? '' }}</textarea>
                    </div>
                    <button type="submit" class="btn-save">Guardar Información</button>
                </form>
            </div>

            <!-- 2. Actividades Ambientales -->
            <div class="section-card">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h2 class="section-title" style="margin-bottom: 0;"><i data-lucide="calendar"></i> Actividades</h2>
                    <button class="btn-save" onclick="openModal('actividadModal')">Nueva Actividad</button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($actividades as $actividad)
                        <tr>
                            <td>{{ $actividad->titulo }}</td>
                            <td>{{ \Carbon\Carbon::parse($actividad->fecha)->format('d/m/Y') }}</td>
                            <td><span class="badge badge-{{ $actividad->estado }}">{{ $actividad->estado }}</span></td>
                            <td>
                                <form action="{{ route('admin.prae.destroyActividad', $actividad->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('¿Eliminar actividad?')">
                                        <i data-lucide="trash-2" size="18"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- 3. Documentos -->
            <div class="section-card">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h2 class="section-title" style="margin-bottom: 0;"><i data-lucide="file-text"></i> Documentos y Guías</h2>
                    <button class="btn-save" onclick="openModal('documentoModal')">Subir Documento</button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Fecha Subida</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($documentos as $doc)
                        <tr>
                            <td>{{ $doc->titulo }}</td>
                            <td>{{ $doc->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div style="display: flex; gap: 10px;">
                                    <a href="{{ asset('storage/' . $doc->archivo_path) }}" target="_blank" style="color: #6ab06a;"><i data-lucide="download" size="18"></i></a>
                                    <form action="{{ route('admin.prae.destroyDocumento', $doc->id) }}" method="POST" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-delete" onclick="return confirm('¿Eliminar documento?')">
                                            <i data-lucide="trash-2" size="18"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modales -->
    <div id="actividadModal" class="modal">
        <div class="modal-content">
            <h2 class="section-title">Nueva Actividad</h2>
            <form action="{{ route('admin.prae.storeActividad') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Título</label>
                    <input type="text" name="titulo" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label>Fecha</label>
                    <input type="date" name="fecha" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Estado</label>
                    <select name="estado" class="form-control">
                        <option value="proxima">Próxima</option>
                        <option value="finalizada">Finalizada</option>
                    </select>
                </div>
                <div style="display: flex; gap: 10px; justify-content: flex-end;">
                    <button type="button" class="btn-save" style="background: #ccc;" onclick="closeModal('actividadModal')">Cancelar</button>
                    <button type="submit" class="btn-save">Crear Actividad</button>
                </div>
            </form>
        </div>
    </div>

    <div id="documentoModal" class="modal">
        <div class="modal-content">
            <h2 class="section-title">Subir Documento (PDF)</h2>
            <form action="{{ route('admin.prae.storeDocumento') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Título del Documento</label>
                    <input type="text" name="titulo" class="form-control" placeholder="Ej: Proyecto PRAE 2026" required>
                </div>
                <div class="form-group">
                    <label>Archivo PDF</label>
                    <input type="file" name="archivo" class="form-control" accept="application/pdf" required>
                </div>
                <div style="display: flex; gap: 10px; justify-content: flex-end;">
                    <button type="button" class="btn-save" style="background: #ccc;" onclick="closeModal('documentoModal')">Cancelar</button>
                    <button type="submit" class="btn-save">Subir</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        lucide.createIcons();
        function openModal(id) { document.getElementById(id).style.display = 'flex'; }
        function closeModal(id) { document.getElementById(id).style.display = 'none'; }
    </script>
</body>
</html>
