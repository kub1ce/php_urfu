<?php
$title = 'Все книги';
require_once 'db/queries.php';

$books = getBooks($link);
?>
<!DOCTYPE html>
<html lang="ru">
<? require 'templates/meta_head.php'; ?>

<body>

<? require 'templates/header.php'; ?>

<main class="content">
    <section class="table-block">
        <h1>Все книги</h1>
        <a class="btn to-books" href="books_taken.php">Показать взятые книги</a>
        <?php require 'templates/table_books.php'; ?>
    </section>
</main>

<? include 'templates/footer.php'; ?>
</body>
</html>
