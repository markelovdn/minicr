<?php
session_start();
require 'function.php';
$email = $_POST['email'];
$_FILES['photo']['tmp_name'];
//dd($_FILES);

upload_user_photo($_FILES['photo']['tmp_name']);

redirect_too('../users.php');


