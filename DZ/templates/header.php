<?php
require_once __DIR__ . '/../services/auth.php';
$user = currentUser();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">

	<meta property="og:image" content="/assets/logo.png">
    <meta property="og:description" content="Запиши желание - и пусть чудо найдёт тебя">
    <meta property="og:title" content="WishList by Kubice">

	<title>WishList</title>

	<link rel="stylesheet" href="/assets/style.css">
	<link rel="icon" type="image/x-icon" href="/assets/logo.png">
	<script src="/assets/snow.js" defer></script>
</head>
<body class="festive">
<canvas id="snow"></canvas>
<header class="site-header">
	<div class="logo">
		<h1>WishList by Kubice</h1>
		<p class="subtitle">Запиши желание - и пусть чудо найдёт тебя</p>
	</div>
	<nav>
		<?php if($user): ?>
			<span class="user">Привет, <b><?=htmlspecialchars($user['name'])?></b></span>
			<a href="/index.php">Мои желания</a>
			<a href="/index.php?users">Пользователи</a>
			<a href="/logout.php">Выйти</a>
		<?php else: ?>
			<a href="/register.php">Регистрация</a>
			<a href="/login.php">Вход</a>
		<?php endif; ?>
	</nav>
</header>
<main class="container">
