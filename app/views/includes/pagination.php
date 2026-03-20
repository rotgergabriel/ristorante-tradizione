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