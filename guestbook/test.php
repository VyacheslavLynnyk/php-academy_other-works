<?php
/**
 * Created by PhpStorm.
 * User: litter
 * Date: 20.02.16
 * Time: 20:45
 */
$post['userMessage'] = 'а вот ПисЬка и жопа';
$word = ['|писька|ius','|жопа|ius'];
//$post['userMessage'] = str_ireplace($word, "*CENSORED*", $post['userMessage']);
$post['userMessage'] = preg_replace($word, '*CENSORED*', $post['userMessage']);

echo $post['userMessage'];