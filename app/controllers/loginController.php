<?php

$USER_PRUEBA = 'admin';
$PASS_PRUEBA = 'admin123';

$user_ingresado = isset($_POST['user_name']) ? $_POST['user_name'] : '';
$pass_ingresada = isset($_POST['user_pass']) ? $_POST['user_pass'] : '';


if ($user_ingresado === $USER_PRUEBA && $pass_ingresada === $PASS_PRUEBA) {
    header('Location: /forte_chance/pizzeria/app/views/admin.php');
} else {
    header('Location: ../views/login.php?error=fail');
}
?>