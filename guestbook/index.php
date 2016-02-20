<?php
    error_reporting(E_ALL);
    define('ROOT', dirname(__FILE__));
    include_once ROOT.'/libs.php';
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <article id="article">
        <h1>Гостевая книга</h1>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
            <input id="login" type="text" name="userName" placeholder="Введите свое Имя">
            <textarea id="pass" name="userMessage" cols="40" rows="3" placeholder="Оставьте свой коментарий"></textarea>
            <input id="submit-button" type="submit" name="submit" value="Отправка">
        </form>
        <div id="window-messages">

            <?php

            $messages = getContent(DB);
            $messages = addContent(DB, $messages);
            showContent($messages);

            ?>
        </div>
    </article>
</body>
</html>