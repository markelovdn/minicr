<?php
session_start();
require 'function.php';
$user_id = $_POST['id'];
//dd($_FILES);

upload_user_photo($user_id, $_FILES['photo']['tmp_name']);

redirect_too('../users.php');


