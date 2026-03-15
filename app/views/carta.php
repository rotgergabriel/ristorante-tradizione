<?php
require_once __DIR__ . '/../config/config.php';

$head_title = 'La Nostra Carta | Pizzeria Tradizione';
$pageKey = 'carta';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include_once __DIR__ . '/includes/head.php';
    ?>
</head>

<body>
    <div class="layout <?php echo $pageKey ?>">
        <!-- Header Nav Section start-->
        <?php
        require_once '../app/views/includes/navbar.php';
        ?>
        <!-- Header Nav Section end -->

        <!-- Header Overlay start-->
        <?php
        require_once '../app/views/includes/header.php';
        ?>
        <!-- Header Overlay end -->

        <!-- Footer Section start -->
        <?php
        require_once '../app/views/includes/footer.php';
        ?>
        <!-- Footer Section end -->
    </div>
    <script type="module" src="<?php echo BASE_URL; ?>public/js/interfaceManager.js"></script>
</body>

</html>