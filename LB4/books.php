<?php
require_once 'db/queries.php';
$books = getBooks($link);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta property="og:image" content="https://i.pinimg.com/1200x/a1/31/80/a131807d68c577dec33901b2c65653c9.jpg">
    <meta property="og:description" content="Крутая библиотека для чтения книг и комиксов и еще чего-то причем ОНЛААЙН. Читай свои книги или если не хочешь читай чужие книги">
    <meta property="og:title" content="Книги - Библи0тека">

    <title>Книги</title>
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
        <h1>Список книг</h1>

        <table>
            <thead>
                <tr>
                    <th>№</th>
                    <th>Название</th>
                    <th>Год</th>
                    <th>Состояние</th>
                    <th>Читатель</th>
                    <th>Дата взятия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td class="book-id"><?= $book['id'] ?></td>
                        <td class="book-mame"><?= htmlspecialchars($book['name']) ?></td>
                        <td class="book-year"><?= $book['pub_year'] ?></td>
                        <td class="book-taken"><?= $book['taken_at'] ? 'Взята' : 'Свободна' ?></td>
                        <td class="book-who-taked">
                            <?= $book['taken_at']
                                ? htmlspecialchars($book['reader_last_name'] . ' ' . $book['reader_first_name'])
                                : '—'
                            ?>
                        </td>
                        <td class="book-when-taked"><?= $book['taken_at'] ?? '—' ?></td>
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
