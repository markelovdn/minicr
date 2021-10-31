<?php
session_start();
require 'function.php';

$email = $_POST['email'];
$user_id = $_POST['id'];
$password = $_POST['password'];
$hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
$username = $_POST['name'];
$workplace = $_POST['workplace'];
$phone = $_POST['phonanumber'];
$adress = $_POST['adres'];
$status = $_POST['status'];
$vk = $_POST['vk'];
$telegram = $_POST['telegram'];
$instagram = $_POST['instagram'];

//dd($photo);

if ($email==null) {
    set_flash_message('no_email', 'Не заполнено поле email');
    redirect_too('../create_user.php');
    exit();
    die();
} elseif (get_user_by_email($email)) {
    set_flash_message('not_ok', 'Такой пользователь уже есть');
    redirect_too('../create_user.php');
    exit();
} else {
    reg_user($email, $hash);
    $user_id = get_user_by_email($email);
    edit_user_info($user_id['id'], $username, $workplace, $phone, $adress);
    set_user_status($user_id['id'], $status);
    add_user_sl($user_id['id'], $vk, $telegram, $instagram);
    upload_user_photo($user_id['id'], $_FILES['photo']['tmp_name']);
    redirect_too('../users.php');
}

