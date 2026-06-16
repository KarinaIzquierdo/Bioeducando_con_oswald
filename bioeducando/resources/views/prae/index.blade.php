<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRAE - Bioeducando</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #f8fafc; color: #1e293b; }
        
        .navbar { background: #6ab06a; padding: 15px 40px; display: flex; justify-content: space-between; align-items: center; color: white; position: sticky; top: 0; z-index: 1000; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .nav-brand { font-size: 1.5rem; font-weight: 700; display: flex; align-items: center; gap: 10px; }
        .nav-links { display: flex; gap: 25px; }
        .nav-links a { color: white; text-decoration: none; font-weight: 600; font-size: 0.95rem; transition: 0.3s; }
        .nav-links a:hover { opacity: 0.8; }

        .container { max-width: 1000px; margin: 40px auto; padding: 0 20px; }
        
        .hero-prae { background: linear-gradient(135deg, #1a3a2a 0%, #3d5a44 100%); padding: 60px; border-radius: 30px; color: white; margin-bottom: 40px; text-align: center; }
        .hero-prae h1 { font-size: 2.5rem; margin-bottom: 15px; }
        .hero-prae p { font-size: 1.1rem; opacity: 0.9; max-width: 700px; margin: 0 auto; }

        .section-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 30px; }
        
        .card { background: white; padding: 30px; border-radius: 24px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); margin-bottom: 30px; }
        .section-title { font-size: 1.4rem; color: #1a3a2a; font-weight: 700; margin-bottom: 20px; display: flex; align-items: center; gap: 12px; }
        .section-title i { color: #6ab06a; }

        .info-content { line-height: 1.7; color: #475569; }
        .info-content h3 { color: #1a3a2a; margin: 20px 0 10px; }

        .activity-item { padding: 15px; border-left: 4px solid #6ab06a; background: #f8fafc; border-radius: 0 12px 12px 0; margin-bottom: 15px; }
        .activity-item.finalizada { border-left-color: #94a3b8; opacity: 0.8; }
        .activity-date { font-size: 0.8rem; font-weight: 700; color: #6ab06a; text-transform: uppercase; }
        .activity-title { font-weight: 700; font-size: 1.05rem; margin: 5px 0; color: #1a3a2a; }
        .activity-desc { font-size: 0.9rem; color: #64748b; }

        .doc-item { display: flex; align-items: center; gap: 15px; padding: 15px; background: #f1f5f9; border-radius: 15px; text-decoration: none; color: #1e293b; transition: 0.3s; margin-bottom: 10px; }
        .doc-item:hover { background: #e2e8f0; transform: translateX(5px); }
        .doc-icon { width: 40px; height: 40px; background: white; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #6ab06a; }
        .doc-info span { display: block; font-weight: 700; font-size: 0.9rem; }
        .doc-info small { font-size: 0.75rem; color: #64748b; }

        @media (max-width: 768px) { .section-grid { grid-template-columns: 1fr; } .hero-prae { padding: 40px 20px; } }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-brand">
            <i data-lucide="leaf"></i> Bioeducando
        </div>
        <div class="nav-links">
            <a href="{{ route('dashboard') }}">Inicio</a>
            <a href="{{ route('comunidad.publica') }}">Comunidad</a>
            <a href="{{ route('steam.proyectos') }}">STEAM</a>
            <a href="{{ route('prae.proyectos') }}">PRAE</a>
            <a href="{{ route('profile.edit') }}">Mi Perfil</a>
        </div>
    </nav>

    <div class="container">
        <div class="hero-prae">
            <h1>Proyecto Ambiental Escolar (PRAE)</h1>
            <p>Transformando nuestra institución a través de la conciencia y la acción ecológica.</p>
        </div>

        <div class="section-grid">
            <div class="main-info">
                <!-- 1. ¿Qué es el PRAE? -->
                <div class="card">
                    <h2 class="section-title"><i data-lucide="info"></i> ¿Qué es el PRAE?</h2>
                    <div class="info-content">
                        <p>{{ $info->descripcion ?? 'La información sobre el PRAE se está actualizando. Pronto conocerás más sobre nuestro proyecto ambiental institucional.' }}</p>
                    </div>
                </div>

                <!-- 2. Objetivos -->
                <div class="card">
                    <h2 class="section-title"><i data-lucide="target"></i> Nuestros Objetivos</h2>
                    <div class="info-content">
                        <p>{{ $info->objetivos ?? 'Los objetivos del PRAE estarán disponibles próximamente.' }}</p>
                    </div>
                </div>

                <!-- 3. Actividades -->
                <div class="card">
                    <h2 class="section-title"><i data-lucide="calendar"></i> Cronograma Ambiental</h2>
                    
                    @if($actividadesProximas->isNotEmpty())
                        <h3 style="font-size: 0.9rem; color: #64748b; text-transform: uppercase; margin-bottom: 15px;">Próximas Actividades</h3>
                        @foreach($actividadesProximas as $act)
                            <div class="activity-item">
                                <div class="activity-date">{{ \Carbon\Carbon::parse($act->fecha)->format('d M, Y') }}</div>
                                <div class="activity-title">{{ $act->titulo }}</div>
                                <div class="activity-desc">{{ $act->descripcion }}</div>
                            </div>
                        @endforeach
                    @endif

                    @if($actividadesRealizadas->isNotEmpty())
                        <h3 style="font-size: 0.9rem; color: #64748b; text-transform: uppercase; margin: 25px 0 15px;">Actividades Realizadas</h3>
                        @foreach($actividadesRealizadas as $act)
                            <div class="activity-item finalizada">
                                <div class="activity-date">{{ \Carbon\Carbon::parse($act->fecha)->format('d M, Y') }}</div>
                                <div class="activity-title">{{ $act->titulo }}</div>
                                <div class="activity-desc">{{ $act->descripcion }}</div>
                            </div>
                        @endforeach
                    @endif

                    @if($actividadesProximas->isEmpty() && $actividadesRealizadas->isEmpty())
                        <p style="color: #64748b; font-style: italic;">No hay actividades registradas actualmente.</p>
                    @endif
                </div>
            </div>

            <div class="sidebar-info">
                <!-- 4. Documentos y Guías -->
                <div class="card">
                    <h2 class="section-title"><i data-lucide="file-text"></i> Documentos</h2>
                    @forelse($documentos as $doc)
                        <a href="{{ asset('storage/' . $doc->archivo_path) }}" class="doc-item" target="_blank">
                            <div class="doc-icon"><i data-lucide="download"></i></div>
                            <div class="doc-info">
                                <span>{{ $doc->titulo }}</span>
                                <small>PDF para descargar</small>
                            </div>
                        </a>
                    @empty
                        <p style="color: #64748b; font-style: italic; font-size: 0.9rem;">No hay documentos disponibles.</p>
                    @endforelse
                </div>

                <div class="card" style="background: #f0fdf4; border: 1px solid #dcfce7;">
                    <h3 style="color: #166534; font-size: 1.1rem; margin-bottom: 10px;">¿Tienes una duda?</h3>
                    <p style="font-size: 0.85rem; color: #166534; line-height: 1.5;">Si necesitas más información sobre el PRAE o quieres participar en una actividad, contacta al comité ambiental de la institución.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
