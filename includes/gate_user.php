
<?php
require_once("../config/config.php");


if ($role !== "user" && $is_logged_in) {
    header("Location: /taskora/pages/user/dashboard.php");
    exit;
}

if ($role !== "user"&& !$is_logged_in){
    header("Location: /taskora/pages/auth/login.php");
    exit;
}