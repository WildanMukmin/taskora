<?php
require_once __DIR__ . '/../config/db.php';

function getTasks(){
    global $conn;
    $sql = "SELECT * FROM tasks";
    $result = $conn->query($sql);

    // return semua data sebagai array asosiatif
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : false;
}

?>
