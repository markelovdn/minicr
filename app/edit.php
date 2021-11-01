<?php
session_start();
require 'function.php';

$username = $_POST['name'];
$user_id = $_POST['id'];
$workplace = $_POST['workplace'];
$phone = $_POST['phonanumber'];
$adress = $_POST['adres'];

if (get_author($user_id)){
    echo 'Это автор';
    exit();
}
    edit_user_info($user_id, $username, $workplace, $phone, $adress);
    set_flash_message('edit_ok', 'Профиль успешно обновлен');
    redirect_too('../users.php');


