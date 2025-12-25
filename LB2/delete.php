<?php

$base = "pgsql"; // pgsql или mysql

// Использую аналогичную базу, но в PostgreSQL
$servername = "localhost";
$port = "5432";
$username = "postgres";
$password = "password";
$dbname = "PHP_ROZHKOV";

// Изменил обратно на MySQL т.к. приходится работать с одной базой из get.php(
if ($base === "mysql") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "php_rozhkov";
}

try {
    if ($base === "pgsql") {
        $link = new PDO("pgsql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    } else {
        $link = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    }
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully!<br><br>";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// получение параметра id из запроса GET
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
echo "ID to delete: $id<br>";
if ($id === null) {
    die("No ID provided for deletion.");
}

// 6.	Используя полученный параметр, выполните запрос на удаление записи из таблицы log_taking по указанному идентификатору
// 7.	В случае успеха удаления – распечатайте слово «Удалено», в случае провала напечатайте ошибку
// 8.	Продемонстрируйте успешный и не успешный запрос
// 9.	После выполнения успешного запроса убедитесь через клиент СУБД, что строка удалена

function SQLquery($link, $query) {
    global $id;
    try {
        $stmt = $link->prepare($query);
        $stmt->execute();
        $rowCount = $stmt->rowCount();
        if ($rowCount > 0) {
            echo "Удалено $rowCount записей";
        } else {
            echo "Запись с ID $id не найдена, ничего не удалено";
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<span style='color: red;'>Error: " . $e->getMessage() . "</span><br>";
        return [];
    }
}

// запрос
$sql = "DELETE FROM log_taking WHERE id = $id";
SQLquery($link, $sql);
echo "<hr>";
// error запрос
$sql = "DELETE FROM log_taking WHERE id = " . ($id * 2402); // Id не существует
echo "Attempting to delete non-existing ID: " . $sql . "<br>";
SQLquery($link, $sql);
