<?php

// deploy.php para cPanel cuando el dominio apunta a la raíz del proyecto

$token = $_GET['token'] ?? '';

// Dominio apunta a public_html; el proyecto está en la carpeta hermana bioeducando
$projectRoot = __DIR__ . '/../bioeducando';

if (file_exists($projectRoot . '/vendor/autoload.php')) {
    try {
        require $projectRoot . '/vendor/autoload.php';
        $dotenv = Dotenv\Dotenv::createImmutable($projectRoot);
        $dotenv->safeLoad();
    } catch (Throwable $e) {
        // Continuamos sin entorno
    }
}

$expected = $_ENV['DEPLOY_TOKEN'] ?? '';

// Si Dotenv no cargó, leer DEPLOY_TOKEN directamente del .env
if (!$expected && file_exists($projectRoot . '/.env')) {
    foreach (file($projectRoot . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);
        if (str_starts_with($line, 'DEPLOY_TOKEN=')) {
            $expected = trim(substr($line, strlen('DEPLOY_TOKEN=')));
            $expected = trim($expected, "\x22\x27");
            break;
        }
    }
}

if (!$expected || $token !== $expected) {
    http_response_code(403);
    echo 'No autorizado. Configura DEPLOY_TOKEN en el .env del servidor.';
    exit;
}

if (!function_exists('shell_exec')) {
    echo 'shell_exec no está disponible en este servidor.';
    exit;
}

chdir($projectRoot);

// Buscar git
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
$repoDir = $projectRoot . '/storage/deploy-repo';

if (!is_dir($repoDir . '/.git')) {
    $output[] = 'Clonando repositorio...';
    $output[] = shell_exec($git . ' clone --depth=1 https://github.com/KarinaIzquierdo/Bioeducando_con_oswald.git ' . escapeshellarg($repoDir) . ' 2>&1');
} else {
    $output[] = 'Actualizando repositorio...';
    $output[] = shell_exec($git . ' -C ' . escapeshellarg($repoDir) . ' pull 2>&1');
}

// Copiar el contenido de la carpeta bioeducando/ del repo a la raíz del proyecto
$output[] = 'Copiando archivos...';
$output[] = shell_exec('cp -R ' . escapeshellarg($repoDir . '/bioeducando/.') . ' ' . escapeshellarg($projectRoot . '/') . ' 2>&1');

$output[] = 'Limpiando caché de vistas...';
$output[] = shell_exec('php artisan view:clear 2>&1');

header('Content-Type: text/plain; charset=utf-8');
echo implode("\n", $output);
