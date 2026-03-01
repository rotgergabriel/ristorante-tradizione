<?php
    $service_unavailable = false;
    if ($service_unavailable) {
        http_response_code(503);
        header('Retry-After: 3600'); // 1 hora
        include __DIR__ . '/../views/503.php';
        exit;
    }
?>