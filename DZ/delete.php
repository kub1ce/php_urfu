<?php
require_once __DIR__ . '/services/auth.php';
require_once __DIR__ . '/db/queries.php';

requireAuth();

if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header('Location: /index.php'); exit;
}
if (!csrf_check($_POST['csrf_token'] ?? '')) die('CSRF');

$id = (int)($_POST['id'] ?? 0);
$wish = getWishUserId($id);

if (!$wish){
    header('Location: /index.php');
    exit;
}
if ($wish['user_id'] != $_SESSION['user_id']){
    die('Доступ запрещён');
}

deleteWish($id);
$_SESSION['flash_success'] = 'Желание удалено';
header('Location: /index.php');
exit;
