<?php
require_once(__DIR__ . '/../config/config.php');

if ($role !== "admin" && $is_logged_in) {
    header("Location: /pages/admin/dashboard.php");
    exit;
}

if ($role !== "admin"&& !$is_logged_in){
    header("Location: /pages/auth/login.php");
    exit;
}