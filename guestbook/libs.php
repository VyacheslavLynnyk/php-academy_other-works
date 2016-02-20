<?php

define ("DB", '_messages.db');
define('FILTER_DB', '_filters.db');
function getContent($dataBase)
{
    if (is_readable($dataBase)) {
        $messages = file_get_contents($dataBase);
        if (!empty($messages)){
            $messages = unserialize($messages);
            return $messages;
        }else {
            return [];
        }
    }
    return [];
}

function addContent($dataBase, $messages = '')
{
    if (isset($_POST['submit'])) {
//        var_dump($_POST);
        if (!empty($_POST['userMessage']) && !empty($_POST['userName']))
        {
            $newPost['userMessage'] = nl2br(htmlspecialchars($_POST['userMessage']));
            $newPost['userName'] = htmlspecialchars($_POST['userName']);
            $messages[] = $newPost;
            $messageDB[] = serialize($messages);
            file_put_contents($dataBase, $messageDB);
        } else {
            $messages = "Не заполнены поля ввода";
        }

    }
    return $messages;
}

function showContent($messages, $alert = '')
{
    if (isset($messages) && sizeof($messages)) {
        $cens = getContent(FILTER_DB);
        $messages = array_reverse($messages);
        $messageCount = 0;
        ?>

        <div id="window-messages">

        <?php
        foreach ($messages as $post) {
            foreach ($cens as $word) {
                $post['userName'] = preg_replace("|$word|ius", "*CENSORED*", ($post['userName']));
                $post['userMessage'] = preg_replace("|$word|ius", "*CENSORED*", $post['userMessage']);

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
    } else {
        if (!empty($alert)) : ?>
            <div class="alert">
                <h2>Пожалуйста, заполните поля ввода корректно.</h2>
            </div>
            </div>
        <?php endif;
    }
}

function addFilerWords($db, $filtersArr = [])
{
    if (isset($_POST['addWords'])) {
        if (!empty($_POST['words'])) {
            $filterStr = htmlspecialchars(mb_strtolower(trim($_POST['words'])));
            $filterNewRaw = explode(',', $filterStr);
            foreach($filterNewRaw as $word){
                $filterNew[] = trim($word);
            }
            $filtersArr = (is_array($filtersArr))? $filtersArr : [];
            $filtersArr = array_merge($filtersArr, $filterNew);
            $filterDB = serialize($filtersArr);
            file_put_contents($db, $filterDB);
            return $filtersArr;
        } else {
            return "Не заполнены поля ввода";
        }
    }
    return $filtersArr;
}


function deleteWords($db, $filtersArr)
{
    if (isset($_POST['removeWords'])) {
        if (sizeof($_POST['forDelete'])) {
            $deleteArr = ($_POST['forDelete']);
            $filtersArr = array_diff($filtersArr, $deleteArr);
            $filterDB = serialize($filtersArr);
            file_put_contents($db, $filterDB);
            return $filtersArr;
        } else {
            return "Нечего удалять";
        }
    }
    return $filtersArr;
}

function showFilters($filtersArr, $alert = '')
{
        if (isset($filtersArr) && sizeof($filtersArr)) : ?>
            <select id="filter-list" name="forDelete[]" multiple>
                <?php foreach ($filtersArr as $words) : ?>
                    <option value="<?= $words ?>"><?= $words ?></option>
                <?php endforeach ?>
            </select>
            <?php if (!empty($alert)) : ?>
                <div class="alert">
                    <h2>Пожалуйста, заполните поля ввода корректно.</h2>
                </div>
            <?php endif ?>
        <?php endif;
}


