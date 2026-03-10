<?php
require_once __DIR__ . '/../config/config.php';

$sql_lista = "SELECT title FROM recipes ORDER BY title ASC";
$res_lista = mysqli_query($conn, $sql_lista);

$sql = "SELECT * FROM recipes ORDER BY RAND() LIMIT 3";
$stmt = mysqli_query($conn, $sql);

$sql_carrousel = "SELECT title, description, subtitle, image_url, rating FROM recipes ORDER BY rating DESC LIMIT 3";
$stmt_carrousel = mysqli_query($conn, $sql_carrousel);

$all_recipes = [];
while ($row = mysqli_fetch_assoc($stmt)) {
    $all_recipes[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include_once __DIR__ . '/includes/head.php';
    ?>
</head>

<body>
    <div class="layout" id="top">
        <!-- Header section -->
        <header class="header">
            <div class="bg bg1"></div>
            <div class="bg bg2"></div>
            <div class="bg bg3"></div>
            <!-- Header Nav Section -->
            <?php
            require_once '../app/views/includes/navbar.php';
            ?>
            <!-- Overlay container hidden menu -->
            <section class="header__menu-overlay">
                <a class="menu__close" href="#"><img src="<?php echo BASE_URL; ?>public/assets/icons/icons8-eliminar-24.png" alt=""></a>
                <!-- Main navigation panel inside the overlay -->
                <nav class="menu-overlay">
                    <div class="logo__overlay">
                        <a href="#">
                            <img fetchpriority="high"
                                src="<?php echo BASE_URL ?>public/assets/img/ristorante_tradizione.png"
                                class="attachment-full size-full wp-image-86" alt=""
                                srcset="<?php echo BASE_URL ?>public/assets/img/ristorante_tradizione.png"
                                sizes="(max-width: 1001px) 100vw, 1001px">
                        </a>
                    </div>
                    <!-- Navigation links list -->
                    <ul class="menu-overlay__list">
                        <li class="menu-overlay__item"><a href="#home">HOME</a></li>
                        <li class="menu-overlay__item"><a href="#chi_siamo">CHI SIAMO</a></li>
                        <li class="menu-overlay__item"><a href="#le_nostre_ricette">LE NOSTRE RICETTE</a></li>
                        <li class="menu-overlay__item"><a href="#punti_di_forza">I NOSTRI PUNTI DI FORZA</a></li>
                        <li class="menu-overlay__item"><a href="#nostri_vini">I NOSTRI VINI</a></li>
                        <li class="menu-overlay__item"><a href="#contact">CONTATTI</a></li>
                    </ul>
                </nav>
                <!-- header__divider -->
                <!-- <div class="header__divider"></div> -->
                <section class="admin-link">
                    <div class="admin-link__container">
                        <a href="<?php echo BASE_URL; ?>login" class="admin-link__link">
                            Pannello di Amministrazione
                        </a>
                    </div>
                </section>
            </section>
            <section class="header__title">
                <div>
                    <h1>Non vado in pizzeria <br> Vado alla Tradizione </h1>
                </div>
            </section>
        </header>
        <!-- Main section -->
        <main class="main">
            <!-- About section -->
            <section id="chi_siamo" class="text-block">
                <h2>CHI SIAMO</h2>
                <p>
                    Siamo un ristorante a conduzione familiare, nati dalla passione per la buona cucina, il vino e
                    l’ospitalità.
                    Fin dall’inizio abbiamo voluto creare uno spazio dove ogni visita diventi un’esperienza autentica,
                    piena di sapori, calore e convivialità.
                    Utilizziamo ingredienti freschi e di stagione, provenienti dal territorio,
                    rispettando le tradizioni culinarie ma aggiungendo sempre un tocco creativo che ci contraddistingue.
                    Ogni piatto racconta una storia, e ogni ospite fa parte della nostra.
                </p>
            </section>
            <!-- Carrousel section -->
            <section class="carrousel">
                <?php while ($all_recipes_carrousel = mysqli_fetch_assoc($stmt_carrousel)) { ?>
                    <div class="carrousel__item">
                        <img src="<?php echo BASE_URL; ?>public/assets/img/<?php echo $all_recipes_carrousel['image_url'] ?>" alt="carrousel">
                        <img class="carrousel__arrow" src="<?php echo BASE_URL; ?>public/assets/img/punta-de-flecha-hacia-arriba.png" alt="arrow">
                        <p><?php echo $all_recipes_carrousel['title'] ?></p>

                        <div class="carrousel__overlay">
                            <h3 class="overlay__title"><?php echo $all_recipes_carrousel['title'] ?></h3>
                            <p class="overlay__text">
                                <?php echo $all_recipes_carrousel['subtitle'] ?>
                            </p>
                            <p class="overlay__text">
                                <?php echo $all_recipes_carrousel['description'] ?>
                            </p>

                            <div class="ricette__rating">
                                <?php
                                $rating = $all_recipes_carrousel["rating"] ?? 0;

                                for ($index = 1; $index <= 5; $index++) {
                                    if ($index <= $rating) {
                                        echo '<span class="star full">★</span>';
                                    } elseif ($index - 0.5 <= $rating) {
                                        echo '<span class="star half">★</span>';
                                    } else {
                                        echo '<span class="star empty">★</span>';
                                    }
                                }
                                ?>
                                <span class="rating-number">(<?php echo $rating; ?>)</span>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </section>
            <!-- Ricette section -->
            <?php
            require_once '../app/views/includes/ricette.php';
            ?>
            <!-- Punti di forza section -->
            <section id="punti_di_forza" class="text-block">
                <h2>I NOSTRI PUNTI DI FORZA</h2>
                <p>
                    Nel nostro ristorante celebriamo la cucina autentica e il rispetto per gli ingredienti locali.
                    Collaboriamo con produttori della regione per offrire piatti freschi, genuini e ricchi di sapore.
                    La nostra passione per il vino e la buona tavola si riflette in ogni dettaglio,
                    dalla scelta degli ingredienti alla presentazione finale di ogni portata.
                    Crediamo in una cucina artigianale, nell’equilibrio tra tradizione e innovazione,
                    e in un’esperienza gastronomica capace di coinvolgere tutti i sensi.
                </p>
            </section>
            <!-- Vini section -->
            <section id="nostri_vini" class="vini">
                <div class="vini__content">
                    <div class="vini__item">
                        <h2>I NOSTRI VINI</h2>
                        <p>La nostra esperienza gastronomica si completa con una raffinata selezione di vini locali e
                            internazionali.
                            Ogni etichetta è stata scelta con cura per accompagnare al meglio i nostri piatti e
                            valorizzarne i sapori.
                            Dalle bollicine eleganti ai rossi strutturati, passando per bianchi freschi e profumati,
                            la nostra cantina racconta un viaggio tra le migliori regioni vinicole.
                            Il nostro sommelier sarà lieto di consigliarti l’abbinamento perfetto per ogni occasione.
                        </p>
                        <a href="#">SCOPRI LA NOSTRA CARTA DEI VINI</a>
                    </div>
                    <div class="vini__img">
                        <img src="<?php echo BASE_URL; ?>public/assets/img/vino-con-comida-sobre-fondo-de-madera.webp" alt="Wine images">
                    </div>
                </div>
                <div class="vini__content">
                    <section class="vini__item">
                        <h2>I NOSTRI VINI</h2>
                        <p>La nostra esperienza gastronomica si completa con una raffinata selezione di vini locali e
                            internazionali.
                            Ogni etichetta è stata scelta con cura per accompagnare al meglio i nostri piatti e
                            valorizzarne i sapori.
                            Dalle bollicine eleganti ai rossi strutturati, passando per bianchi freschi e profumati,
                            la nostra cantina racconta un viaggio tra le migliori regioni vinicole.
                            Il nostro sommelier sarà lieto di consigliarti l’abbinamento perfetto per ogni occasione.
                        </p>
                        <a href="#">SCOPRI LA NOSTRA CARTA DEI VINI</a>
                    </section>
                    <section class="vini__img">
                        <img src="<?php echo BASE_URL; ?>public/assets/img/vista-frontal-copas-de-vino-uvas-frescas-nueces-queso-amarillo-sobre-tablero-de-madera-botella-volcada-sobre-fondo-oscuro.webp"
                            alt="Wine images">
                    </section>
                </div>
            </section>
            <!-- Up Button -->
            <div class="boton-ir-arriba">
                <a href="#top"><img src="<?php echo BASE_URL; ?>public/assets/img/punta-de-flecha-hacia-arriba.png" alt=""></a>
            </div>
        </main>
        <!-- Footer -->
        <?php
        require_once '../app/views/includes/footer.php';
        ?>
    </div>
    <script type="module" src="<?php echo BASE_URL; ?>public/js/uiTransitionsController.js"></script>
</body>

</html>