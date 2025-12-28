<?php
require_once __DIR__ . '/services/auth.php';
require_once __DIR__ . '/db/queries.php';

$user = currentUser();

// users list
if (isset($_GET['users'])) {
    $users = getAllUsers();
    include __DIR__ . '/templates/header.php';
    echo '<h2>Пользователи</h2><ul class="users-list">';

    foreach($users as $u) {
        echo '<li><a href="/index.php?user_id='.$u['id'].'">'.htmlspecialchars($u['name']).'</a></li>';
    }

    echo '</ul>';

    include __DIR__ . '/templates/footer.php';
    exit;
}

// wishes
if (isset($_GET['user_id'])) {
    $uid = (int)$_GET['user_id'];
    $isOwner = $user && $user['id'] == $uid;
    
    if ($isOwner) {
        $wishes = getWishesByUserId($uid);
    } else {
        $wishes = getPublicWishesByUserId($uid);
    }

    include __DIR__ . '/templates/header.php';
    include __DIR__ . '/templates/wishes_list.php';
    include __DIR__ . '/templates/footer.php';

    exit;
}

// create wish + post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    requireAuth();
    if (!csrf_check($_POST['csrf_token'] ?? '')) {
        die('CSRF check failed');
    }

    $title = trim($_POST['title'] ?? '');
    $desc  = trim($_POST['description'] ?? '');
    $is_public = isset($_POST['is_public']) ? true : false;

    if ($title === '') {
        $_SESSION['flash_error'] = 'Название не может быть пустым';
        header('Location: /index.php');
        exit;
    }

    createWish($_SESSION['user_id'], $title, $desc, $is_public);
    $_SESSION['flash_success'] = 'Желание добавлено';
    header('Location: /index.php');

    exit;
}

// user wishes pega
requireAuth();
$wishes = getMyWishes($_SESSION['user_id']);
$currentUserId = $_SESSION['user_id'];

include __DIR__ . '/templates/header.php';
if (!empty($_SESSION['flash_error'])){
    echo '<div class="flash error">'.htmlspecialchars($_SESSION['flash_error']).'</div>';
    unset($_SESSION['flash_error']);
}
if (!empty($_SESSION['flash_success'])){
    echo '<div class="flash success">'.htmlspecialchars($_SESSION['flash_success']).'</div>';
    unset($_SESSION['flash_success']);
}

// fotm
$action = '/index.php';
$titleVal = '';
$descVal = '';
$isPublic = true;
include __DIR__ . '/templates/wish_form.php';

// wshs list
include __DIR__ . '/templates/wishes_list.php';
include __DIR__ . '/templates/footer.php';
