<?php

$servername = "localhost";
$port = "5432";
$username = "postgres";
$password = "password";
$dbname = "PHP_ROZHKOV";

try {
    $link = new PDO("pgsql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
