<?php

require_once __DIR__ . '/services/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (!csrf_check($_POST['csrf_token'] ?? '')) die('CSRF');

    $email = trim($_POST['email'] ?? '');
    $pass = $_POST['password'] ?? '';

    if (loginUser($email, $pass)){
        header('Location: /index.php');
        exit;
    } else {
        $err = 'Неверные учетные данные';
    }
}
include __DIR__ . '/templates/header.php';

if (!empty($err)){
    echo '<div class="flash error">'.htmlspecialchars($err).'</div>';
}
?>

<h2>Вход</h2>
<form method="post" class="auth-form">
    <input type="hidden" name="csrf_token" value="<?=htmlspecialchars(csrf_token())?>">
    <label>Email <input type="email" name="email" required></label>
    <label>Пароль <input type="password" name="password" required></label>
    <button class="btn">Войти</button>
</form>

<?php include __DIR__ . '/templates/footer.php'; ?>
