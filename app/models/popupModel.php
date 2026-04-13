<?php

function getPopupData($conn)
{
    $sql = "SELECT setting_key, setting_value, text_value 
            FROM site_settings 
            WHERE setting_key LIKE 'popup_%'";
    $result = mysqli_query($conn, $sql);

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[$row['setting_key']] = ($row['text_value'] !== null)
            ? $row['text_value']
            : (int)$row['setting_value'];
    }
    return $data;
}

function updatePopupData($conn, $status, $title, $subtitle, $days, $month, $city, $schedule, $venue, $address)
{
    $fields = [
        'popup_mode'     => ['type' => 'int',    'value' => intval($status)],
        'popup_title'    => ['type' => 'string', 'value' => $title],
        'popup_subtitle' => ['type' => 'string', 'value' => $subtitle],
        'popup_days'     => ['type' => 'string', 'value' => $days],
        'popup_month'    => ['type' => 'string', 'value' => $month],
        'popup_city'     => ['type' => 'string', 'value' => $city],
        'popup_schedule' => ['type' => 'string', 'value' => $schedule],
        'popup_venue'    => ['type' => 'string', 'value' => $venue],
        'popup_address'  => ['type' => 'string', 'value' => $address],
    ];

    foreach ($fields as $key => $field) {
        if ($field['type'] === 'int') {
            $sql = "UPDATE site_settings SET setting_value = ?, text_value = NULL WHERE setting_key = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'is', $field['value'], $key);
        } else {
            $sql = "UPDATE site_settings SET text_value = ?, setting_value = NULL WHERE setting_key = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'ss', $field['value'], $key);
        }

        if (!mysqli_stmt_execute($stmt)) {
            return false;
        }
    }
    return true;
}