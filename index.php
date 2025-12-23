<?php

echo "<h1>Hello, World!</h1>";

echo "<h2>Список лабораторных работ:</h2>";
echo "<ul>";
$dir = scandir(__DIR__);
foreach ($dir as $item) {
    if (substr_compare($item, 'LB', 0, 2) === 0 && is_dir($item)) {
        echo "<li><a href='$item/index.php'>Перейти в $item</a></li>";
    }
}
echo "</ul>";