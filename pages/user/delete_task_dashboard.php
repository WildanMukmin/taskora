<?php
require_once __DIR__ . '/../../functions/tasks.php';
$id = $_GET["id"];

deleteTaskById($id);

header("Location: dashboard.php");
exit;