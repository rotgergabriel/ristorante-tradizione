<?php
require_once __DIR__ . '/../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['user_name'];
    $pass = $_POST['user_pass'];

    $conn = mysqli_connect("localhost", "root", "", "pizzeria_db");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $user = mysqli_real_escape_string($conn, $user);
    $safe_pass = mysqli_real_escape_string($conn, $pass);

    $sql = "SELECT id, username, password, role FROM users WHERE username = '$user' AND password = '$safe_pass'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {

        if ($pass === $row['password']) {

            session_start();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            header("Location: " . BASE_URL . "dashboard");
            exit();
        } else {
            header("Location: " . BASE_URL . "login?error=1");
            exit();
        }
    } else {
        header("Location: " . BASE_URL . "login?error=1");
        exit();
    }

    mysqli_close($conn);
}