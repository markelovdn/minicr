<?php
session_start();
require 'function.php';

$user_id = $_POST['id'];
$email = $_POST['email'];
$password = $_POST['password'];
$repassword = $_POST['repassword'];

$cur_user_email = get_user($user_id);

if ($cur_user_email['email'] == $_POST['email']) {
    edit_user_secur_info($user_id, $email, $password);
} elseif (get_user_by_email($email)) {
    set_flash_message('not_ok_email', 'Email занят');
    redirect_too("../page_security.php?id=$user_id");
}

if ($password != $repassword) {
    set_flash_message('not_ok_pass', 'Пароли не совпадают');
    redirect_too("../page_security.php?id=$user_id");
}
edit_user_secur_info($user_id, $email, $password);
redirect_too('../users.php');


