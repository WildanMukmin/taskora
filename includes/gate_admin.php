<?php
require_once("../config/config.php");

if ($role !== "admin" && $is_logged_in) {
    header("Location: /taskora/pages/admin/dashboard.php");
    exit;
}

if ($role !== "admin"&& !$is_logged_in){
    header("Location: /taskora/pages/auth/login.php");
    exit;
}