<?php
session_start();
require 'function.php';

$email = $_POST['email'];
$password = $_POST['password'];
$repassword = $_POST['repassword'];
$hashpass = password_hash($password, PASSWORD_DEFAULT);
$hashrepass = password_hash($repassword, PASSWORD_DEFAULT);

if ($password == $repassword) {
    edit_user_secur_info($email, $hashpass);
}

redirect_too('../users.php');


