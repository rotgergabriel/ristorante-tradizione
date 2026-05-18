<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/indexModel.php';
require_once __DIR__ . '/../models/popupModel.php';

$res_lista      = getHomeRecipeTitles($conn);
$stmt_carrousel = getCarouselRecipes($conn, 3);
$res_random     = getRandomHomeRecipes($conn, 3);

$all_recipes = formatResultSetToArray($res_random);
$head_title = 'Ristorante Pizzeria Tradizione';

// Popup section
$popup_data_raw = getPopupData($conn);

$statusPopup   = ($popup_data_raw['popup_mode'] ?? 0) == 1;
$titlePopup    = $popup_data_raw['popup_title']    ?? '';
$subtitlePopup = $popup_data_raw['popup_subtitle'] ?? '';
$daysPopup     = $popup_data_raw['popup_days']     ?? '';
$monthPopup    = $popup_data_raw['popup_month']    ?? '';
$cityPopup     = $popup_data_raw['popup_city']     ?? '';
$schedulePopup = !empty($popup_data_raw['popup_schedule'])
    ? explode(',', $popup_data_raw['popup_schedule'])
    : [];
$locationPopup = [
    'icon'    => 'icons8-pizza-100.png',
    'venue'   => $popup_data_raw['popup_venue']   ?? '',
    'address' => $popup_data_raw['popup_address'] ?? '',
];
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
            <div class="header__bg header__bg--active"></div>
            <div class="header__bg header__bg--next"></div>

            <!-- Header Nav Section start-->
            <?php
            require_once '../app/views/includes/navbar.php';
            ?>
            <!-- Header Nav Section end -->

            <!-- Popup start-->
            <?php
            require_once '../app/views/includes/popup.php';
            ?>
            <!-- Popup end -->

            <!-- Header Overlay start-->
            <?php
            require_once '../app/views/includes/header.php';
            ?>
            <!-- Header Overlay end -->

            <section class="header__title">
                <div>
                    <h1>Il Cairo<br>Pizza, Kebab & Tacos</h1>
                </div>
            </section>
        </header>
        <!-- Main section -->
        <main class="main">
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

            <!-- Servizio a domicilio section -->
            <section id="servizio_a_domicilio" class="text-block delivery-info">
                <h2>SERVIZIO A DOMICILIO</h2>
                <p class="delivery-intro">
                    Goditi il gusto di <strong>Il Cairo</strong> direttamente a casa tua!
                    Cucina di alta qualità con consegna rapida a <strong>Vigone</strong> e dintorni.
                </p>

                <div class="delivery-rates">
                    <p>
                        <span class="highlight">Consegna a Vigone:</span> <br>
                        <strong>GRATUITA</strong> con spesa min. <span class="price">15€</span>
                    </p>
                    <p>
                        <span class="highlight">Fuori Vigone:</span> <br>
                        Consegna <span class="price">2,50€</span>
                    </p>
                    <img src="<?php BASE_URL ?>public/assets/img/consegna.png" alt="moto delivery" class="moto-pop">
                </div>

                <p class="delivery-cta">
                    Ordina in modo semplice e veloce su <strong>WhatsApp</strong> o chiamaci. <br>
                    Siamo pronti a preparare la tua pizza, il tuo kebab o i tuoi tacos preferiti!
                </p>

                <div class="delivery-actions">
                    <a href="https://wa.me/39XXXXXXXXXX" target="_blank" class="btn-delivery whatsapp">ORDINA SU WHATSAPP</a>
                </div>
            </section>

            <!-- Vini section -->
            <section id="il_menu" class="vini">
                <div class="vini__content">
                    <div class="vini__item">
                        <h2>La Carta</h2>
                        <p>La nostra proposta culinaria celebra l’incontro tra tradizione e creatività. Ogni pizza è frutto di una lunga lievitazione naturale e di una selezione rigorosa di materie prime d’eccellenza, dai pomodori maturi del Sud alle farine macinate a pietra.
                            Dalle icone classiche della tradizione alle creazioni più audaci, il nostro viaggio nel gusto si conclude con una raffinata varietà di dolci fatti in casa, pensati per regalarti un finale indimenticabile.
                            Lasciati conquistare dalla freschezza dei nostri ingredienti e dalla passione che mettiamo in ogni singola infornata.
                        </p>
                        <a href="<?php echo BASE_URL ?>our-menu">SCOPRI IL NOSTRO LISTINO</a>
                    </div>
                    <div class="vini__img">
                        <img src="<?php echo BASE_URL; ?>public/assets/img/la_carta.webp" alt="Pizza images">
                    </div>
                </div>
                <div class="vini__content">
                    <section class="vini__item">
                        <h2>Focacce / Calzoni</h2>
                        <p>
                            La nostra offerta si arricchisce con le nostre fragranti focacce e i calzoni ripieni,
                            preparati con lo stesso impasto a lunga lievitazione che rende unica la nostra pizza.
                            Dalle focacce croccanti condite con ingredienti freschi ai calzoni dal cuore filante,
                            ogni creazione è pensata per offrirti un sapore autentico e genuino.
                            Scopri le nostre varianti classiche e le specialità della casa,
                            farcite con salumi selezionati, formaggi di qualità e verdure di stagione.
                        </p>
                        <a href="<?php echo BASE_URL ?>our-menu#FOCACCE">VEDI LE NOSTRE SPECIALITÀ</a>
                    </section>
                    <section class="vini__img">
                        <img src="<?php echo BASE_URL; ?>public/assets/img/focacce_calzoni.webp"
                            alt="Wine images">
                    </section>
                </div>
            </section>
            <!-- About section -->
            <section id="chi_siamo" class="native-accordion">
                <details class="accordion-item">
                    <summary class="accordion-header">
                        <span class="header-title">CHI SIAMO</span>
                        <span class="icon">▾</span>
                    </summary>
                    <div class="accordion-body">
                        <div class="text-block delivery-info" style="margin: 0; padding: 0; width: 100%;">
                            <p style="margin-bottom: 15px;">
                                Benvenuti da <strong>Il Cairo</strong>, dove la passione per la cucina incontra l'accoglienza di una gestione familiare nel cuore di Vigone.
                                Siamo nati con l'obiettivo di offrire un punto d'incontro unico, dove la tradizione della pizza italiana si intreccia con i sapori ricchi e speziati del miglior Kebab e dei Tacos più gustosi.
                            </p>
                            <p>
                                Ogni giorno selezioniamo ingredienti freschi per garantire qualità in ogni preparazione, dal nostro impasto a lunga lievitazione alle carni sapientemente condite.
                                Per noi, non si tratta solo di servire cibo, ma di creare un'esperienza autentica fatta di calore e convivialità.
                            </p>
                        </div>
                    </div>
                </details>
            </section>
            <!-- Up Button start -->
            <?php
            require_once '../app/views/includes/up_button.php';
            ?>
            <!-- Up Button end -->

            <!-- Up Whatsapp start -->
            <?php
            require_once '../app/views/includes/whatsapp_button.php';
            ?>
            <!-- Up Whatsapp end -->
        </main>
        <!-- Footer Section start-->
        <?php
        require_once '../app/views/includes/footer.php';
        ?>
        <!-- Footer Section end -->
    </div>
    <script type="module" src="<?php echo BASE_URL; ?>public/js/interfaceManager.js"></script>
    <script src="<?php echo BASE_URL ?>public/js/popupClose.js"></script>
</body>

</html>