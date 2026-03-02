<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pizzeria_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
$host = $_SERVER['HTTP_HOST'];
$projectPath = str_replace($_SERVER['DOCUMENT_ROOT'], '', str_replace('\\', '/', dirname(__DIR__, 1)));

define('URLROOT', $protocol . "://" . $host . "/ristorante-tradizione");

?>