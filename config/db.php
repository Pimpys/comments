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
 * Time: 19:22
 */
$dns = 'mysql:host=localhost;dbname=comments;charset=UTF8';
$username = 'root';
$passwd = 'password';

try{
    $pdo = new PDO($dns, $username, $passwd);
}catch (PDOException $e){
    echo 'Подключение не удалось: ' . $e->getMessage();
    die;
}