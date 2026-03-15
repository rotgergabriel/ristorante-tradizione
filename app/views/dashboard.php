<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../middleware/auth.php';

if (isset($_POST['delete_id'])) {
    $id_delete = (int)$_POST['delete_id'];
    $sql_delete = "DELETE FROM recipes WHERE id = $id_delete";
    mysqli_query($conn, $sql_delete);
    header("Location: " . BASE_URL . "dashboard");
    exit();
}

if (isset($_POST['submit'])) {
    if (!empty($_POST['recipe_title']) && !empty($_POST['recipe_description'])) {
        $title = mysqli_real_escape_string($conn, $_POST['recipe_title']);
        $subtitle = mysqli_real_escape_string($conn, $_POST['recipe_subtitle']);
        $description = mysqli_real_escape_string($conn, $_POST['recipe_description']);
        $complete_process = mysqli_real_escape_string($conn, $_POST['complete_process']);
        $preparation_time = mysqli_real_escape_string($conn, $_POST['recipe_time']);
        $recipe_id = $_POST['recipe_id'];

        if (!empty($recipe_id)) {
            $recipe_id = (int)$recipe_id;
            $sql = "UPDATE recipes SET title='$title', subtitle='$subtitle', description='$description', complete_process='$complete_process', preparation_time='$preparation_time' WHERE id = $recipe_id";
            $message = "¡Ricetta aggiornata con successo!";
        } else {
            $sql = "INSERT INTO recipes (title, subtitle, description, complete_process, preparation_time) VALUES ('$title', '$subtitle', '$description', '$complete_process', '$preparation_time')";
            $message = "¡Ricetta salvata con successo!";
        }

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('$message'); window.location.href='" . BASE_URL . "dashboard';</script>";
            exit();
        } else {
            echo "<div style='color:red;'>Errore: " . mysqli_error($conn) . "</div>";
        }
    }
}

$row_edit = ['id' => '', 'title' => '', 'subtitle' => '', 'description' => '', 'complete_process' => '', 'preparation_time' => ''];
if (isset($_GET['edit_id'])) {
    $edit_id = (int)$_GET['edit_id'];
    $sql_edit = "SELECT * FROM recipes WHERE id = $edit_id";
    $result_edit = mysqli_query($conn, $sql_edit);
    if ($result_edit && $row = mysqli_fetch_assoc($result_edit)) {
        $row_edit = $row;
    }
}

$registros_por_pagina = 8;
$pagina_actual = isset($_GET['p']) ? (int)$_GET['p'] : 1;
if ($pagina_actual < 1) $pagina_actual = 1;
$offset = ($pagina_actual - 1) * $registros_por_pagina;

$filter = "";
$query_param = "";
if (isset($_GET['filter_query']) && $_GET['filter_query'] != '') {
    $busqueda = mysqli_real_escape_string($conn, $_GET['filter_query']);
    $filter = " WHERE title LIKE '%$busqueda%'";
    $query_param = "&filter_query=" . urlencode($_GET['filter_query']);
}

$res_count = mysqli_query($conn, "SELECT COUNT(*) as total FROM recipes $filter");
$total_registros = mysqli_fetch_assoc($res_count)['total'];
$total_paginas = ceil($total_registros / $registros_por_pagina);

$sql_list = "SELECT id, title FROM recipes $filter ORDER BY title ASC LIMIT $registros_por_pagina OFFSET $offset";
$stmt = mysqli_query($conn, $sql_list);

$head_title = 'Dashboard di Gestione | Ristorante Pizzeria Tradizione';
$pageKey = 'dashboard';
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <?php
    include_once __DIR__ . '/includes/head.php';
    ?>
</head>

<body>
    <div class="layout <?php echo $pageKey ?>">
        <header class="admin-header">
            <h1>Dashboard</h1>
            <nav class="admin-nav">
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>">Home</a></li>
                    <li><a href="<?php echo BASE_URL; ?>logoutController">Log out</a></li>
                </ul>
            </nav>
        </header>
        <main class="admin-main">
            <div class="maintenance">
                <div class="maintenance-container">
                    <div class="user-profile-card">
                        <div class="user-info">
                            <p class="badge-role">
                                <?php echo htmlspecialchars($_SESSION['role']); ?>
                            </p>
                            <p class="welcome-text">Benvenuto,</p>
                            <strong class="user-name"><?php echo htmlspecialchars($_SESSION['username']); ?></strong>
                        </div>
                    </div>
                    <div class="maintenance-status">
                        <span class="status-label">Modo</span>
                        <label class="switch">
                            <input type="checkbox" id="maintenance-toggle">
                            <span class="slider round"></span>
                        </label>
                        <span id="status-text" class="status-text">
                        </span>
                    </div>
                </div>
            </div>
            <div>
                <div class="dashboard-container">
                    <section class="content-section form-column">
                        <h2 class="section-title"><?php echo $row_edit['id'] ? 'Modifica Ricetta' : 'Aggiungi Ricetta'; ?></h2>
                        <form action="" method="POST" class="recipe-form" enctype="multipart/form-data">
                            <input type="hidden" name="recipe_id" value="<?php echo $row_edit['id'] ?>">
                            <div class="form-group">
                                <label for="recipe_title">Titolo della Ricetta:</label>
                                <input type="text" id="recipe_title" name="recipe_title" value="<?php echo htmlspecialchars($row_edit['title']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="subtitle">Sottotitolo:</label>
                                <input type="text" id="subtitle" name="recipe_subtitle" value="<?php echo htmlspecialchars($row_edit['subtitle']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="recipe_description">Descrizione Completa:</label>
                                <textarea id="recipe_description" name="recipe_description" rows="3" required><?php echo htmlspecialchars($row_edit['description']) ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="complete_process" class="etiqueta-admin">Procedimento Dettagliato</label>
                                <textarea name="complete_process" id="complete_process" class="input-admin" rows="3" required><?php echo htmlspecialchars($row_edit['complete_process']) ?></textarea>
                            </div>
                            <div class="form-group time-group">
                                <label for="recipe_time">Tempo di Preparazione:</label>
                                <input type="text" id="recipe_time" name="recipe_time" value="<?php echo htmlspecialchars($row_edit['preparation_time']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="recipe_image">Immagine:</label>
                                <input type="file" id="recipe_image" name="recipe_image" accept="image/*">
                            </div>
                            <div class="form-actions-edit">
                                <div class="primary-actions">
                                    <button type="submit" name="submit" class="btn-primary">
                                        💾 <?php echo $row_edit['id'] ? 'Aggiorna Ricetta' : 'Salva Ricetta'; ?>
                                    </button>
                                </div>
                                <div class="secondary-actions">
                                    <?php if ($row_edit['id']): ?>
                                        <a href="<?php echo BASE_URL; ?>dashboard" class="btn-secondary">🔄 Annulla</a>
                                    <?php else: ?>
                                        <button type="reset" class="btn-secondary">🔄 Reset</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </form>
                    </section>
                    <section class="list-column">
                        <h2 class="section-title">Ricette Esistenti</h2>
                        <form action="" method="GET" class="list-search-container">
                            <input type="text" name="filter_query" placeholder="🔍 Filtra per nome..." value="<?php echo isset($_GET['filter_query']) ? htmlspecialchars($_GET['filter_query']) : ''; ?>">
                        </form>
                        <div class="recipe-list">
                            <?php if (mysqli_num_rows($stmt) > 0): ?>
                                <?php while ($row = mysqli_fetch_assoc($stmt)): ?>
                                    <div class="recipe-item">
                                        <span class="recipe-item-title"><?php echo htmlspecialchars($row['title']); ?></span>
                                        <div class="recipe-item-actions">
                                            <a href="?edit_id=<?php echo $row['id']; ?>" class="btn-update-small" style="text-decoration:none;">✏️</a>
                                            <form action="" method="POST" style="display:inline;" onsubmit="return confirm('Eliminare questa ricetta?');">
                                                <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                                <button type="submit" class="btn-delete-small">🗑️</button>
                                            </form>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <p>Nessuna ricetta trovata.</p>
                            <?php endif; ?>
                            <div class="pagination">
                                <?php
                                $rango = 2;
                                if ($pagina_actual > 1) {
                                    echo "<a href='?p=1$query_param'>&laquo; Inizio</a>";
                                }
                                for ($i = 1; $i <= $total_paginas; $i++) {
                                    if ($i == 1 || $i == $total_paginas || ($i >= $pagina_actual - $rango && $i <= $pagina_actual + $rango)) {
                                        $class = ($pagina_actual == $i) ? 'active' : '';
                                        echo "<a href='?p=$i$query_param' class='$class'>$i</a>";
                                    } elseif ($i == $pagina_actual - $rango - 1 || $i == $pagina_actual + $rango + 1) {
                                        echo "<span style='padding: 8px;'>...</span>";
                                    }
                                }
                                if ($pagina_actual < $total_paginas) {
                                    echo "<a href='?p=$total_paginas$query_param'>Fine &raquo;</a>";
                                }
                                ?>
                            </div>
                        </div>
                    </section>
                </div>
        </main>
        <footer class="admin-footer">
            <p> Copyright &copy; 2026 - Rotger Gabriel - Pannello di Amministrazione</p>
        </footer>
    </div>
    <script type="module" src="<?php echo BASE_URL; ?>public/js/interfaceManager.js"></script>
</body>

</html>