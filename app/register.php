<?php
session_start();
require 'function.php';

$email = $_POST['email'];
$password = $_POST['email'];
$hash = password_hash($password, PASSWORD_DEFAULT);

if (get_user_by_email($email)) {
    set_flash_message('not_ok', 'Такой пользователь уже есть');
    redirect_too('../index.php');
    exit();
}
add_user($email, $hash);
redirect_too('../page_login.php');

