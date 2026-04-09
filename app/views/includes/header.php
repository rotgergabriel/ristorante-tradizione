<section class="header__menu-overlay">
    <a class="menu__close" href="#"><img src="<?php echo BASE_URL; ?>public/assets/icons/icons8-eliminar-24.png" alt=""></a>
    <!-- Main navigation panel inside the overlay -->
    <nav class="menu-overlay">
        <div class="logo__overlay">
            <a href="#">
                <img fetchpriority="high"
                    src="<?php echo BASE_URL ?>public/assets/img/ristorante-il-cairo.png"
                    class="attachment-full size-full wp-image-86" alt=""
                    srcset="<?php echo BASE_URL ?>public/assets/img/ristorante-il-cairo.png"
                    sizes="(max-width: 1001px) 100vw, 1001px">
            </a>
        </div>
        <!-- Navigation links list -->
        <ul class="menu-overlay__list">
            <li class="menu-overlay__item"><a href="<?php echo BASE_URL; ?>">HOME</a></li>
            <li class="menu-overlay__item"><a href="<?php echo BASE_URL; ?>#chi_siamo">CHI SIAMO</a></li>
            <li class="menu-overlay__item"><a href="<?php echo BASE_URL; ?>#le_nostre_ricette">LE NOSTRE RICETTE</a></li>
            <li class="menu-overlay__item"><a href="<?php echo BASE_URL; ?>#servizio_a_domicilio">SERVIZIO A DOMICILIO</a></li>
            <li class="menu-overlay__item"><a href="<?php echo BASE_URL; ?>our-menu">LA CARTA</a></li>
            <li class="menu-overlay__item"><a href="<?php echo BASE_URL; ?>#contact">CONTATTI</a></li>
        </ul>
    </nav>
    <!-- header__divider -->
    <!-- <div class="header__divider"></div> -->
    <section class="admin-link">
        <div class="admin-link__container">
            <a href="<?php echo BASE_URL; ?>login" class="admin-link__link">
                <i class="fas fa-user-shield"></i> Login
            </a>
        </div>
    </section>
</section>