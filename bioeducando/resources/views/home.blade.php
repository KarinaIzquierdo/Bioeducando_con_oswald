<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bioeducando con Oswald - Inicio</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body, html {
            min-height: 100%;
            overflow-x: hidden;
        }

        /* Navbar Superior */
        .navbar {
            background-color: #3d5a44;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 50px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .search-container {
            position: relative;
            width: 320px;
        }

        .search-container input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border-radius: 30px;
            border: none;
            background-color: #f0f0f0;
            font-size: 1.1rem;
            outline: none;
        }

        .search-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
            width: 20px;
            height: 20px;
        }

        .nav-links {
            display: flex;
            gap: 50px;
            align-items: center;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            font-size: 1.3rem;
            transition: 0.3s;
        }

        .nav-links a:hover {
            opacity: 0.8;
        }

        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            cursor: pointer;
            font-size: 1.3rem;
            font-weight: 500;
        }

        /* Fondo Principal */
        .hero-section {
            height: 100vh;
            background-image: url('/imagenes/fondoinicio.png');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .background-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
        }

        .logo-container {
            margin-bottom: 30px;
        }

        .main-logo {
            width: 280px;
            height: auto;
        }

        .btn-comenzar {
            background-color: #3d5a44;
            color: white;
            padding: 15px 60px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 2.5rem;
            font-weight: 600;
            transition: 0.3s;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            border: none;
            cursor: pointer;
            display: inline-block;
        }

        .btn-comenzar:hover {
            background-color: #2d4433;
            transform: scale(1.05);
        }

        .tagline {
            font-size: 3.2rem;
            font-weight: 600;
            color: white;
            margin-top: 60px;
            letter-spacing: 6px;
            opacity: 0.95;
            text-transform: uppercase;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.45);
            z-index: 1;
        }

        .content-wrapper {
            position: relative;
            z-index: 2;
        }
        @media (max-width: 768px) {
            .navbar {
                padding: 15px 20px;
                flex-direction: column;
                gap: 15px;
                height: auto;
            }

            .search-container {
                width: 100%;
                max-width: 320px;
            }

            .nav-links {
                gap: 20px;
                flex-wrap: wrap;
                justify-content: center;
            }

            .nav-links a {
                font-size: 1rem;
            }

            .hero-section {
                min-height: 100vh;
                height: auto;
                padding: 140px 20px 60px;
            }

            .main-logo {
                width: 180px;
            }

            .btn-comenzar {
                font-size: 1.6rem;
                padding: 12px 40px;
            }

            .tagline {
                font-size: 1.6rem;
                letter-spacing: 2px;
                margin-top: 40px;
            }
        }

        @media (max-width: 480px) {
            .nav-links {
                gap: 12px;
            }

            .nav-links a {
                font-size: 0.9rem;
            }

            .main-logo {
                width: 150px;
            }

            .btn-comenzar {
                font-size: 1.3rem;
                padding: 10px 30px;
            }

            .tagline {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <form action="{{ route('search') }}" method="GET" class="search-container">
            <i data-lucide="search" class="search-icon"></i>
            <input type="text" name="query" placeholder="Buscar">
        </form>

        <div class="nav-links">
            <a href="{{ route('comunidad.publica') }}">Comunidad Ambiental</a>
            <a href="{{ route('noticias.publica') }}">Noticias Ambientales</a>
            <a href="{{ route('retos.publica') }}">Retos Ecológicos</a>
        </div>
    </nav>

    <div class="hero-section">
        <!-- Video de fondo para computadoras -->
        <video autoplay muted loop playsinline class="background-video">
            <source src="/imagenes/fondoinicio.mp4" type="video/mp4">
        </video>
        
        <div class="content-wrapper">
            <div class="logo-container">
                <img src="/imagenes/Logo.svg" alt="Bioeducando Logo" class="main-logo">
            </div>
            
            <a href="{{ route('login') }}" class="btn-comenzar">Comenzar</a>
            <p class="tagline">todo empieza desde casa</p>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
