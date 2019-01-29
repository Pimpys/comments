<?php
/**
 *Copyright (c)
 *http://maxsuccess.ru/
 *https://vk.com/pimpys
 *https://www.facebook.com/the.web.lessons/
 * Кодируй так, как будто человек,
 * поддерживающий твой код, - буйный психопат,
 * знающий, где ты живешь.
 * User: Max
 * Date: 29.01.2019
 * Time: 19:21
 */

$scandir = scandir(__DIR__, SCANDIR_SORT_ASCENDING);
foreach ($scandir as $file):
    if(preg_match('/php/', $file)){
        $files[] = $file;
    }
endforeach;

foreach ($files as $value) {
    if (!preg_match('/config.php/', $value)){
        require_once $value;
    }
}