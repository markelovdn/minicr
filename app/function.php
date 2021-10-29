<?php

function db(){
    $db = mysqli_connect('localhost', 'root', '', 'minicr');
    return $db;
}

/**
 * Parametrs: string - $email
 * Description: поиск пользователя по эл.адресу
 * Return value: array
 */

function get_user_by_email($email)
{
    $db = db();
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($db, $sql);
    $data = mysqli_fetch_assoc($result);
    return $data;

}

/**
 * Parametrs: string - $email, string - $password
 * Description: добавляет пользователя в БД
 * Return value: int($user->id)
 */

function add_user($email, $password)
{
    $db = db();
    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
    mysqli_query($db, $sql);
    $user = get_user_by_email($email);
    return (int)$user['id'];
}

/**
 * Parametrs: string - $name (ключ), string - $maessage (значение, текста сообщения)
 * Description: подготовить флэш сообщение
 * Return value: null
 */

function set_flash_message($name, $message)
{
    $_SESSION[$name] = $message;
}

/**
 * Parametrs: string - $name (ключ)
 * Description: вывести флэш сообщение
 * Return value: null
 */

function display_flash_message($name)
{
    if(isset($_SESSION[$name])){
        echo $_SESSION[$name];
    } unset($_SESSION[$name]);
}

/**
 * Parametrs: string - $path
 * Description: перенаправить на другую страницу
 * Return value: null
 */

function redirect_too($path)
{
    header('Location: ' . $path);
    exit();
}

function check_user($email, $pass) {
    $user = get_user_by_email($email);
    if (password_verify($user['password'], $pass)) {

    $_SESSION['user'] = [
        'id'=>$user['id'],
        'email'=>$email
    ];
    return true;
    }
}


function dd($var) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}
