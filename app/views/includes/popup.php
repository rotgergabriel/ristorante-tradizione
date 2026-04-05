<?php if (!empty($statusPopup) && is_array($schedulePopup)) { ?>
    <article class="event-card">
        <a type="button" class="event-card__close">&times;</a>
        <header class="event-card__header">
            <span class="event-card__org"><?php echo $titlePopup ?></span>
            <h1 class="event-card__title"><?php echo $subtitlePopup ?></h1>
        </header>

        <div class="event-card__date-container">
            <div class="event-card__days"><?php echo $daysPopup ?></div>
            <div class="event-card__month-city">
                <span class="event-card__month"><?php echo $monthPopup ?></span>
                <span class="event-card__city"><?php echo $cityPopup ?></span>
            </div>
        </div>

        <div class="event-card__schedule-box">
            <?php foreach ($schedulePopup as $index => $schedule) {
                $parts = explode('-', $schedule);
                $day = trim($parts[0]);
                $detail = isset($parts[1]) ? trim($parts[1]) : '';
            ?>
                <div class="event-card__schedule-item">
                    <div class="event-card__schedule-day"><?php echo strtoupper($day) ?></div>
                    <div class="event-card__schedule-time"><?php echo $detail ?></div>
                    <?php if ($index < count($schedulePopup) - 1) { ?>
                        <hr class="event-card__divider">
                    <?php } ?>
                </div>
            <?php } ?>
        </div>

        <footer class="event-card__footer">
            <?php if (!empty($locationPopup['icon'])): ?>
                <img class="event-card__location-icon" src="<?php echo BASE_URL ?>public/assets/icons/<?php echo $locationPopup['icon'] ?>" alt="Icon">
            <?php endif; ?>
            <address class="event-card__address">
                <strong><?php echo $locationPopup['venue'] ?></strong>
                <?php echo !empty($locationPopup['address']) ? '| ' . $locationPopup['address'] : '' ?>
            </address>
        </footer>
    </article>
<?php } ?>