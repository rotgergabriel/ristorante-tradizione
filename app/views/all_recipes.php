<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/recipesModel.php';

$registros_por_pagina = 16;
$pagina_actual = isset($_GET['p']) ? (int)$_GET['p'] : 1;
if ($pagina_actual < 1) {
    $pagina_actual = 1;
}
$offset = ($pagina_actual - 1) * $registros_por_pagina;

$search_query   = $_GET['search_query'] ?? '';
$selection_menu = $_GET['selection_menu'] ?? '';

$filter = getRecipesFilter($conn, $search_query, $selection_menu);

$query_param = "";
if (!empty($search_query)) {
    $query_param = "&search_query=" . urlencode($search_query);
} elseif (!empty($selection_menu)) {
    $query_param = "&selection_menu=" . urlencode($selection_menu);
}

$res_lista       = getRecipesList($conn);
$total_registros = getTotalRecipesCount($conn, $filter);
$total_paginas   = ceil($total_registros / $registros_por_pagina);

$stmt        = getPagedRecipes($conn, $filter, $registros_por_pagina, $offset);
$all_recipes = recipesToArray($stmt);

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

            <!-- Ricette section start -->
            <?php
            include __DIR__ . '/includes/ricette.php';
            ?>
            <!-- Ricette section end -->

            <!-- Pagination section start -->
            <?php
            include __DIR__ . '/includes/pagination.php';
            ?>
            <!-- Pagination section end -->

            <!-- Up Button start -->
            <?php
            require_once '../app/views/includes/up_button.php';
            ?>
            <!-- Up Button end -->
        </main>
        <?php
        include __DIR__ . '/includes/footer.php';
        ?>
    </div>
    <script type="module" src="<?php echo BASE_URL; ?>public/js/interfaceManager.js"></script>
</body>

</html>