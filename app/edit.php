<?php
session_start();
require 'function.php';

$username = $_POST['name'];
$user_id = $_POST['id'];
$workplace = $_POST['workplace'];
$phone = $_POST['phonanumber'];
$adress = $_POST['adres'];

    edit_user_info($user_id, $username, $workplace, $phone, $adress);
    redirect_too('../users.php');


