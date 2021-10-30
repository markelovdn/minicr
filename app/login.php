<?php
session_start();
require 'function.php';

$email = $_POST['email'];
$password = $_POST['password'];
$hash = password_hash($password, PASSWORD_DEFAULT);

$user = get_user_by_email($email);

if (!$user) {
    set_flash_message('err_login', 'не верный логин или пароль');
    redirect_too('../page_login.php');
}

if(check_user($email, $hash)) {
set_flash_message('login_ok','Авторизация пройдена');
$_SESSION['user'] = [
    'id'=>$user['id'],
    'email'=>$email,
    'role'=>$user['role']
];

redirect_too('../users.php');
}
set_flash_message('err_login', 'не верный логин или пароль');
redirect_too('../page_login.php');

?>
