<?php
session_start();
require 'function.php';

$email = $_POST['email'];
$password = $_POST['password'];
$user = get_user_by_email($email);

//dd($hash = password_hash($password, PASSWORD_DEFAULT));

if (!$user) {
    set_flash_message('err_login', 'не верный логин ');
    redirect_too('../page_login.php');
}

if(check_user($email, $user['password'])) {
$_SESSION['user'] = [
    'id'=>$user['id'],
    'email'=>$email,
    'role'=>$user['role']
];

redirect_too('../users.php');
}
set_flash_message('err_login', 'не верный пароль');
redirect_too('../page_login.php');

?>
