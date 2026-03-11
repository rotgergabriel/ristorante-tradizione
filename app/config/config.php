<?php

$domain = $_SERVER['HTTP_HOST'] ?? 'localhost';

$is_dev_env = (
    $domain === 'localhost' ||
    $domain === '127.0.0.1' ||
    strpos($domain, 'ngrok') !== false
);

$is_https = (
    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ||
    $_SERVER['SERVER_PORT'] == 443 ||
    (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ||
    strpos($domain, 'ngrok') !== false
);

$protocol = $is_https ? "https://" : "http://";

$script_name = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
$path_parts = array_values(array_filter(explode('/', $script_name)));

if ($is_dev_env && !empty($path_parts)) {
    $project_folder = '/' . $path_parts[0] . '/';
} else {
    $project_folder = '/';
}

define('BASE_URL', $protocol . $domain . $project_folder);

define('ROOT_PATH', realpath(dirname(__FILE__) . '/../../') . DIRECTORY_SEPARATOR);
define('MODELS_PATH', ROOT_PATH . 'app' . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR);

if ($is_dev_env) {
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'pizzeria_db');
} else {
    define('DB_HOST', 'localhost');
    define('DB_USER', 'user');
    define('DB_PASS', 'password');
    define('DB_NAME', 'data_base');
}

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

require_once __DIR__ . '/../helpers/maintenance.php';
require_once __DIR__ . '/../helpers/debugger.php';