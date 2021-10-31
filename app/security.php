<?php
session_start();
require 'function.php';

$user_id = $_POST['id'];
$email = $_POST['email'];
$password = $_POST['password'];
$repassword = $_POST['repassword'];

if ($password == $repassword) {
    edit_user_secur_info($user_id, $email, $password);
}

redirect_too('../users.php');


