<?php
session_start();
require 'function.php';

$username = $_POST['name'];
$workplace = $_POST['workplace'];
$phone = $_POST['phonanumber'];
$adress = $_POST['adres'];

    edit_user_info($username, $workplace, $phone, $adress);
    redirect_too('../users.php');


