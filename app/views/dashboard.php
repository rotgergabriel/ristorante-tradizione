<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../middleware/auth.php';

// --- LÓGICA DE ELIMINACIÓN Y GUARDADO DE MENÚ ---
if (isset($_POST['delete_menu_id'])) {
    $id_delete = (int)$_POST['delete_menu_id'];
    mysqli_query($conn, "DELETE FROM menu_items WHERE id = $id_delete");
    header("Location: " . BASE_URL . "dashboard?menu_open=1");
    exit();
}

if (isset($_POST['submit_menu'])) {
    $category_name = mysqli_real_escape_string($conn, $_POST['category_title']);
    $product_title = mysqli_real_escape_string($conn, $_POST['product_title']);
    $product_desc  = mysqli_real_escape_string($conn, $_POST['product_description']);
    $product_price = (float)str_replace(',', '.', $_POST['product_price']);
    $menu_id       = $_POST['menu_id'];

    $res_cat = mysqli_query($conn, "SELECT id FROM menu_categories WHERE name = '$category_name' LIMIT 1");
    if ($row_cat = mysqli_fetch_assoc($res_cat)) {
        $category_id = $row_cat['id'];
    } else {
        $slug = strtoupper(str_replace(' ', '_', $category_name));
        mysqli_query($conn, "INSERT INTO menu_categories (name, slug) VALUES ('$category_name', '$slug')");
        $category_id = mysqli_insert_id($conn);
    }

    if (!empty($menu_id)) {
        $menu_id = (int)$menu_id;
        $sql = "UPDATE menu_items SET category_id=$category_id, name='$product_title', description='$product_desc', price=$product_price WHERE id=$menu_id";
        $msg = "Prodotto aggiornato!";
    } else {
        $sql = "INSERT INTO menu_items (category_id, name, description, price) VALUES ($category_id, '$product_title', '$product_desc', $product_price)";
        $msg = "Prodotto aggiunto al menú!";
    }

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('$msg'); window.location.href='" . BASE_URL . "dashboard?menu_open=1';</script>";
        exit();
    }
}

// --- LÓGICA DE EDICIÓN MENÚ ---
$menu_edit = ['id' => '', 'category_name' => '', 'name' => '', 'description' => '', 'price' => ''];
if (isset($_GET['edit_menu_id'])) {
    $edit_menu_id = (int)$_GET['edit_menu_id'];
    $sql_m = "SELECT m.*, c.name as cat_name FROM menu_items m JOIN menu_categories c ON m.category_id = c.id WHERE m.id = $edit_menu_id";
    $res_m = mysqli_query($conn, $sql_m);
    if ($row_m = mysqli_fetch_assoc($res_m)) {
        $menu_edit = [
            'id' => $row_m['id'],
            'category_name' => $row_m['cat_name'],
            'name' => $row_m['name'],
            'description' => $row_m['description'],
            'price' => $row_m['price']
        ];
    }
}

// --- PAGINACIÓN Y LISTADO DE MENÚ ---
$regs_menu = 8;
$p_menu = isset($_GET['pm']) ? (int)$_GET['pm'] : 1;
if ($p_menu < 1) $p_menu = 1;
$off_menu = ($p_menu - 1) * $regs_menu;

$menu_filter = "";
$menu_param = "";
if (isset($_GET['menu_query']) && $_GET['menu_query'] != '') {
    $busqueda_m = mysqli_real_escape_string($conn, $_GET['menu_query']);
    $menu_filter = " WHERE name LIKE '%$busqueda_m%' OR description LIKE '%$busqueda_m%'";
    $menu_param = "&menu_query=" . urlencode($_GET['menu_query']);
}

$res_count_m = mysqli_query($conn, "SELECT COUNT(*) as total FROM menu_items $menu_filter");
$total_menu = mysqli_fetch_assoc($res_count_m)['total'];
$total_paginas_menu = ceil($total_menu / $regs_menu);

$sql_menu_list = "SELECT * FROM menu_items $menu_filter ORDER BY id DESC LIMIT $regs_menu OFFSET $off_menu";
$res_menu_list = mysqli_query($conn, $sql_menu_list);


// --- LÓGICA DE RECETAS (RICETTE) - NO TOCAR ---
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

// --- OTROS AJUSTES ---
$sql_maint = "SELECT setting_value FROM site_settings WHERE setting_key = 'maintenance_mode' LIMIT 1";
$res_maint = mysqli_query($conn, $sql_maint);
$is_maintenance_on = (mysqli_fetch_assoc($res_maint)['setting_value'] == 1);

$menuOpen = (isset($_GET['menu_query']) || isset($_GET['edit_menu_id']) || isset($_GET['menu_open']) || isset($_GET['pm']));
$recipeOpen = (isset($_GET['edit_id']) || isset($_GET['filter_query']) || isset($_GET['p']) || isset($_POST['submit']));

$head_title = 'Dashboard di Gestione | Ristorante Pizzeria Tradizione';
$pageKey = 'dashboard';
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <?php include_once __DIR__ . '/includes/head.php'; ?>
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
                            <p class="badge-role"><?php echo htmlspecialchars($_SESSION['role']); ?></p>
                            <p class="welcome-text">Benvenuto,</p>
                            <strong class="user-name"><?php echo htmlspecialchars($_SESSION['username']); ?></strong>
                        </div>
                    </div>
                    <div class="maintenance-status">
                        <label class="switch">
                            <input type="checkbox" id="maintenance-toggle" <?php echo $is_maintenance_on ? 'checked' : ''; ?>>
                            <span class="slider round"></span>
                        </label>
                        <span id="status-text" class="status-text"></span>
                    </div>
                </div>
            </div>

            <div class="native-accordion">
                <details class="accordion-item" <?php echo $menuOpen ? 'open' : ''; ?>>
                    <summary class="accordion-header">
                        <span class="header-title">Menú (Pizze, Bevande, Vini)</span>
                        <span class="icon">▾</span>
                    </summary>
                    <div class="accordion-body">
                        <div class="dashboard-container">
                            <section class="content-section form-column">
                                <h2 class="section-title"><?php echo $menu_edit['id'] ? 'Modifica Elemento' : 'Aggiungi al Menú'; ?></h2>
                                <form action="" method="POST" class="recipe-form">
                                    <input type="hidden" name="menu_id" value="<?php echo $menu_edit['id']; ?>">
                                    <div class="form-group">
                                        <label for="category_title">Titolo Categoria:</label>
                                        <input type="text" id="category_title" name="category_title" value="<?php echo htmlspecialchars($menu_edit['category_name']); ?>" placeholder="es: LE NOSTRE PIZZE" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_title">Titolo del Prodotto:</label>
                                        <input type="text" id="product_title" name="product_title" value="<?php echo htmlspecialchars($menu_edit['name']); ?>" placeholder="es: Pizza Margherita" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_description">Descrizione / Ingredienti:</label>
                                        <textarea id="product_description" name="product_description" rows="2" placeholder="es: Pomodoro..." required><?php echo htmlspecialchars($menu_edit['description']); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_price">Prezzo (€):</label>
                                        <input type="text" id="product_price" name="product_price" value="<?php echo htmlspecialchars($menu_edit['price']); ?>" placeholder="es: 8,00" required>
                                    </div>
                                    <div class="form-actions-edit">
                                        <div class="primary-actions">
                                            <button type="submit" name="submit_menu" class="btn-primary">💾 Salva nel Menú</button>
                                        </div>
                                        <div class="secondary-actions">
                                            <a href="?menu_open=1" class="btn-secondary">🔄 Reset/Annulla</a>
                                        </div>
                                    </div>
                                </form>
                            </section>

                            <section class="list-column">
                                <h2 class="section-title">Elementi nel Menú</h2>
                                <form action="" method="GET" class="list-search-container form-group">
                                    <input type="hidden" name="menu_open" value="1">
                                    <label for="menu_query">Cerca nel menù</label>
                                    <input type="text" name="menu_query" id="menu_query" value="<?php echo isset($_GET['menu_query']) ? htmlspecialchars($_GET['menu_query']) : ''; ?>" placeholder="🔍 Filtra record...">
                                </form>

                                <div class="recipe-list">
                                    <?php if (mysqli_num_rows($res_menu_list) > 0) {
                                        while ($m_item = mysqli_fetch_assoc($res_menu_list)) { ?>
                                            <div class="recipe-item">
                                                <div class="item-info">
                                                    <span class="recipe-item-title">
                                                        <?php echo htmlspecialchars($m_item['name']); ?>
                                                        <span style="color: #2ecc71;">(€<?php echo number_format($m_item['price'], 2, ',', '.'); ?>)</span>
                                                    </span>
                                                </div>
                                                <div class="recipe-item-actions">
                                                    <a href="?edit_menu_id=<?php echo $m_item['id']; ?>" class="btn-update-small">✏️</a>
                                                    <form action="" method="POST" style="display:inline;" onsubmit="return confirm('Eliminare questo elemento?');">
                                                        <input type="hidden" name="delete_menu_id" value="<?php echo $m_item['id']; ?>">
                                                        <button type="submit" class="btn-delete-small">🗑️</button>
                                                    </form>
                                                </div>
                                            </div>
                                    <?php }
                                    } else {
                                        echo "<p>Nessun elemento trovato.</p>";
                                    } ?>

                                    <div class="pagination">
                                        <?php for ($i = 1; $i <= $total_paginas_menu; $i++): ?>
                                            <a href="?pm=<?php echo $i . $menu_param; ?>&menu_open=1" class="<?php echo ($p_menu == $i) ? 'active' : ''; ?>"><?php echo $i; ?></a>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </details>
            </div>

            <div class="native-accordion">
                <details class="accordion-item" <?php echo $recipeOpen ? 'open' : ''; ?>>
                    <summary class="accordion-header">
                        <span class="header-title">Ricette</span>
                        <span class="icon">▾</span>
                    </summary>
                    <div class="accordion-body">
                        <div class="dashboard-container">
                            <section class="content-section form-column">
                                <h2 class="section-title"><?php echo $row_edit['id'] ? 'Modifica Ricetta' : 'Aggiungi Ricetta'; ?></h2>
                                <form action="" method="POST" class="recipe-form" enctype="multipart/form-data">
                                    <input type="hidden" name="recipe_id" value="<?php echo $row_edit['id'] ?>">
                                    <div class="form-group">
                                        <label for="recipe_title">Titolo della Ricetta:</label>
                                        <input type="text" id="recipe_title" name="recipe_title" placeholder="Es: Pizza Margherita" value="<?php echo htmlspecialchars($row_edit['title']) ?>" required>
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
                                        <label for="complete_process">Procedimento Dettagliato</label>
                                        <textarea name="complete_process" id="complete_process" rows="3" required><?php echo htmlspecialchars($row_edit['complete_process']) ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="recipe_time">Tempo:</label>
                                        <input type="text" id="recipe_time" name="recipe_time" value="<?php echo htmlspecialchars($row_edit['preparation_time']) ?>" required>
                                    </div>
                                    <div class="form-actions-edit">
                                        <button type="submit" name="submit" class="btn-primary">💾 Salva Ricetta</button>
                                    </div>
                                </form>
                            </section>

                            <section class="list-column">
                                <h2 class="section-title">Ricette Esistenti</h2>
                                <form action="" method="GET" class="list-search-container form-group">
                                    <input type="text" name="filter_query" placeholder="🔍 Filtra..." value="<?php echo isset($_GET['filter_query']) ? htmlspecialchars($_GET['filter_query']) : ''; ?>">
                                </form>
                                <div class="recipe-list">
                                    <?php while ($row = mysqli_fetch_assoc($stmt)) { ?>
                                        <div class="recipe-item">
                                            <span class="recipe-item-title"><?php echo htmlspecialchars($row['title']); ?></span>
                                            <div class="recipe-item-actions">
                                                <a href="?edit_id=<?php echo $row['id']; ?>" class="btn-update-small">✏️</a>
                                                <form action="" method="POST" style="display:inline;">
                                                    <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                                    <button type="submit" class="btn-delete-small">🗑️</button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <div class="pagination">
                                        <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                                            <a href="?p=<?php echo $i . $query_param; ?>" class="<?php echo ($pagina_actual == $i) ? 'active' : ''; ?>"><?php echo $i; ?></a>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </details>
            </div>
        </main>
    </div>
    <script type="module" src="<?php echo BASE_URL; ?>public/js/interfaceManager.js"></script>
</body>

</html>