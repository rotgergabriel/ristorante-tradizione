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
$head_title = 'Le Nostre Ricette | Ristorante Pizzeria Tradizione';
$pageKey = 'page-all-recipes';
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <?php
    include_once __DIR__ . '/includes/head.php';
    ?>
</head>

<body>
    <div class="layout <?php echo $pageKey ?>" id="top">
        <!-- Header Nav Section start-->
        <?php
        require_once '../app/views/includes/navbar.php';
        ?>
        <!-- Header Nav Section end -->
        <main class="main">
            <div class="page-banner">
            </div>
            <!-- Ricette Section start -->
            <?php
            include __DIR__ . '/includes/ricette.php';
            ?>
            <!-- Ricette Section end -->
            <div class="boton-ir-arriba">
                <a href="#top">
                    <img src="<?php echo BASE_URL; ?>public/assets/img/punta-de-flecha-hacia-arriba.png" alt="Torna su">
                </a>
            </div>
        </main>
        <!-- Footer Section start -->
        <?php
        include __DIR__ . '/includes/footer.php';
        ?>
        <!-- Footer Section end -->
    </div>
    <script type="module" src="<?php echo BASE_URL; ?>public/js/interfaceManager.js"></script>
</body>

</html>