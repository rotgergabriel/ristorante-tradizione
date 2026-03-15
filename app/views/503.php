<?php
require_once __DIR__ . '/../config/config.php';

$head_title = 'Sito in Manutenzione | Ristorante Pizzeria Tradizione';
$head_title = 'Pagina non trovata | Ristorante Pizzeria Tradizione';
$error_page_title = '503';
$error_page_subtitle = 'Servizio non disponibile';
$error_page_description = 'Stiamo apportando alcune modifiche all\'applicazione.';
$btn_text = 'Riprova più tardi';
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
        <!-- 503 Section start-->
        <?php
        require_once '../app/views/includes/error_page.php';
        ?>
        <!-- 503 Section end -->
    </div>
</body>

</html>