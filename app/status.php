<?php
session_start();
require 'function.php';

$status = $_POST['status'];
$user_id = $_POST['id'];

    set_user_status($user_id, $status);

redirect_too('../users.php');


