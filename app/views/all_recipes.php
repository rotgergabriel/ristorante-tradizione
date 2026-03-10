<?php
require_once __DIR__ . '/../config/config.php';

$sql_lista = "SELECT title FROM recipes ORDER BY title ASC";
$res_lista = mysqli_query($conn, $sql_lista);

if (isset($_GET['search_query']) && $_GET['search_query'] != '') {
    $busqueda = mysqli_real_escape_string($conn, $_GET['search_query']);
    $sql = "SELECT * FROM recipes WHERE title LIKE '%$busqueda%'";
} elseif (isset($_GET['selection_menu']) && $_GET['selection_menu'] != '') {
    $seleccion = mysqli_real_escape_string($conn, $_GET['selection_menu']);
    $sql = "SELECT * FROM recipes WHERE title = '$seleccion'";
} else {
    $sql = "SELECT * FROM recipes";
}

$stmt = mysqli_query($conn, $sql);
$all_recipes = [];
while ($row = mysqli_fetch_assoc($stmt)) {
    $all_recipes[] = $row;
}
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/style/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&family=Dancing+Script:wght@400..700&family=IBM+Plex+Mono:wght@100..700&family=Lora:ital,wght@0,400..700;1,400..700&family=Montserrat:wght@100..900&family=Open+Sans:wght@300..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100..900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo BASE_URL; ?>public/assets/icons/favicon-16x16.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Ristorante Pizzeria Tradizione - Tutte le ricette</title>
</head>

<body class="page-all-recipes">
    <div class="layout" id="top">
        <?php
        include __DIR__ . '/includes/navbar.php';
        ?>

        <main class="main">
            <?php
            include __DIR__ . '/includes/ricette.php';
            ?>

            <div class="boton-ir-arriba">
                <a href="#top">
                    <img src="<?php echo BASE_URL; ?>public/assets/img/punta-de-flecha-hacia-arriba.png" alt="Torna su">
                </a>
            </div>
        </main>

        <?php
        include __DIR__ . '/includes/footer.php';
        ?>
    </div>
    <script type="module" src="<?php echo BASE_URL; ?>public/js/uiTransitionsController.js"></script>
</body>

</html>