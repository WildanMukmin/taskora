
<?php
require_once(__DIR__ . '/../config/config.php');


if ($role !== "user" && $is_logged_in) {
    header("Location: /pages/user/dashboard.php");
    exit;
}

if ($role !== "user"&& !$is_logged_in){
    header("Location: /pages/auth/login.php");
    exit;
}