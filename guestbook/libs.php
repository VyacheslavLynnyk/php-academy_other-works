<?php

define ("DB", "_messages.db");

function getContent($dataBase){
    if (is_readable($dataBase)) {
        $messages = file_get_contents($dataBase);
        $messages = unserialize($messages);
        return $messages;
    }
    return [];
}

function addContent($dataBase, $messages){
    if (isset($_POST['submit'])){
//        var_dump($_POST);
        $newPost['userMessage'] = nl2br(htmlspecialchars($_POST['userMessage']));
        $newPost['userName'] = htmlspecialchars($_POST['userName']);
        $messages[] = $newPost;
        $messageDB[] = serialize($messages);
        file_put_contents($dataBase, $messageDB);
    }
    return $messages;
}

function showContent($messages)
{
    if (isset($messages)) {
        $cens = ["bad", "work", "fuck"];
        $messages = array_reverse($messages);
        $messageCount = 0;
        foreach ($messages as $post) {
            foreach ($cens as $word) {
                $post['userName'] = str_ireplace($word, "CENSORED", $post['userName']);
                $post['userMessage'] = str_ireplace($word, "CENSORED", $post['userMessage']);
            }
            $position = ++$messageCount % 2;
            ?>

            <div class="message">
                <?php if ($position) : ?>
                    <p><?= $post['userName'] ?></p>
                    <p>:</p>
                <?php endif ?>
                <p class="text"><?= $post['userMessage'] ?></p>
                <?php if (!($position)) : ?>
                    <p>:</p>
                    <p><?= $post['userName']?></p>
                <?php endif ?>
            </div>

            <?php
        }
    }
}
?>