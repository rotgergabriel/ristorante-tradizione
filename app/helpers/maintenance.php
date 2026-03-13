<?php

$service_unavailable = false;

$current_uri = $_SERVER['REQUEST_URI'];

$is_admin_area = (strpos($current_uri, 'login') !== false ||
    strpos($current_uri, 'dashboard') !== false ||
    strpos($current_uri, 'public') !== false);

if ($service_unavailable && !$is_admin_area) {
    http_response_code(503);
    header('Retry-After: 3600');

    if (file_exists(__DIR__ . '/../views/503.php')) {
        include __DIR__ . '/../views/503.php';
    } else {
        echo "<h1>Sito in Manutenzione</h1><p>Stiamo lavorando per voi. Tornate presto!</p>";
    }
    exit;
}
