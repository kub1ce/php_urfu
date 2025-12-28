<?php
require_once __DIR__ . '/../db/db_connect.php';
require_once __DIR__ . '/../db/queries.php';
session_start();

function csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_check($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

function registerUser($name, $email, $password) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    return createUser($name, $email, $hash);
}

function loginUser($email, $password) {
    $user = getUserByEmail($email);
    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        return true;
    }
    return false;
}

function currentUser() {
    if (empty($_SESSION['user_id'])) return null;
    return getUserById($_SESSION['user_id']);
}

function requireAuth() {
    if (empty($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }
}

function logout() {
    $_SESSION = [];
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
}