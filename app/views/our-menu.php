<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/menuModel.php';

$res_categories = getMenuCategories($conn);

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

                    <?php if ($res_categories && mysqli_num_rows($res_categories) > 0) { ?>
                        <?php while ($cat = mysqli_fetch_assoc($res_categories)) {
                            $res_items = getMenuItemsByCategory($conn, $cat['id']);

                            if (mysqli_num_rows($res_items) > 0) { ?>
                                <section class="menu-category">
                                    <h2 class="menu-category__title" id="<?php echo htmlspecialchars($cat['slug']); ?>">
                                        <?php echo htmlspecialchars(strtoupper($cat['name'])); ?>
                                    </h2>

                                    <div class="menu-category__items">
                                        <?php while ($item = mysqli_fetch_assoc($res_items)) { ?>
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
                                        <?php } ?>
                                    </div>
                                </section>
                            <?php } ?>
                        <?php } ?>
                    <?php } else { ?>
                        <p class="no-results">Il menù è in fase de aggiornamento. Torna a trovarci presto!</p>
                    <?php } ?>
                </section>
            </div>
        </main>
    </div>
    <script type="module" src="<?php echo BASE_URL; ?>public/js/interfaceManager.js"></script>
</body>

</html>