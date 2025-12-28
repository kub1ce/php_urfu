<?php

require_once __DIR__ . '/services/auth.php';
require_once __DIR__ . '/db/queries.php';

requireAuth();
$id = (int)($_GET['id'] ?? 0);
$wish = getWishById($id);

if (!$wish){
    header('Location: /index.php');
    exit;
}
if ($wish['user_id'] != $_SESSION['user_id']){
    die('Доступ запрещён');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (!csrf_check($_POST['csrf_token'] ?? '')) die('CSRF');

    $title = trim($_POST['title'] ?? '');
    $desc = trim($_POST['description'] ?? '');
    $is_public = isset($_POST['is_public']) ? true : false;

    if ($title === ''){
        $_SESSION['flash_error'] = 'Название пустое'; header("Location: /edit.php?id={$id}");
        exit;
    }
    updateWish($id, $title, $desc, $is_public);
    $_SESSION['flash_success'] = 'Изменено';
    header('Location: /index.php');
    exit;
}

$titleVal = $wish['title'];
$descVal = $wish['description'];
$isPublic = $wish['is_public'];
$action = '/edit.php?id='.$id;

include __DIR__ . '/templates/header.php';
if (!empty($_SESSION['flash_error'])){
    echo '<div class="flash error">'.htmlspecialchars($_SESSION['flash_error']).'</div>';
    unset($_SESSION['flash_error']);
}

include __DIR__ . '/templates/wish_form.php';
include __DIR__ . '/templates/footer.php';
