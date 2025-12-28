<?php
$config = require './config/config.php';
?>

<header class="header">
    <div class="logo">Библи0тека</div>
    <nav class="nav">
        <a href="index.php">Главная</a>
        <a href="readers.php">Читатели</a>
        <a href="books.php">Книги</a>
    </nav>
    <div class="header-phone"><?= htmlspecialchars($config['phone']) ?></div>
</header>