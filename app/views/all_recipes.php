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
    <?php
    include_once __DIR__ . '/includes/head.php';
    ?>
</head>

<body>
    <div class="layout page-all-recipes" id="top">
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
    <?php
    include_once __DIR__ . '/includes/footer.php';
    ?>
    <script type="module" src="<?php echo BASE_URL; ?>public/js/uiTransitionsController.js"></script>
</body>

</html>