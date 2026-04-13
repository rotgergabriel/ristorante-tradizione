<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/popupModel.php';

if (isset($_POST['status']) && !isset($_POST['submit_popup'])) {
    header('Content-Type: application/json');
    $status = intval($_POST['status']);

    $sql  = "UPDATE site_settings SET setting_value = ? WHERE setting_key = 'popup_mode'";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $status);
    $ok   = mysqli_stmt_execute($stmt);

    echo json_encode(['success' => $ok]);
    exit();
}

if (isset($_POST['submit_popup'])) {
    $status   = isset($_POST['popup_status']) ? 1 : 0;
    $title    = $_POST['popup_title']    ?? '';
    $subtitle = $_POST['popup_subtitle'] ?? '';
    $days     = $_POST['popup_days']     ?? '';
    $month    = $_POST['popup_month']    ?? '';
    $city     = $_POST['popup_city']     ?? '';
    $schedule = $_POST['popup_schedule'] ?? '';
    $venue    = $_POST['popup_venue']    ?? '';
    $address  = $_POST['popup_address']  ?? '';

    $ok = updatePopupData($conn, $status, $title, $subtitle, $days, $month, $city, $schedule, $venue, $address);

    if ($ok) {
        echo "<script>alert('Popup aggiornato!'); window.location.href='" . BASE_URL . "dashboard?popup_open=1';</script>";
        exit();
    }
}

$popup_data_raw = getPopupData($conn);
$popup_data = [
    'status'   => $popup_data_raw['popup_mode']    ?? 0,
    'title'    => $popup_data_raw['popup_title']    ?? '',
    'subtitle' => $popup_data_raw['popup_subtitle'] ?? '',
    'days'     => $popup_data_raw['popup_days']     ?? '',
    'month'    => $popup_data_raw['popup_month']    ?? '',
    'city'     => $popup_data_raw['popup_city']     ?? '',
    'schedule' => $popup_data_raw['popup_schedule'] ?? '',
    'venue'    => $popup_data_raw['popup_venue']    ?? '',
    'address'  => $popup_data_raw['popup_address']  ?? '',
];

$popupOpen = isset($_GET['popup_open']);