<?php

// public/deploy.php - Despliegue desde GitHub para cPanel

$token = $_GET['token'] ?? '';

// Cargar DEPLOY_TOKEN desde el .env si existe
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    try {
        require __DIR__ . '/../vendor/autoload.php';
        $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->safeLoad();
    } catch (Throwable $e) {
        // Continuamos sin entorno
    }
}

$expected = $_ENV['DEPLOY_TOKEN'] ?? '';

if (!$expected || $token !== $expected) {
    http_response_code(403);
    echo 'No autorizado. Configura DEPLOY_TOKEN en el .env del servidor.';
    exit;
}

if (!function_exists('shell_exec')) {
    echo 'shell_exec no está disponible en este servidor.';
    exit;
}

$projectRoot = dirname(__DIR__);
chdir($projectRoot);

// Buscar git en el servidor
$git = null;
foreach (['/usr/local/cpanel/3rdparty/bin/git', '/usr/bin/git', '/usr/local/bin/git', 'git'] as $g) {
    $test = trim(shell_exec("$g --version 2>&1"));
    if (str_contains($test, 'git version')) {
        $git = $g;
        break;
    }
}

if (!$git) {
    echo 'No se encontró git en el servidor.';
    exit;
}

$output = [];

// Si no es un repo git, lo inicializa; si ya lo es, hace pull
if (!is_dir($projectRoot . '/.git')) {
    $output[] = 'Inicializando repositorio...';
    $output[] = shell_exec("$git init 2>&1");
    $output[] = shell_exec("$git remote add origin https://github.com/KarinaIzquierdo/Bioeducando_con_oswald.git 2>&1");
    $output[] = shell_exec("$git fetch origin 2>&1");
    $output[] = shell_exec("$git reset --hard origin/main 2>&1");
} else {
    $output[] = 'Actualizando con git pull...';
    $output[] = shell_exec("$git pull origin main 2>&1");
}

// Limpiar caché de vistas para ver cambios en Blade
$output[] = 'Limpiando caché de vistas...';
$output[] = shell_exec('php artisan view:clear 2>&1');

header('Content-Type: text/plain; charset=utf-8');
echo implode("\n", $output);
