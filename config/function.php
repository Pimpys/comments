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
 * Time: 19:23
 */

/**
 * @param string $string
 * @return string
 */
function clearData(string $string): string
{
    return strip_tags(trim($string));
}

/**
 * @param string $string
 * @return bool|int|string
 */
function checkDataLength(string $string)
{
    $str = strlen(clearData($string));
    if (!empty($str) && $str <= 254){
        return $string;
    }
    return false;
}

/**
 * @param string $string
 * @return bool|string
 */
function checkEmail(string $string)
{
    $pattern = "#^[-0-9a-z_\.]+@[0-9a-z_^\.]+\.[a-z]{2,6}$#i";
    if (!preg_match($pattern, checkDataLength($string)))
    {
        return false;
    }
    return $string;
}

/**
 * @param PDO $pdo
 * @return mixed
 */
function getAllComments(PDO $pdo)
{
    $sql = 'SELECT * FROM comment WHERE status = true';
    $sth = $pdo->prepare($sql);
    $sth->execute();
    return $sth->fetchAll(PDO::FETCH_CLASS);
}

/**
 * @param PDO $pdo
 * @param $name
 * @param $email
 * @param $message
 * @return bool
 */
function saveComment(PDO $pdo, $name, $email, $message)
{
    $sql = "INSERT INTO comment (name, email, body, status) VALUES (?, ?, ?, ?)";
    $sth = $pdo->prepare($sql);
    return $sth->execute([
        $name,
        $email,
        $message,
        true
    ]);
}

/**
 * @param PDO $pdo
 * @param int $id
 * @return array
 */
function findByID(PDO $pdo, int $id)
{
    $sql = 'SELECT * FROM comment WHERE id = ' . $id;
    $sth = $pdo->prepare($sql);
    $sth->execute();
    return $sth->fetchAll(PDO::FETCH_CLASS);
}

/**
 * @param PDO $pdo
 * @param int $id
 * @return bool
 */
function deleteComments(PDO $pdo, int $id)
{
    $sql = 'DELETE FROM comment WHERE id = ' . $id;
    $sth = $pdo->prepare($sql);
    return $sth->execute();
}
/**
 * @param mixed $variable
 */
function dump($variable)
{
    echo '<pre>';
        var_dump($variable);
    echo '</pre>';
    die;
}