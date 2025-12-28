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
            b.id AS book_id,
            b.name,
            b.pub_year,

            r.first_name,
            r.last_name,

            lt.taken_at,
            lt.returned_at

        FROM log_taking lt
        JOIN books b ON b.id = lt.book_id
        JOIN readers r ON r.id = lt.reader_id

        ORDER BY lt.taken_at DESC
    ");

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// taken books
function getTakenBooks(PDO $link): array
{    
    $stmt = $link->prepare("
        SELECT
            b.id AS book_id,
            b.name,
            b.pub_year,

            r.first_name,
            r.last_name,

            lt.taken_at,
            lt.returned_at

        FROM log_taking lt
        JOIN books b ON b.id = lt.book_id
        AND lt.returned_at IS NULL
        JOIN readers r ON r.id = lt.reader_id

        ORDER BY lt.taken_at DESC
    ");
    $stmt->execute();
    return $stmt->fetchAll();
}
