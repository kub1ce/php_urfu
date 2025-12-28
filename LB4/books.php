<?php
$title = 'Взятые книги';
require_once 'db/queries.php';

$isTakenOnly = isset($_GET['taken']);
$books = $isTakenOnly ? getTakenBooks($link) : getBooks($link);
$title = $isTakenOnly ? 'Взятые книги' : 'Все книги';

?>
<!DOCTYPE html>
<html lang="ru">

<?php require 'templates/meta_head.php'; ?>

<?php require 'templates/header.php'; ?>

<main class="content">
    <section class="table-block">
        <h1><?= $isTakenOnly ? 'Невозвращенные книги' : 'История взятия книг' ?></h1>

        <?php if ($isTakenOnly): ?>
            <a class="btn to-books" href="books.php">← Назад ко всем книгам</a>
        <?php else: ?>
            <a class="btn to-books" href="books.php?taken=1">Показать взятые книги</a>
        <?php endif; ?>

        <?php require 'templates/table_books.php'; ?>
    </section>
</main>

<?php require 'templates/footer.php'; ?>

</body>
</html>