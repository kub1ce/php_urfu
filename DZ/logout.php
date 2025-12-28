<?php

require_once __DIR__ . '/services/auth.php';
logout();
header('Location: /login.php');
exit;
