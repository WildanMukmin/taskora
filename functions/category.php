<?php
require_once __DIR__ . '/../config/db.php';

function getCategories() {
    global $conn;

    $sql = "SELECT * FROM categories";

    $result = $conn->query($sql);

    return $result ? $result->fetch_all(MYSQLI_ASSOC) : false;
}