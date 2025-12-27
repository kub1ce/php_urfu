<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta property="og:image" content="https://i.pinimg.com/1200x/a1/31/80/a131807d68c577dec33901b2c65653c9.jpg">
    <meta property="og:description" content="Крутая библиотека для чтения книг и комиксов и еще чего-то причем ОНЛААЙН. Читай свои книги или если не хочешь читай чужие книги">
    <meta property="og:title" content="Книги - Библи0тека">

    <title>Книги</title>
    <link rel="icon" href="src/logo.jpg">
    
    <link rel="stylesheet" href="./sltyles.css">
</head>
<body>

<header class="header">
    <div class="logo">Библи0тека</div>
    <nav class="nav">
        <a href="index.php">Главная</a>
        <a href="readers.php">Читатели</a>
        <a href="books.php">Книги</a>
    </nav>
</header>
<main class="content">
    <section class="table-block">
        <h1>Список книг</h1>

        <table>
            <thead>
                <tr>
                    <th>№</th>
                    <th>Название</th>
                    <th>Год</th>
                    <th>Состояние</th>
                    <th>Читатель</th>
                    <th>Дата взятия</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="book-id">1</td>
                    <td class="book-mame">Как управлять вселенной, не привлекая внимания санитаров</td>
                    <td class="book-year">2017</td>
                    <td class="book-taken taken">Взята</td>
                    <td class="book-who-taked">Паук</td>
                    <td class="book-when-taked">7.1.2024</td>
                </tr>
                <tr>
                    <td class="book-id">2</td>
                    <td class="book-mame">Преступление и наказание</td>
                    <td class="book-year">1866</td>
                    <td class="book-taken">Свободна</td>
                    <td class="book-who-taked">—</td>
                    <td class="book-when-taked">—</td>
                </tr>
                <tr>
                    <td class="book-id">3</td>
                    <td class="book-mame">Как ни чего не понять и не подать виду</td>
                    <td class="book-year">1999</td>
                    <td class="book-taken taken">Взята</td>
                    <td class="book-who-taked">Иванов</td>
                    <td class="book-when-taked">01.02.2024</td>
                </tr>
                <tr>
                    <td class="book-id">4</td>
                    <td class="book-mame">Проблема сброса античных статуй из космоса</td>
                    <td class="book-year">2009</td>
                    <td class="book-taken taken">Взята</td>
                    <td class="book-who-taked">Стетхем</td>
                    <td class="book-when-taked">22.02.2024</td>
                </tr>
                <tr>
                    <td class="book-id">5</td>
                    <td class="book-mame">1984</td>
                    <td class="book-year">1949</td>
                    <td class="book-taken">Свободна</td>
                    <td class="book-who-taked">—</td>
                    <td class="book-when-taked">—</td>
                </tr>
            </tbody>
        </table>
    </section>
</main>

<footer class="footer">
    <p>© <?= date('Y') ?> Bibli0teka </p>
    <p>Контакты: casino.library.support@example.com | +7 (777) 777-77-77</p>
</footer>
</body>
</html>
