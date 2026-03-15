<?php
require_once __DIR__ . '/../config/config.php';

$sql_status = "SELECT setting_value FROM site_settings WHERE setting_key = 'maintenance_mode' LIMIT 1";
$res_status = mysqli_query($conn, $sql_status);
$row_status = mysqli_fetch_assoc($res_status);

$service_unavailable = (isset($row_status['setting_value']) && $row_status['setting_value'] == 1);

$current_uri = $_SERVER['REQUEST_URI'];
$is_admin_area = (strpos($current_uri, 'login') !== false ||
    strpos($current_uri, 'dashboard') !== false ||
    strpos($current_uri, 'logoutController') !== false) ||
    strpos($current_uri, 'public') !== false;

if ($service_unavailable && !$is_admin_area) {
    http_response_code(503);
    header('Retry-After: 3600');
    if (file_exists(__DIR__ . '/../views/503.php')) {
        include __DIR__ . '/../views/503.php';
    }
    exit;
}
