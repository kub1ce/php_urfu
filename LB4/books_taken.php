<?php
$title = 'Взятые книги';
require_once 'db/queries.php';

$books = getTakenBooks($link);
?>
<!DOCTYPE html>
<html lang="ru">
<? require 'templates/meta_head.php'; ?>

<body>

<? require 'templates/header.php'; ?>
<main class="content">
    <section class="table-block">
        <h1>Взятые книги</h1>
        <a class="btn to-books" href="books2.php">← Назад ко всем книгам</a>
        <?php require 'templates/table_books.php'; ?>
    </section>
</main>

<? require 'templates/footer.php' ?>
</body>
</html>
