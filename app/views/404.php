<?php
require_once __DIR__ . '/../config/config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include_once __DIR__ . '/includes/head.php';
    ?>
</head>

<body>
    <div class="layout">
        <div class="aligner">
            <div class="item">
                <h1>404</h1>
                <img src="https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif" />
                <h2>Pagina non trovata</h2>
                <p>Spiacenti, la pagina che stai cercando non esiste o è stata spostata.</p>
                <a class="btn" href="<?php echo BASE_URL ?>">Torna alla Home</a>
            </div>
        </div>
    </div>
</body>

</html>