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
    if (password_verify($_POST['password'], $pass)) {
        return true;
    }
}

function get_all_users(){
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

function edit_user_info($user_id, $username, $workplace, $phone, $adress){
    $db = db();
    $sql = "UPDATE users SET name = '$username', workplace = '$workplace', phonanumber = '$phone', adres = '$adress' WHERE id = $user_id";
    //dd($sql);
    mysqli_query($db, $sql);
}

function edit_user_secur_info($user_id, $email, $pass){
    $db = db();

    if ($_POST['password'] == ''){
        $sql = "UPDATE users SET email = '$email' WHERE id = $user_id";
        mysqli_query($db, $sql);
    }
    $password = password_hash($pass, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET email = '$email', password = '$password' WHERE id = $user_id";
    //dd($sql);
    mysqli_query($db, $sql);
}

function set_user_status($user_id, $status){
    $db = db();
    $sql = "UPDATE users SET status = '$status' WHERE id = $user_id";
    mysqli_query($db, $sql);
}

function upload_user_photo($user_id, $photo){
    $db = db();
    $file_name = $_POST['email']."_photo".".jpg";
    $sql = "UPDATE users SET photo = '$file_name' WHERE id = $user_id";
    //dd($sql);
    mysqli_query($db, $sql);

    if(isset($photo)){
        $dir=$_SERVER['DOCUMENT_ROOT'].'/img/userfoto/';
        if(file_exists($dir.$file_name)){
            unlink($dir.$file_name); //удаляем файл если он уже загружен
        }
        move_uploaded_file($photo, $dir.$file_name);
    }
}

function add_user_sl($user_id, $vk, $telegram, $instagram){
    $db = db();
    $sql = "UPDATE users SET vk = '$vk', telegram = '$telegram', instagram = '$instagram' WHERE id = $user_id";
    mysqli_query($db, $sql);
}

function get_author($id) {
    if ($id==$_SESSION['user']['id']){
        return true;
    }
}

function drop_user($id){
    $db = db();
    $sql = "DELETE FROM users WHERE id = $id";
    //dd($sql);
    mysqli_query($db, $sql);

}

function unset_user() {
    unset($_SESSION['user']);
}

function dd($var) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    die();
    error_reporting(-1);
}
