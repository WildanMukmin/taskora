<?php
include_once('../../functions/tasks.php');
$id = $_GET["id"];

deleteTaskById($id);

header("Location: dashboard.php");
exit;