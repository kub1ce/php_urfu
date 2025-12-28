    <?php
    $config = require __DIR__ . '/../config/config.php';
    ?>

    <footer class="footer">
        <p>© <?= date('Y') ?> Bibli0teka </p>
        <p>Контакты: <?= htmlspecialchars($config['email']) ?> | <?= htmlspecialchars($config['phone']) ?></p>
    </footer>