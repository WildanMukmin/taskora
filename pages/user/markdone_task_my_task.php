<?php
require_once __DIR__ . '/../../functions/tasks.php';
$id = $_GET["id"];

markDoneByid($id);

header("Location: my_tasks.php");
exit;