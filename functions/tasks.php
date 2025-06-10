<?php
require_once __DIR__ . '/../config/db.php';


function getTasks(){
    global $conn;

    $sql = "
        SELECT 
            tasks.*,
            users.name AS user_name,
            users.email AS user_email,
            categories.name AS category_name
        FROM tasks
        JOIN users ON tasks.user_id = users.id
        LEFT JOIN categories ON tasks.category_id = categories.id
        ORDER BY tasks.created_at DESC
    ";

    $result = $conn->query($sql);

    return $result ? $result->fetch_all(MYSQLI_ASSOC) : false;
}

function getTasksById($id){
    global $conn;

    $sql = "
        SELECT 
            tasks.*,
            users.name AS user_name,
            users.email AS user_email,
            categories.name AS category_name
        FROM tasks
        JOIN users ON tasks.user_id = users.id
        LEFT JOIN categories ON tasks.category_id = categories.id
        WHERE tasks.user_id = $id
        ORDER BY tasks.created_at DESC
    ";

    $result = $conn->query($sql);

    return $result ? $result->fetch_all(MYSQLI_ASSOC) : false;
}

?>
