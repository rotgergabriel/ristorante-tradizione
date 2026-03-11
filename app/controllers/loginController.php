<?php
require_once __DIR__ . '/../config/config.php';

$USER_PRUEBA = 'admin';
$PASS_PRUEBA = 'Admin%1987';

$user_ingresado = $_POST['user_name'] ?? '';
$pass_ingresada = $_POST['user_pass'] ?? '';

if ($user_ingresado === $USER_PRUEBA && $pass_ingresada === $PASS_PRUEBA) {
    header('Location: ' . BASE_URL . 'dashboard');
    exit();
} else {
    header('Location: ' . BASE_URL . 'login?error=fail');
    exit();
}
