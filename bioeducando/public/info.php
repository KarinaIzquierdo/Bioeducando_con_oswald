<?php
header('Content-Type: text/plain; charset=utf-8');

$values = [
    'upload_max_filesize' => ini_get('upload_max_filesize'),
    'post_max_size'       => ini_get('post_max_size'),
    'max_execution_time'  => ini_get('max_execution_time'),
    'max_input_time'      => ini_get('max_input_time'),
    'memory_limit'        => ini_get('memory_limit'),
    'max_file_uploads'    => ini_get('max_file_uploads'),
    'display_errors'      => ini_get('display_errors'),
];

foreach ($values as $key => $value) {
    echo $key . ': ' . $value . "\n";
}

// Convertir a KB para comparación
function toKiloBytes($value) {
    $value = trim($value);
    $last = strtolower($value[strlen($value) - 1]);
    $num = (int) $value;
    switch ($last) {
        case 'g': $num *= 1024 * 1024; break;
        case 'm': $num *= 1024; break;
        case 'k': break;
    }
    return $num;
}

$uploadMax = toKiloBytes($values['upload_max_filesize']);
$postMax = toKiloBytes($values['post_max_size']);

echo "\n--- Analisis para videos ---\n";
echo "Maximo por archivo (KB): " . $uploadMax . "\n";
echo "Maximo total del formulario (KB): " . $postMax . "\n";

if ($uploadMax < 51200) {
    echo "\nNOTA: El limite actual es menor a 50MB. Se necesita aumentar upload_max_filesize y post_max_size en cPanel para videos mas largos.\n";
}
