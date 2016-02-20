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
    <nav id="nav">
        <div>
            <ul>
                <li><a class='active' href="index.php">Гостевая книга</a></li>
                <li><a href="admin.php">Админ панель</a></li>
            </ul>
        </div>
    </nav>
    <article id="article">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
            <h1>Гостевая книга</h1>
            <input id="login" type="text" name="userName" placeholder="Введите свое Имя">
            <textarea id="pass" name="userMessage" cols="40" rows="3" placeholder="Оставьте свой коментарий"></textarea>
            <input id="submit-button" type="submit" name="submit" value="Отправка">
        </form>


            <?php
            $messages = getContent(DB);
            if (is_array($messagesNew = addContent(DB, $messages))){
                showContent($messagesNew);
            }  else {
                showContent($messages, $messagesNew);
            }

            ?>
        </div>
    </article>
</body>
</html>