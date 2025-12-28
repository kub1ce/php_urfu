<?php
require_once __DIR__ . '/db_connect.php';

function getAllUsers() {
    $link = connectDB();
    $stmt = $link->query('SELECT id,name FROM users ORDER BY name');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getUserByEmail($email) {
    $link = connectDB();
    $stmt = $link->prepare('SELECT * FROM users WHERE email = :e');
    $stmt->execute([':e' => $email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getUserById($id) {
    $link = connectDB();
    $stmt = $link->prepare('SELECT id,name,email FROM users WHERE id = :id');
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function userExistsByEmail($email) {
    $link = connectDB();
    $stmt = $link->prepare('SELECT id FROM users WHERE email = :e');
    $stmt->execute([':e' => $email]);
    return (bool)$stmt->fetch();
}

function createUser($name, $email, $passwordHash) {
    $link = connectDB();
    $stmt = $link->prepare('INSERT INTO users (name,email,password_hash) VALUES (:n,:e,:p)');
    $stmt->execute([':n' => $name, ':e' => $email, ':p' => $passwordHash]);
    return $link->lastInsertId();
}

function getWishesByUserId($userId) {
    $link = connectDB();
    $stmt = $link->prepare('SELECT w.*, u.name FROM wishes w JOIN users u ON u.id=w.user_id WHERE w.user_id = :uid ORDER BY created_at DESC');
    $stmt->execute([':uid' => $userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getPublicWishesByUserId($userId) {
    $link = connectDB();
    $stmt = $link->prepare('SELECT w.*, u.name FROM wishes w JOIN users u ON u.id=w.user_id WHERE w.user_id = :uid AND w.is_public = true ORDER BY created_at DESC');
    $stmt->execute([':uid' => $userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getMyWishes($userId) {
    $link = connectDB();
    $stmt = $link->prepare('SELECT * FROM wishes WHERE user_id = :u ORDER BY created_at DESC');
    $stmt->execute([':u' => $userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getWishById($id) {
    $link = connectDB();
    $stmt = $link->prepare('SELECT * FROM wishes WHERE id = :id');
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getWishUserId($id) {
    $link = connectDB();
    $stmt = $link->prepare('SELECT user_id FROM wishes WHERE id = :id');
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function createWish($userId, $title, $description, $isPublic) {
    $link = connectDB();
    $stmt = $link->prepare('INSERT INTO wishes (user_id,title,description,is_public) VALUES (:u,:t,:d,:p)');
    $stmt->execute([':u' => $userId, ':t' => $title, ':d' => $description, ':p' => $isPublic]);
    return $link->lastInsertId();
}

function updateWish($id, $title, $description, $isPublic) {
    $link = connectDB();
    $stmt = $link->prepare('UPDATE wishes SET title = :t, description = :d, is_public = :p, updated_at = now() WHERE id = :id');
    $stmt->execute([':t' => $title, ':d' => $description, ':p' => $isPublic, ':id' => $id]);
    return true;
}

function deleteWish($id) {
    $link = connectDB();
    $stmt = $link->prepare('DELETE FROM wishes WHERE id = :id');
    $stmt->execute([':id' => $id]);
    return true;
}

