<?php
require_once("../config/config.php");

if (!$is_logged_in){
    header("Location: /pages/auth/login.php");
    exit;
}