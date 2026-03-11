<?php
//function (array, boolean, title)
function printArray($array, $debug = false, $title = 'Debugger')
{
    if ($debug) {
        echo "<h4><strong>$title</strong></h4>";
        echo "<pre>";
        print_r($array);
        echo "</pre>";
        echo '<br>';
    }
}
?>