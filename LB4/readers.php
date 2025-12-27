<?php
require_once 'db/queries.php';
$readers = getReaders($link);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta property="og:image" content="https://i.pinimg.com/1200x/a1/31/80/a131807d68c577dec33901b2c65653c9.jpg">
    <meta property="og:description" content="Крутая библиотека для чтения книг и комиксов и еще чего-то причем ОНЛААЙН. Читай свои книги или если не хочешь читай чужие книги">
    <meta property="og:title" content="Читатели - Библи0тека">

    <title>Читатели</title>
    <link rel="icon" href="src/logo.jpg">
    
    <link rel="stylesheet" href="./sltyles.css">
</head>
<body>

<header class="header">
    <div class="logo">Библи0тека</div>
    <nav class="nav">
        <a href="index.php">Главная</a>
        <a href="readers.php">Читатели</a>
        <a href="books.php">Книги</a>
    </nav>
</header>

<main class="content">
    <section class="table-block">
        <h1>Список читателей</h1>

        <table>
            <thead>
                <tr>
                    <th>№</th>
                    <th>Имя</th>
                    <th>Фамилия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($readers as $reader): ?>
                    <tr>
                        <td><?= htmlspecialchars($reader['id']) ?></td>
                        <td><?= htmlspecialchars($reader['first_name']) ?></td>
                        <td><?= htmlspecialchars($reader['last_name']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</main>

<footer class="footer">
    <p>© <?= date('Y') ?> Bibli0teka </p>
    <p>Контакты: casino.library.support@example.com | +7 (777) 777-77-77</p>
</footer>

</body>
</html>
