<?php
$title_page = 'Delete Users Account';
session_start();
include_once('../../includes/gate_admin.php'); 
require_once('../../functions/users.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    if (deleteUser($id)) {
        $_SESSION['success'] = "User berhasil dihapus.";
        $_SESSION['success_time'] = time();
    } else {
        $_SESSION['error'] = "Gagal menghapus user.";
        $_SESSION['error_time'] = time();
    }
    
    header("Location: users.php");
    exit;
} else {
    header("Location: users.php");
    exit;
}
?>