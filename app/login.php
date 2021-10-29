<?php
session_start();
require 'function.php';

$email = $_POST['email'];
$password = $_POST['email'];
$hash = password_hash($password, PASSWORD_DEFAULT);

$user = get_user_by_email($email);

if (!$user) {
    set_flash_message('err_login', 'не верный логин');
    redirect_too('../page_login.php');
}
check_user($email, $hash);
set_flash_message('login_ok','Авторизация пройдена');
redirect_too('../page_profile.html');

?>
