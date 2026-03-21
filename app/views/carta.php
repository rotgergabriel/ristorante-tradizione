<?php
require_once __DIR__ . '/../config/config.php';

// Obtener todas las categorías de la base de datos
$sql_categories = "SELECT * FROM menu_categories ORDER BY display_order ASC, name ASC";
$res_categories = mysqli_query($conn, $sql_categories);

$head_title = 'La Nostra Carta | Pizzeria Tradizione';
$pageKey = 'carta';
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <?php include_once __DIR__ . '/includes/head.php'; ?>
</head>

<body>
    <div class="layout <?php echo $pageKey ?>">

        <?php require_once '../app/views/includes/navbar.php'; ?>

        <main class="main">
            <div class="menu-page__container">

                <aside class="menu-page__sidebar">
                    <div class="menu-sidebar__gallery">
                        <img src="<?php echo BASE_URL ?>public/assets/img/margherita.webp" alt="Pizza Margherita" class="menu-sidebar__image">
                        <img src="<?php echo BASE_URL ?>public/assets/img/coca-cola.webp" alt="Bevande" class="menu-sidebar__image">
                        <img src="<?php echo BASE_URL ?>public/assets/img/vino-con-comida-sobre-fondo-de-madera.webp" alt="I Nostri Vini" class="menu-sidebar__image">
                    </div>
                </aside>

                <section class="menu-page__content">
                    <div class="page-banner"></div>

                    <h1 class="menu-header__title">IL MENÙ</h1>

                    <?php
                    if ($res_categories && mysqli_num_rows($res_categories) > 0) {
                        while ($cat = mysqli_fetch_assoc($res_categories)) {
                            $category_id = $cat['id'];

                            // Obtener los items de esta categoría específica
                            $sql_items = "SELECT * FROM menu_items WHERE category_id = $category_id ORDER BY name ASC";
                            $res_items = mysqli_query($conn, $sql_items);

                            if (mysqli_num_rows($res_items) > 0) {
                    ?>
                                <section class="menu-category">
                                    <h2 class="menu-category__title" id="<?php echo htmlspecialchars($cat['slug']); ?>">
                                        <?php echo htmlspecialchars(strtoupper($cat['name'])); ?>
                                    </h2>

                                    <div class="menu-category__items">
                                        <?php
                                        while ($item = mysqli_fetch_assoc($res_items)) {
                                        ?>
                                            <article class="menu-item">
                                                <div class="menu-item__info">
                                                    <h3 class="menu-item__name"><?php echo htmlspecialchars($item['name']); ?></h3>
                                                    <?php if (!empty($item['description'])) { ?>
                                                        <p class="menu-item__description"><?php echo htmlspecialchars($item['description']); ?></p>
                                                    <?php } ?>
                                                </div>
                                                <span class="menu-item__price">
                                                    €<?php echo number_format($item['price'], 2, ',', '.'); ?>
                                                </span>
                                            </article>
                                            <div class="menu-item__divider"></div>
                                        <?php
                                        } // Fin while items 
                                        ?>
                                    </div>
                                </section>
                        <?php
                            } // Fin check items
                        } // Fin while categorías
                    } else {
                        ?>
                        <p class="no-results">Il menù è in fase de aggiornamento. Torna a trovarci presto!</p>
                    <?php
                    }
                    ?>
                </section>
            </div>
        </main>

    </div>
    <script type="module" src="<?php echo BASE_URL; ?>public/js/interfaceManager.js"></script>
</body>

</html>