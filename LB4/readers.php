<?php
require_once 'db/queries.php';
$readers = getReaders($link);

$title = 'Читатели';
?>
<!DOCTYPE html>
<html lang="ru">
<? include 'templates/meta_head.php' ?>
<body>
    
<? include 'templates/header.php' ?>

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

<?php require 'templates/footer.php'; ?>

</body>
</html>
