<?php
// session_start(); // jika belum dipanggil sebelumnya
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $title_page ?? 'Taskora' ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
<!-- Navbar -->
<header class="bg-white shadow-md p-4 flex justify-between items-center">
  <h1 class="text-xl font-bold text-blue-600">Taskora</h1>
  <nav class="space-x-4">
    <a href="/pages/user/dashboard.php" class="text-gray-700 hover:text-blue-600">apatah</a>
    <a href="/pages/user/tasks.php" class="text-gray-700 hover:text-blue-600">Tugas</a>
    <a href="/logout.php" class="text-red-500 hover:text-red-700 font-medium">Logout</a>
  </nav>
</header>

<main class="flex-1 p-6">
