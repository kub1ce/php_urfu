<!-- Добавление данных в базу данных через PDO -->
<?php

$base = "mysql"; // pgsql или mysql

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

// 4.	Создайте новую запись в базе данных в таблице log_taking со случайной книгой из базы и со случайным читателем, дата взятия книги – сегодня, наличие даты возврата определяется случайным образом, если дата возврата должна присутствовать – ставим дату через 7 дней от текущей
$readerId = rand(1, 5);
$bookId = rand(1, 5);
$takenAt = date('Y-m-d');
$returnedAt = (rand(0, 1) === 1) ? date('Y-m-d', strtotime('+7 days')) : null;

function SQLquery($link, $query) {
    try {
        $stmt = $link->prepare($query);
        $stmt->execute();
        echo "New record created successfully. Last inserted ID is: " . $link->lastInsertId() . "<br>";
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<span style='color: red;'>Error: " . $e->getMessage() . "</span><br>";
        return [];
    }
}
    
// 5.	В случае успеха вставки запроса – распечатайте вставленный идентификатор строки, в случае провала напечатайте ошибку
$sql = "INSERT INTO log_taking (reader_id, book_id, taken_at, returned_at) VALUES ($readerId, $bookId, '$takenAt', " . ($returnedAt ? "'$returnedAt'" : "NULL") . ")";
SQLquery($link, $sql);
echo "<hr>";
// специально ОШИБКА
$sql = "INSERT INTO log_taking (reader_id, book_id, taken_at, returned_at) VALUES ($readerId, $bookId, '$takenAt', 'INVALID_DATE')";
SQLquery($link, $sql);