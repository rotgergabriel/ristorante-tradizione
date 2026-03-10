<section class="forms-container">
    <form action="<?php echo BASE_URL; ?>all_recipes" method="GET" class="search-form">
        <div class="form-group search-group">
            <label for="search_id">Cerca per Titolo:</label>
            <div class="search-input-actions">
                <input type="text" id="search_id" name="search_query" placeholder="Cerca una ricetta..." autofocus>
                <button type="submit" class="btn-primary">🔍 Cerca</button>
            </div>
        </div>
    </form>
    <form action="<?php echo BASE_URL; ?>all_recipes" method="GET" class="filter-form">
        <div class="form-group filter-group">
            <label for="selection-menu">Lista delle ricette:</label>
            <div class="filter-input-actions">
                <select name="selection_menu" id="selection-menu">
                    <option value="" disabled selected hidden>Seleziona una ricetta...</option>
                    <?php
                    while ($recipe_title = mysqli_fetch_assoc($res_lista)) { ?>
                        <option value="<?php echo $recipe_title['title']; ?>">
                            <?php echo $recipe_title['title']; ?>
                        </option>
                    <?php } ?>
                </select>
                <button type="submit" class="btn-primary">🔍 Cerca</button>
            </div>
        </div>
    </form>
</section>
<section id="le_nostre_ricette" class="ricette">
    <h2>LE NOSTRE RICETTE</h2>
    <section class="ricette__items">
        <?php foreach ($all_recipes as $recipe) { ?>
            <article class="ricette__content">
                <div class="ricette__item">
                    <img src="<?php echo BASE_URL; ?>public/assets/img/<?php echo $recipe['image_url'] ? $recipe['image_url'] : 'default.webp'; ?>"
                        alt="<?php echo $recipe['title']; ?>">
                    <h3><?php echo $recipe["title"] ?></h3>
                    <p><?php echo $recipe["subtitle"] ?></p>
                    <p> <?php echo $recipe["description"] ?>.</p>
                    <div class="ricette__item--buttons">
                        <p><?php echo $recipe["preparation_time"] ?></p>
                        <div class="ricette__rating">
                            <?php
                            $rating = $recipe["rating"];
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
                        <a class="popup-open">PROCEDIMENTO</a>
                    </div>
                </div>
                <div class="ricette__overlay">
                    <div class="ricette__item--overlay">
                        <button class="popup__close">×</button>
                        <h3 class="overlay__title"><?php echo $recipe["title"] ?></h3>
                        <p class="overlay__text"><?php echo ltrim(preg_replace('/(\d+\.)/', '<br>$1', $recipe["complete_process"]), '<br>') ?></p>
                        <div class="ricette__item--buttons">
                            <p><?php echo $recipe["preparation_time"] ?></p>
                            <div class="ricette__rating">
                                <?php
                                $rating = $recipe["rating"];
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
            </article>
        <?php } ?>
    </section>
    <footer class="ricette__footer">
        <a href="<?php echo BASE_URL; ?>all_recipes" target="_blank">VEDI TUTTE LE RICETTE</a>
    </footer>
</section>