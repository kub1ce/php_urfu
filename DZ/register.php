<?php

require_once __DIR__ . '/services/auth.php';
require_once __DIR__ . '/db/queries.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    if (!csrf_check($_POST['csrf_token'] ?? '')) die('CSRF');

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $pass = $_POST['password'] ?? '';
    $pass2 = $_POST['password_confirm'] ?? '';

    if ($name==='' || $email==='' || $pass===''){
        $err = 'Все поля обязательны';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $err = 'Неверный email';
    } elseif ($pass !== $pass2){
        $err = 'Пароли не совпадают';
    } else {
        if (userExistsByEmail($email)){
            $err = 'Пользователь с таким email уже существует';
        } else {
            $id = registerUser($name, $email, $pass);
            $_SESSION['user_id'] = $id;

            header('Location: /index.php');

            exit;
        }
    }
}

include __DIR__ . '/templates/header.php';

if (!empty($err)) echo '<div class="flash error">'.htmlspecialchars($err).'</div>';
?>

<h2>Регистрация</h2>
<form method="post" class="auth-form">
    <input type="hidden" name="csrf_token" value="<?=htmlspecialchars(csrf_token())?>">
    <label>Имя <input type="text" name="name" required></label>
    <label>Email <input type="email" name="email" required></label>
    <label>Пароль <input type="password" name="password" required></label>
    <label>Повторить пароль <input type="password" name="password_confirm" required></label>
    <button class="btn">Зарегистрироваться</button>
</form>

<?php include __DIR__ . '/templates/footer.php'; ?>
