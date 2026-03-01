
<?php
//function (array, boolean, title)
function printArray($array, $debug = false, $title = 'Debugger') {
    if ($debug) {
        echo "<h4><strong>$title</strong></h4>";
        echo "<pre>";
        print_r($array);
        echo "</pre>";
        echo '<br>';
    }
}
?>

<?php
session_start();
printArray($_POST, true, 'Post');

$search = strtolower(trim($_POST['menu-search']));
$carrito = [];

if ($search !== '' && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/u', $search)) {
    echo "Busqueda realizada: $search <br>";
    if(!in_array($search, $_SESSION['menu-search'] ?? [])) {
        //Historial
        $_SESSION['history'][] = $search;
    }
} else {
        echo "No ingresaste ningun valor valido o ya existe en el historial";
    }

printArray($_SESSION, true, 'Session');
?>