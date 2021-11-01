<?php
session_start();
require 'function.php';

$email = $_POST['email'];
$user = get_user_by_email($email);

if (!$user) {
    set_flash_message('err_login', 'не верный логин или пароль');
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
set_flash_message('err_login', 'не верный логин или пароль');
redirect_too('../page_login.php');

?>
