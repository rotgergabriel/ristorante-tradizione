<?php
require_once ROOT_PATH . 'app/config/config.php';

if (file_exists(ROOT_PATH . 'app/middleware/auth.php')) {
    require_once ROOT_PATH . 'app/middleware/auth.php';
}

if (ob_get_length()) ob_clean();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($conn)) {
        echo json_encode(['success' => false, 'error' => 'Database connection failed']);
        exit;
    }

    $status = isset($_POST['status']) ? (int)$_POST['status'] : 0;

    $sql = "UPDATE site_settings SET setting_value = '$status' WHERE setting_key = 'maintenance_mode'";

    if (mysqli_query($conn, $sql)) {
        echo json_encode([
            'success' => true,
            'new_status' => $status,
            'message' => 'Stato aggiornato con successo'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'error' => mysqli_error($conn)
        ]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
}
exit;
