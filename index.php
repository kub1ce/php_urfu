<?php

echo "<h1>Hello, World!</h1>";

echo "<h2>Список лабораторных работ:</h2>";
echo "<ul>";
$dir = scandir(__DIR__);
foreach ($dir as $item) {
    if (substr_compare($item, 'LB', 0, 2) === 0 && is_dir(__DIR__ . '/' . $item)) {
        echo "<li>$item<ul>";
        $files = scandir(__DIR__ . '/' . $item);
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                $filePath = __DIR__ . '/' . $item . '/' . $file;
                if (is_file($filePath)) {
                    $ext = pathinfo($file, PATHINFO_EXTENSION);
                    if ($ext === 'php') {
                        $href = "$item/$file";
                    } else {
                        $href = "$item/$file";
                    }
                    echo "<li><a href='$href'>$file</a></li>";
                }
            }
        }
        echo "</ul></li>";
    }
}
echo "</ul>";