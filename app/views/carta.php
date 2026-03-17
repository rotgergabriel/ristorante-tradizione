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

        <main class="main">
            <div class="menu-page__container">

                <aside class="menu-page__sidebar">
                    <div class="menu-sidebar__gallery">
                        <img src="<?php echo BASE_URL ?>/assets/img/margherita.webp" alt="Pizza Margherita" class="menu-sidebar__image">
                        <img src="<?php echo BASE_URL ?>/assets/img/coca-cola.webp" alt="Pizza Pistacchio" class="menu-sidebar__image">
                        <img src="<?php echo BASE_URL ?>/assets/img/vino-con-comida-sobre-fondo-de-madera.webp" alt="Pizza Montanara" class="menu-sidebar__image">
                    </div>
                </aside>

                <section class="menu-page__content">
                    <div class="page-banner">
                    </div>

                    <section class="menu-category">
                        <h1 class="menu-header__title">IL MENÙ</h1>

                        <h2 class="menu-category__title">LE NOSTRE PIZZE</h2>
                        <div class="menu-category__items">
                            <article class="menu-item">
                                <div class="menu-item__info">
                                    <h3 class="menu-item__name">Pizza Margherita</h3>
                                    <p class="menu-item__description">Pomodoro, mozzarella, basilico fresco.</p>
                                </div>
                                <span class="menu-item__price">$8,00</span>
                            </article>
                            <div class="menu-item__divider"></div>
                            <article class="menu-item">
                                <div class="menu-item__info">
                                    <h3 class="menu-item__name">Pizza Diavola</h3>
                                    <p class="menu-item__description">Pomodoro, mozzarella, salame piccante.</p>
                                </div>
                                <span class="menu-item__price">$9,50</span>
                            </article>
                            <div class="menu-item__divider"></div>
                            <article class="menu-item">
                                <div class="menu-item__info">
                                    <h3 class="menu-item__name">Pizza Marinara</h3>
                                    <p class="menu-item__description">Pomodoro, aglio, origano, olio extravergine.</p>
                                </div>
                                <span class="menu-item__price">$7,00</span>
                            </article>
                            <div class="menu-item__divider"></div>
                            <article class="menu-item">
                                <div class="menu-item__info">
                                    <h3 class="menu-item__name">Quattro Formaggi</h3>
                                    <p class="menu-item__description">Mozzarella, gorgonzola, fontina, parmigiano.</p>
                                </div>
                                <span class="menu-item__price">$11,00</span>
                            </article>
                            <div class="menu-item__divider"></div>
                            <article class="menu-item">
                                <div class="menu-item__info">
                                    <h3 class="menu-item__name">Pizza Capricciosa</h3>
                                    <p class="menu-item__description">Pomodoro, mozzarella, funghi, carciofi, prosciutto cotto, olive.</p>
                                </div>
                                <span class="menu-item__price">$12,00</span>
                            </article>
                            <div class="menu-item__divider"></div>
                            <article class="menu-item">
                                <div class="menu-item__info">
                                    <h3 class="menu-item__name">Pizza Napoletana</h3>
                                    <p class="menu-item__description">Pomodoro, mozzarella, acciughe, origano.</p>
                                </div>
                                <span class="menu-item__price">$10,00</span>
                            </article>
                            <div class="menu-item__divider"></div>
                            <article class="menu-item">
                                <div class="menu-item__info">
                                    <h3 class="menu-item__name">Pizza Vegetariana</h3>
                                    <p class="menu-item__description">Pomodoro, mozzarella, verdure grigliate di stagione.</p>
                                </div>
                                <span class="menu-item__price">$10,50</span>
                            </article>
                            <div class="menu-item__divider"></div>
                            <article class="menu-item">
                                <div class="menu-item__info">
                                    <h3 class="menu-item__name">Pizza Prosciutto e Funghi</h3>
                                    <p class="menu-item__description">Pomodoro, mozzarella, prosciutto cotto, funghi freschi.</p>
                                </div>
                                <span class="menu-item__price">$11,00</span>
                            </article>
                            <div class="menu-item__divider"></div>
                            <article class="menu-item">
                                <div class="menu-item__info">
                                    <h3 class="menu-item__name">Pizza Quattro Stagioni</h3>
                                    <p class="menu-item__description">Pomodoro, mozzarella, prosciutto, funghi, carciofi, olive.</p>
                                </div>
                                <span class="menu-item__price">$12,00</span>
                            </article>
                            <div class="menu-item__divider"></div>
                            <article class="menu-item">
                                <div class="menu-item__info">
                                    <h3 class="menu-item__name">Pizza Calzone</h3>
                                    <p class="menu-item__description">Pizza chiusa con pomodoro, mozzarella, ricotta e salame.</p>
                                </div>
                                <span class="menu-item__price">$11,50</span>
                            </article>
                            <div class="menu-item__divider"></div>
                        </div>
                    </section>

                    <section class="menu-category">
                        <h2 class="menu-category__title">LE NOSTRE BEVANDE</h2>
                        <div class="menu-category__items">
                            <article class="menu-item">
                                <div class="menu-item__info">
                                    <h3 class="menu-item__name">Acqua Minerale (500ml)</h3>
                                </div>
                                <span class="menu-item__price">$1,50</span>
                            </article>
                            <div class="menu-item__divider"></div>
                            <article class="menu-item">
                                <div class="menu-item__info">
                                    <h3 class="menu-item__name">Coca Cola / Zero</h3>
                                </div>
                                <span class="menu-item__price">$2,50</span>
                            </article>
                            <div class="menu-item__divider"></div>
                            <article class="menu-item">
                                <div class="menu-item__info">
                                    <h3 class="menu-item__name">Fanta / Sprite</h3>
                                </div>
                                <span class="menu-item__price">$2,50</span>
                            </article>
                            <div class="menu-item__divider"></div>
                            <article class="menu-item">
                                <div class="menu-item__info">
                                    <h3 class="menu-item__name">Tè Freddo Limone/Pesca</h3>
                                </div>
                                <span class="menu-item__price">$3,00</span>
                            </article>
                            <div class="menu-item__divider"></div>
                            <article class="menu-item">
                                <div class="menu-item__info">
                                    <h3 class="menu-item__name">Succo di Frutta</h3>
                                </div>
                                <span class="menu-item__price">$3,00</span>
                            </article>
                            <div class="menu-item__divider"></div>
                        </div>
                    </section>

                    <section class="menu-category">
                        <h2 class="menu-category__title" id="vini">I NOSTRI VINI</h2>
                        <div class="menu-category__items">
                            <article class="menu-item">
                                <div class="menu-item__info">
                                    <h3 class="menu-item__name">Chianti Classico (Rosso)</h3>
                                </div>
                                <span class="menu-item__price">$25,00</span>
                            </article>
                            <div class="menu-item__divider"></div>
                            <article class="menu-item">
                                <div class="menu-item__info">
                                    <h3 class="menu-item__name">Montepulciano d'Abruzzo</h3>
                                </div>
                                <span class="menu-item__price">$22,00</span>
                            </article>
                            <div class="menu-item__divider"></div>
                            <article class="menu-item">
                                <div class="menu-item__info">
                                    <h3 class="menu-item__name">Pinot Grigio (Bianco)</h3>
                                </div>
                                <span class="menu-item__price">$20,00</span>
                            </article>
                            <div class="menu-item__divider"></div>
                            <article class="menu-item">
                                <div class="menu-item__info">
                                    <h3 class="menu-item__name">Prosecco di Valdobbiadene</h3>
                                </div>
                                <span class="menu-item__price">$28,00</span>
                            </article>
                            <div class="menu-item__divider"></div>
                            <article class="menu-item">
                                <div class="menu-item__info">
                                    <h3 class="menu-item__name">Vino della Casa (Calice)</h3>
                                </div>
                                <span class="menu-item__price">$5,00</span>
                            </article>
                            <div class="menu-item__divider"></div>
                        </div>
                    </section>
                </section>
            </div>
        </main>

    </div>
    <script type="module" src="<?php echo BASE_URL; ?>public/js/interfaceManager.js"></script>
</body>

</html>