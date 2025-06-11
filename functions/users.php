<?php
require_once __DIR__ . '/../config/db.php';

function getUsers(){
    global $conn;
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    // return semua data sebagai array asosiatif
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : false;
}

function getUser($user_id) {
    global $conn;
    $user_id = (int)$user_id;
    $sql = "SELECT * FROM users WHERE id = $user_id";
    $result = $conn->query($sql);
    return $result ? $result->fetch_assoc() : false;
}

function getTotalUsers() {
    global $conn;
    $sql = "SELECT COUNT(id) as total FROM users";
    $result = $conn->query($sql);
    return $result ? $result->fetch_assoc()['total'] : 0;
}

function addUser($name, $email, $password) {
    global $conn;

    // Validasi sederhana
    if (empty($name) || empty($email) || empty($password)) {
        $_SESSION['error'] = "Semua field wajib diisi.";
        $_SESSION['error_time'] = time();
        header("Location: add_user.php");
        exit;
    }

    // Cek apakah email sudah ada
    $email = mysqli_real_escape_string($conn, $email);
    $checkQuery = "SELECT id FROM users WHERE email = '$email'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if ($checkResult && mysqli_num_rows($checkResult) > 0) {
        $_SESSION['error'] = "Email sudah terdaftar.";
        $_SESSION['error_time'] = time();
        header("Location: add_user.php");
        exit;
    }

    // Enkripsi password (sangat penting!)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $name = mysqli_real_escape_string($conn, $name);

    $insertQuery = "INSERT INTO users (name, email, password) 
                    VALUES ('$name', '$email', '$hashedPassword')";

    if (mysqli_query($conn, $insertQuery)) {
        $_SESSION['success'] = "User berhasil ditambahkan.";
        $_SESSION['success_time'] = time();
        header("Location: users.php");
        exit;
    } else {
        $_SESSION['error'] = "Terjadi kesalahan saat menyimpan data.";
        $_SESSION['error_time'] = time();
        header("Location: add_user.php");
        exit;
    }
}

function updateUser($id, $name, $email) {
    global $conn;

    $id = (int)$id;
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);

    $sql = "UPDATE users SET name = '$name', email = '$email' WHERE id = $id";

    $result =  $conn->query($sql);
    if($result){
        $_SESSION["success"] = "User berhasil diupdate.";   
        $_SESSION["success_time"] = time(); 
    }
    else {
        $_SESSION["error"] = "User gagal diupdate.";   
        $_SESSION["error_time"] = time(); 
    }
    header("Location: users.php");
    exit;
}

function updateProfileUser($id, $name, $email) {
    global $conn;

    $id = (int)$id;
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);

    $sql = "UPDATE users SET name = '$name', email = '$email' WHERE id = $id";

    $result = $conn->query($sql);

    if ($result) {
        $updatedUser = getUser($id);
        if ($updatedUser) {
            $_SESSION['user'] = $updatedUser;
        }

        $_SESSION["success"] = "User berhasil diupdate.";   
        $_SESSION["success_time"] = time(); 
    } else {
        $_SESSION["error"] = "User gagal diupdate.";   
        $_SESSION["error_time"] = time(); 
    }
}

function deleteUser($id) {
    global $conn;
    $id = (int)$id;
    $sql = "DELETE FROM users WHERE id = $id";
    return $conn->query($sql);
}
?>
