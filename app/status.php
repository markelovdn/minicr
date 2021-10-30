<?php
session_start();
require 'function.php';

$status = $_POST['status'];

    set_user_status($status);

redirect_too('../users.php');


