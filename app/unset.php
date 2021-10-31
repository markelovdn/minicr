<?php
session_start();
require 'function.php';

unset_user();
redirect_too('../page_login.php');