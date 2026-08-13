<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retos Ecológicos - Bioeducando</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #f0fdf4; min-min-height: 100vh; }

        /* Header público */
        .retos-header {
            background: linear-gradient(135deg, #1a3a2a 0%, #2d5a3d 100%);
            padding: 25px 40px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }
        .retos-header h1 { font-size: 1.6rem; font-weight: 700; display: flex; align-items: center; gap: 12px; }
        .header-actions { display: flex; align-items: center; gap: 15px; }
        .header-btn {
            background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3); color: white;
            padding: 8px 18px; border-radius: 20px; text-decoration: none;
            font-size: 0.85rem; font-weight: 600; transition: 0.3s;
            display: flex; align-items: center; gap: 6px;
        }
        .header-btn:hover { background: rgba(255,255,255,0.25); }

        .container { padding: 40px; max-width: 1200px; margin: 0; }
        .retos-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px; justify-content: start; }
        .reto-card { background: white; border-radius: 25px; padding: 30px; position: relative; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border-left: 8px solid #6ab06a; transition: 0.3s; display: flex; flex-direction: column; justify-content: space-between; min-height: 350px; }
        .reto-card:hover { transform: translateY(-5px); box-shadow: 0 15px 40px rgba(0,0,0,0.1); }
        .mission-tag { font-size: 0.7rem; font-weight: 800; color: #6ab06a; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 10px; display: block; }
        .reto-title { font-size: 1.6rem; color: #1a3a2a; font-weight: 800; margin-bottom: 15px; }
        .reto-stats { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 20px; }
        .stat-badge { background: #f0fdf4; color: #166534; padding: 5px 12px; border-radius: 10px; font-size: 0.8rem; font-weight: 700; display: flex; align-items: center; gap: 5px; }
        .reto-desc { color: #64748b; line-height: 1.5; margin-bottom: 25px; font-size: 0.95rem; }
        .btn-aceptar { background-color: #3d5a44; color: white; padding: 12px 20px; border-radius: 15px; text-decoration: none; font-weight: 700; font-size: 0.95rem; transition: 0.3s; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; justify-content: center; }
        .btn-aceptar:hover { background-color: #1a3a2a; transform: scale(1.05); }
        .insignia-icon { position: absolute; top: 20px; right: 20px; opacity: 0.1; }
        @media (max-width: 768px) {
            .retos-header {
                padding: 15px 20px;
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .retos-header h1 {
                font-size: 1.2rem;
            }

            .header-actions {
                flex-wrap: wrap;
                width: 100%;
            }

            .container {
                padding: 20px 15px;
            }

            .retos-grid {
                gap: 20px;
                grid-template-columns: 1fr;
            }

            .reto-card {
                padding: 20px;
                min-height: auto;
                border-left: 6px solid #6ab06a;
            }

            .reto-title {
                font-size: 1.2rem;
            }

            .reto-desc {
                font-size: 0.9rem;
            }

            .btn-aceptar {
                padding: 10px 16px;
                font-size: 0.9rem;
            }

            .insignia-icon {
                width: 40px;
                height: 40px;
            }
        }
    </style>
</head>
<body>
    <div class="retos-header">
        <h1><i data-lucide="leaf"></i> Retos Ecológicos</h1>
        <div class="header-actions">
            @auth
            <a href="{{ route('retos.usuario') }}" class="header-btn"><i data-lucide="layout-dashboard" size="16"></i> Mi Panel</a>
            @else
            <a href="{{ route('login') }}" class="header-btn"><i data-lucide="log-in" size="16"></i> Ingresar</a>
            @endauth
        </div>
    </div>

    <div class="container">
        <div class="retos-grid">
            @foreach($retos as $reto)
            <div class="reto-card" style="cursor: default;">
                <i data-lucide="award" class="insignia-icon" size="48"></i>
                <div>
                    <span class="mission-tag">Misión {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <h3 class="reto-title">{{ $reto->titulo }}</h3>
                    <div class="reto-stats">
                        <div class="stat-badge"><i data-lucide="clock" size="14"></i> {{ $reto->duracion }}</div>
                        <div class="stat-badge"><i data-lucide="bar-chart" size="14"></i> {{ ucfirst($reto->dificultad) }}</div>
                        <div class="stat-badge"><i data-lucide="tag" size="14"></i> {{ ucfirst($reto->categoria) }}</div>
                    </div>
                    <p class="reto-desc">{{ $reto->descripcion }}</p>
                </div>
                <div style="display: flex; justify-content: center; margin-top: 20px;">
                    <a href="{{ route('login') }}" class="btn-aceptar">Dar inicio al reto <i data-lucide="play" size="16"></i></a>
                </div>
            </div>
            @endforeach
        </div>
        @if($retos->isEmpty())
            <div style="text-align: center; padding: 100px; color: #1a3a2a;"><i data-lucide="leaf" size="60" style="margin-bottom: 20px; opacity: 0.5;"></i><h2 style="font-size: 1.5rem; font-weight: 800;">No hay retos activos en este momento</h2><p style="margin-top: 10px; opacity: 0.7;">¡Vuelve pronto para nuevas misiones ecológicas!</p></div>
        @endif
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
