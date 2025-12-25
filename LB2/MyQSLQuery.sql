DROP TABLE IF EXISTS log_taking;
DROP TABLE IF EXISTS readers;
DROP TABLE IF EXISTS books;

-- readers
CREATE TABLE readers (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    last_name VARCHAR(255) NOT NULL,
    first_name VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- books
CREATE TABLE books (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    pub_year VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- log_taking
CREATE TABLE log_taking (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    reader_id INT NOT NULL,
    book_id INT NOT NULL,
    taken_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    returned_at TIMESTAMP NULL DEFAULT NULL,

    CONSTRAINT fk_log_reader
        FOREIGN KEY (reader_id)
        REFERENCES readers(id)
        ON DELETE CASCADE ON UPDATE CASCADE,

    CONSTRAINT fk_log_book
        FOREIGN KEY (book_id)
        REFERENCES books(id)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5 readers
INSERT INTO readers (last_name, first_name) VALUES
('Иванов', 'Иван'),
('Апостол', 'Пётр'),
('Джейсон', 'Стетхем'),
('Человек', 'паук'),
('Тимофей', 'Радя');

-- 5 books
INSERT INTO books (name, pub_year) VALUES
('Как управлять вселенной, не привлекая внимания санитаров', '2017'),
('Преступление и наказание', '1866'),
('Как ни чего не понять и не подать виду', '1999'),
('Проблема сброса античных статуй из космоса', '2009'),
('1984', '1949');

-- 25 log_taking
INSERT INTO log_taking (reader_id, book_id, taken_at, returned_at) VALUES
(1, 1, '2024-01-01 10:00:00', '2024-01-10 12:00:00'),
(1, 2, '2024-01-15 09:30:00', '2024-01-25 14:00:00'),
(1, 3, '2024-02-01 11:00:00', NULL),
(1, 4, '2024-02-10 15:00:00', '2024-02-20 16:00:00'),
(1, 5, '2024-03-01 10:00:00', NULL),

(2, 1, '2024-01-05 10:00:00', '2024-01-12 11:00:00'),
(2, 2, '2024-01-20 13:00:00', NULL),
(2, 3, '2024-02-05 09:00:00', '2024-02-18 17:00:00'),
(2, 4, '2024-02-25 10:30:00', NULL),
(2, 5, '2024-03-05 14:00:00', '2024-03-15 10:00:00'),

(3, 1, '2024-01-03 08:00:00', '2024-01-08 09:00:00'),
(3, 2, '2024-01-18 12:00:00', NULL),
(3, 3, '2024-02-02 14:00:00', '2024-02-12 15:00:00'),
(3, 4, '2024-02-22 10:00:00', NULL),
(3, 5, '2024-03-02 11:00:00', '2024-03-12 13:00:00'),

(4, 1, '2024-01-07 09:00:00', NULL),
(4, 2, '2024-01-27 10:00:00', '2024-02-05 11:00:00'),
(4, 3, '2024-02-07 15:00:00', NULL),
(4, 4, '2024-02-27 16:00:00', '2024-03-05 17:00:00'),
(4, 5, '2024-03-07 10:00:00', NULL),

(5, 1, '2024-01-09 11:00:00', '2024-01-19 12:00:00'),
(5, 2, '2024-01-29 14:00:00', NULL),
(5, 3, '2024-02-09 10:00:00', '2024-02-19 11:00:00'),
(5, 4, '2024-02-29 12:00:00', NULL),
(5, 5, '2024-03-09 15:00:00', '2024-03-19 16:00:00');

-- 10.	Выполните запрос, который вернет информацию: когда, кем (фамилия имя), и какая книга была возвращена.
SELECT
    lt.returned_at AS returned_date,
    CONCAT(r.last_name, ' ', r.first_name) AS reader,
    b.name AS book_name
FROM log_taking lt
JOIN readers r ON r.id = lt.reader_id
JOIN books b ON b.id = lt.book_id
WHERE lt.returned_at IS NOT NULL
ORDER BY lt.returned_at;