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

function reg_user($email, $password)
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
    return true;
    }
}

function get_all_user(){
    $db = db();
    $sql = "SELECT * FROM users ORDER BY name DESC";
    $users = array();
    $result = mysqli_query($db, $sql) or die("Ошибка " . mysqli_error($db));
    if($result)
    {
        while ($row = mysqli_fetch_assoc($result)){
            $users[]=$row;
        }
        mysqli_free_result($result);
    }
    mysqli_close($db);
    return $users;
}

function get_user($id){
    $db = db();
    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($db, $sql);
    $data = mysqli_fetch_assoc($result);
    return $data;
}

function edit_user_info($username, $workplace, $phone, $adress){
    $db = db();
    $email = $_POST['email'];

    $user = get_user_by_email($email);
    $user_id = $user['id'];
    $sql = "UPDATE users SET name = '$username', workplace = '$workplace', phonanumber = '$phone', adres = '$adress' WHERE id = $user_id";
    //dd($sql);
    mysqli_query($db, $sql);
}

function set_user_status($status){
    $db = db();
    $email = $_POST['email'];
    $user = get_user_by_email($email);
    $user_id = $user['id'];
    $sql = "UPDATE users SET status = '$status' WHERE id = $user_id";
    mysqli_query($db, $sql);
}

function upload_user_photo($photo){
    $db = db();
    $email = $_POST['email'];
    $user = get_user_by_email($email);
    $user_id = $user['id'];
    $file_name = $_POST['name']."_".$_POST['email'].".jpg";
    $sql = "UPDATE users SET photo = '$file_name' WHERE id = $user_id";
    mysqli_query($db, $sql);

    if(isset($photo['photo']['tmp_name'])){
        $dir=$_SERVER['DOCUMENT_ROOT'].'/img/userfoto/';
        if(file_exists($dir.$file_name)){
            unlink($dir.$file_name); //удаляем файл если он уже загружен
        }
        move_uploaded_file($photo['foto']['tmp_name'], $dir.$file_name);
    }
}

function add_user_sl($vk, $telegram, $instagram){
    $db = db();
    $email = $_POST['email'];
    $user = get_user_by_email($email);
    $user_id = $user['id'];
    $sql = "UPDATE users SET vk = '$vk', telegram = '$telegram', instagram = '$instagram' WHERE id = $user_id";
    mysqli_query($db, $sql);
}


function dd($var) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    die();
    error_reporting(-1);
}
