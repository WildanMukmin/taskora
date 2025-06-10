<?php
include_once('../../functions/tasks.php');
$id = $_GET["id"];

markDoneByid($id);

header("Location: dashboard.php");
exit;