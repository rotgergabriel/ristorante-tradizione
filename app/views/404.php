<?php
require_once __DIR__ . '/../config/config.php';

$head_title = 'Pagina non trovata | Ristorante Pizzeria Tradizione';
$error_page_title = '404';
$error_page_subtitle = 'Pagina non trovata';
$error_page_description = 'Spiacenti, la pagina che stai cercando non esiste o è stata spostata.';
$btn_text = 'Torna alla Home';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include_once __DIR__ . '/includes/head.php';
    ?>
</head>

<body>
    <div class="layout">
        <!-- 404 Section start-->
        <?php
        require_once '../app/views/includes/error_page.php';
        ?>
        <!-- 404 Section end -->
    </div>
</body>

</html>