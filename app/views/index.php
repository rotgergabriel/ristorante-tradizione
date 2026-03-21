<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/indexModel.php';

$res_lista      = getHomeRecipeTitles($conn);
$stmt_carrousel = getCarouselRecipes($conn, 3);
$res_random     = getRandomHomeRecipes($conn, 3);

$all_recipes = formatResultSetToArray($res_random);

$head_title = 'Ristorante Pizzeria Tradizione';
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
            <!-- Ricette Section start -->
            <?php
            require_once '../app/views/includes/ricette.php';
            ?>
            <!-- Ricette Section end -->

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
            <section id="il_menu" class="vini">
                <div class="vini__content">
                    <div class="vini__item">
                        <h2>IL MENÙ</h2>
                        <p>La nostra proposta culinaria celebra l’incontro tra tradizione e creatività. Ogni pizza è frutto di una lunga lievitazione naturale e di una selezione rigorosa di materie prime d’eccellenza, dai pomodori maturi del Sud alle farine macinate a pietra.
                            Dalle icone classiche della tradizione alle creazioni più audaci, il nostro viaggio nel gusto si conclude con una raffinata varietà di dolci fatti in casa, pensati per regalarti un finale indimenticabile.
                            Lasciati conquistare dalla freschezza dei nostri ingredienti e dalla passione che mettiamo in ogni singola infornata.
                        </p>
                        <a href="<?php echo BASE_URL ?>our-menu">SCOPRI IL MENÙ DELLE PIZZE</a>
                    </div>
                    <div class="vini__img">
                        <img src="<?php echo BASE_URL; ?>public/assets/img/margherita.webp" alt="Pizza images">
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
                        <a href="<?php echo BASE_URL ?>our-menu#VINI">SCOPRI LA NOSTRA CARTA DEI VINI</a>
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
        <!-- Footer Section start-->
        <?php
        require_once '../app/views/includes/footer.php';
        ?>
        <!-- Footer Section end -->
    </div>
    <script type="module" src="<?php echo BASE_URL; ?>public/js/interfaceManager.js"></script>
</body>

</html>