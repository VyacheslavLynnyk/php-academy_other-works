<?php include_once 'libs.php' ?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админ панель</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav id="nav">
        <div>
            <ul>
                <li><a href="index.php">Гостевая книга</a></li>
                <li><a class='active' href="admin.php">Админ панель</a></li>
            </ul>
        </div>
    </nav>
    <h1>Административная панель</h1>
    <form class="filter" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <fieldset>
            <legend>Добавить фильтруемые слова</legend>
            <input type="text" name="words" placeholder="Добавление плохих слов (через запятую)">
            <input type="submit" name="addWords" value="Добавить">
        </fieldset>
    </form>
    <form class="filter" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <fieldset>
            <legend>Удалить слова с фильтра</legend>
            <?php
            $filtersArr = getContent(FILTER_DB);
            $filtersArr = deleteWords(FILTER_DB, $filtersArr);
            $filtersArr = addFilerWords(FILTER_DB, $filtersArr);
            showFilters($filtersArr);
            ?>
            <input type="submit" name="removeWords" value="Удалить">
        </fieldset>
    </form>
</body>
</html>