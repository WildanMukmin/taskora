<?php
require_once("../config/config.php");

if (!$is_logged_in){
    header("Location: /taskora/pages/auth/login.php");
    exit;
}