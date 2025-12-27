<?php
require_once 'db.php';

// readers
function getReaders(PDO $link): array
{
    $stmt = $link->prepare("
        SELECT id, first_name, last_name
        FROM readers
        ORDER BY id
    ");
    $stmt->execute();
    return $stmt->fetchAll();
}

// current book status
function getBooks(PDO $link): array
{
    $stmt = $link->prepare("
        SELECT
            b.id,
            b.name,
            b.pub_year,
            r.last_name AS reader_last_name,
            r.first_name AS reader_first_name,
            lt.taken_at
        FROM books b
        LEFT JOIN log_taking lt 
            ON lt.book_id = b.id
           AND lt.returned_at IS NULL
        LEFT JOIN readers r 
            ON r.id = lt.reader_id
        ORDER BY b.id
    ");
    $stmt->execute();
    return $stmt->fetchAll();
}

// book recieve
function getReturnedBooks(PDO $link): array
{
    $stmt = $link->prepare("
        SELECT
            lt.returned_at,
            r.last_name || ' ' || r.first_name AS reader,
            b.name AS book_name
        FROM log_taking lt
        JOIN readers r ON r.id = lt.reader_id
        JOIN books b ON b.id = lt.book_id
        WHERE lt.returned_at IS NOT NULL
        ORDER BY lt.returned_at
    ");
    $stmt->execute();
    return $stmt->fetchAll();
}
