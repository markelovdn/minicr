<?php
session_start();
require 'function.php';
$email = $_POST['email'];
$id = $_GET['id'];

drop_user($id);

redirect_too('../users.php');