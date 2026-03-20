<?php
require_once __DIR__ . '/../config/config.php';

$sql_lista = "SELECT title FROM recipes ORDER BY title ASC";
$res_lista = mysqli_query($conn, $sql_lista);

$registros_por_pagina = 16;
$pagina_actual = isset($_GET['p']) ? (int)$_GET['p'] : 1;
if ($pagina_actual < 1) $pagina_actual = 1;
$offset = ($pagina_actual - 1) * $registros_por_pagina;

$filter = "";
$query_param = "";

if (isset($_GET['search_query']) && $_GET['search_query'] != '') {
    $busqueda = mysqli_real_escape_string($conn, $_GET['search_query']);
    $filter = " WHERE title LIKE '%$busqueda%'";
    $query_param = "&search_query=" . urlencode($_GET['search_query']);
} elseif (isset($_GET['selection_menu']) && $_GET['selection_menu'] != '') {
    $seleccion = mysqli_real_escape_string($conn, $_GET['selection_menu']);
    $filter = " WHERE title = '$seleccion'";
    $query_param = "&selection_menu=" . urlencode($_GET['selection_menu']);
}

$res_count = mysqli_query($conn, "SELECT COUNT(*) as total FROM recipes $filter");
$total_registros = mysqli_fetch_assoc($res_count)['total'];
$total_paginas = ceil($total_registros / $registros_por_pagina);

$sql = "SELECT * FROM recipes $filter ORDER BY title ASC LIMIT $registros_por_pagina OFFSET $offset";
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
        <?php
        require_once '../app/views/includes/navbar.php';
        ?>
        <main class="main">
            <div class="page-banner">
            </div>
            <?php
            include __DIR__ . '/includes/ricette.php';
            ?>

            <div class="pagination">
                <?php
                $rango = 2;
                if ($pagina_actual > 1) {
                    echo "<a href='?p=1$query_param'>&laquo; Inizio</a>";
                }
                for ($i = 1; $i <= $total_paginas; $i++) {
                    if ($i == 1 || $i == $total_paginas || ($i >= $pagina_actual - $rango && $i <= $pagina_actual + $rango)) {
                        $class = ($pagina_actual == $i) ? 'active' : '';
                        echo "<a href='?p=$i$query_param' class='$class'>$i</a>";
                    } elseif ($i == $pagina_actual - $rango - 1 || $i == $pagina_actual + $rango + 1) {
                        echo "<span style='padding: 8px;'>...</span>";
                    }
                }
                if ($pagina_actual < $total_paginas) {
                    echo "<a href='?p=$total_paginas$query_param'>Fine &raquo;</a>";
                }
                ?>
            </div>

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
    <script type="module" src="<?php echo BASE_URL; ?>public/js/interfaceManager.js"></script>
</body>

</html>