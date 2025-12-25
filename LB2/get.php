<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php_rozhkov";
$link = mysqli_connect($servername, $username, $password, $dbname);
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

// запрос, который вернет информацию: когда, кем (фамилия имя), и какая книга была возвращена
$sql = "SELECT
            lt.returned_at AS returned_date,
            CONCAT(r.last_name, ' ', r.first_name) AS reader,
            b.name AS book_name,
            lt.taken_at AS taken_date
        FROM log_taking lt
        JOIN readers r ON r.id = lt.reader_id
        JOIN books b ON b.id = lt.book_id
        ORDER BY lt.taken_at;";
$result = mysqli_query($link, $sql);
// 5.	Выведите все возвращенные строки в формате, каждый с новой строки:
// LAST_NAME FIRST_NAME взял книгу BOOK_NAME TAKEN_DATE, и вернул ее RETURN_DATE
// Если человек не вернул книгу, то строка должна быть 
// LAST_NAME FIRST_NAME взял книгу BOOK_NAME TAKEN_DATE, и не вернул ее


while ($row = mysqli_fetch_assoc($result)) {
    // if ($row['returned_date'] !== null) {
    //     echo $row['reader'] . " взял книгу " . $row['book_name'] . ", и вернул ее " . $row['returned_date'] . "\n";
    // } else {
    //     echo $row['reader'] . " взял книгу " . $row['book_name'] . ", и не вернул ее\n";
    // }
    $returnedInfo = $row['returned_date'] !== null ? ", и вернул ее " . $row['returned_date'] : ", и не вернул ее";
    $ending = php_sapi_name() === 'cli' ? PHP_EOL : "<br>";
    echo $row['reader'] . " взял книгу " . $row['book_name'] . " " . $row['taken_date'] . $returnedInfo . $ending;
}

mysqli_close($link);