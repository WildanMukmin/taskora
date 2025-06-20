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
        ORDER BY tasks.status ASC, tasks.due_date ASC
    ";

    $result = $conn->query($sql);

    return $result ? $result->fetch_all(MYSQLI_ASSOC) : false;
}

function getTaskById($id){
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
        WHERE tasks.id = $id
        LIMIT 1
    ";

    $result = $conn->query($sql);

    return $result ? $result->fetch_assoc() : false;
}

function updateTaskById($id, $title, $description, $priority, $due_date, $category_id) {
    global $conn;

    $title = $conn->real_escape_string($title);
    $description = $conn->real_escape_string($description);
    $priority = $conn->real_escape_string($priority);
    $due_date = $conn->real_escape_string($due_date);
    $category_id = (int)$category_id;

    $sql = "
        UPDATE tasks
        SET 
            title = '$title',
            description = '$description',
            priority = '$priority',
            due_date = '$due_date',
            category_id = $category_id
        WHERE id = $id
    ";

    return $conn->query($sql);
}

function getTasksByStatusCategoryPriority(int $userId, string $status, string $category, string $priority) {
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
        WHERE tasks.user_id = ?
    ";

    $params = [$userId]; // Array untuk menyimpan nilai parameter
    $types = "i";      // String untuk menyimpan tipe parameter (i = integer)

    // Tambahkan kondisi status jika tidak 'all'
    if ($status !== 'all') {
        $sql .= " AND tasks.status = ?";
        $params[] = $status;
        $types .= "s"; // s = string
    }

    // Tambahkan kondisi kategori jika tidak 'all'
    if ($category !== 'all') {
        $sql .= " AND tasks.category_id = ?";
        $params[] = (int)$category; // Pastikan ini integer
        $types .= "i"; // i = integer
    }

    // Tambahkan kondisi prioritas jika tidak 'all'
    if ($priority !== 'all') {
        $sql .= " AND tasks.priority = ?";
        $params[] = $priority;
        $types .= "s"; // s = string
    }

    $sql .= " ORDER BY tasks.status ASC, tasks.due_date ASC";

    // Persiapan statement
    if ($stmt = $conn->prepare($sql)) {
        // Mengikat parameter secara dinamis menggunakan call_user_func_array
        // Ini memungkinkan kita untuk melewati array parameter ke bind_param
        $bind_names = [$types];
        for ($i = 0; $i < count($params); $i++) {
            $bind_name = 'param' . $i;
            $$bind_name = $params[$i]; // Membuat variabel dinamis seperti $param0, $param1
            $bind_names[] = &$$bind_name;
        }
        
        call_user_func_array([$stmt, 'bind_param'], $bind_names);

        // Eksekusi statement
        $stmt->execute();

        // Ambil hasil
        $result = $stmt->get_result();
        $tasks = $result ? $result->fetch_all(MYSQLI_ASSOC) : false;

        // Tutup statement
        $stmt->close();

        return $tasks;
    } else {
        // Tangani error jika prepared statement gagal
        error_log("Prepared Statement Error: " . $conn->error);
        return false;
    }
}
function addTask(int $userId, int $categoryId, string $title, string $description, string $priority, string $dueDate) {
    global $conn;

    $sql = "INSERT INTO tasks (user_id, category_id, title, description, priority, due_date) VALUES ($userId, $categoryId, '$title', '$description', '$priority', '$dueDate')";

    $result = $conn->query($sql);
    if ($result) {
        $_SESSION["success"] = "Task berhasil ditambahkan.";   
        $_SESSION["success_time"] = time(); 
    }
    else {
        $_SESSION["error"] = "Task gagal ditambahkan.";   
        $_SESSION["error_time"] = time(); 
    }
}
function deleteTaskById(int $taskId) {
    global $conn;
    $sql = "DELETE FROM tasks WHERE id = $taskId";
    $result = $conn->query($sql);
        if ($result) {
        $_SESSION["success"] = "Task berhasil ditambahkan.";   
        $_SESSION["success_time"] = time(); 
    }
    else {
        $_SESSION["error"] = "Task gagal ditambahkan.";   
        $_SESSION["error_time"] = time(); 
    }
}

function markDoneByid(int $id) {
    global $conn;
    $sql = "UPDATE tasks SET status = 'done' WHERE id = $id";
    $result = $conn->query($sql);
    if ($result) {
        $_SESSION["success"] = "Task berhasil ditambahkan.";   
        $_SESSION["success_time"] = time(); 
    }
    else {
        $_SESSION["error"] = "Task gagal ditambahkan.";   
        $_SESSION["error_time"] = time(); 
    }
}
?>
