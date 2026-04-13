<?php
require_once __DIR__ . '/../app/config/config.php';

$view = $_GET['view'] ?? 'index';
$id = $_GET['id'] ?? null;

if (isset($_SERVER['REQUEST_URI'])) {
    $uri = str_replace('/ristorante-tradizione/', '', $_SERVER['REQUEST_URI']);
    $uri = trim(parse_url($uri, PHP_URL_PATH), '/');

    if (!empty($uri)) {
        $parts = explode('/', $uri);
        $view = $parts[0];
        $id = $parts[1] ?? null;

        if ($view === 'api' && $id === 'update-maintenance') {
            require_once ROOT_PATH . 'app/controllers/update_maintenance.php';
            exit;
        }

        if ($view === 'api' && $id === 'update-popup-status') {
            require_once ROOT_PATH . 'app/controllers/update-popup-status.php';
            exit;
        }
    }
}

$viewPath = ROOT_PATH . 'app/views/' . $view . '.php';
$controllerPath = ROOT_PATH . 'app/controllers/' . $view . '.php';

if (file_exists($viewPath)) {
    require_once $viewPath;
} elseif (file_exists($controllerPath)) {
    require_once $controllerPath;
} else {
    http_response_code(404);
    if (file_exists(ROOT_PATH . 'app/views/404.php')) {
        include ROOT_PATH . 'app/views/404.php';
    } else {
        echo "404 - Pagina non trovata";
    }
}