<table>
    <thead>
        <tr>
            <th>№</th>
            <th>Название</th>
            <th>Год</th>
            <th>Читатель</th>
            <th>Дата взятия</th>
            <th>Дата возврата</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($books as $book): ?>
            <?php $notReturned = is_null($book['returned_at']); ?>

            <tr class="<?= $notReturned ? 'not-returned' : '' ?>">
                <td><?= $book['book_id'] ?></td>
                <td><?= htmlspecialchars($book['name']) ?></td>
                <td><?= $book['pub_year'] ?></td>

                <td>
                    <?= htmlspecialchars($book['last_name'] . ' ' . $book['first_name']) ?>
                </td>

                <td><?= $book['taken_at'] ?></td>

                <td>
                    <?= $book['returned_at'] ?? 'Не возвращена' ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>