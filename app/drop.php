<?php
session_start();
require 'function.php';
$email = $_POST['email'];
$id = $_GET['id'];
$role = $_SESSION['user']['role'];

$user_photo = get_user($id);
$dir=$_SERVER['DOCUMENT_ROOT'].'/img/userfoto/';

if(file_exists($dir.$user_photo['photo'])){

    unlink($dir.$user_photo['photo']); //удаляем файл если он уже загружен
}

drop_user($id);

if ($role=='admin'){
    redirect_too('../users.php');
}
unset($_SESSION['user']);
redirect_too('../');