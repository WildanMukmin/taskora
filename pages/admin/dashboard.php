<?php 
$title_page = 'Dashboard admin';
include_once('../../includes/header.php'); 
include_once('../../functions/users.php')
?>

<main class="flex-grow p-4">
  <div class="grid grid-cols-1 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow-md p-6">
      <h2 class="text-xl font-bold text-blue-600 mb-2">WELCOME BACK, ADMIN</h2>
      <p class="text-gray-600">Here's what's happening with your task management platform today!</p>
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
      <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Users</h3>
      <p class="text-3xl font-bold text-blue-600">
        <?php
        echo getTotalUsers();
        ?>
      </p>
    </div>
    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
      <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Task</h3>
      <p class="text-3xl font-bold text-green-600">0</p> <!-- lampirin disini ya wil untuk be nya ntar -->
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
      <h3 class="text-lg font-semibold text-gray-700 mb-2">Task Progress</h3>
      <p class="text-3xl font-bold text-blue-600">
        0 <!-- lampirin disini ya wil untuk be nya ntar -->
      </p>
    </div>
    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
      <h3 class="text-lg font-semibold text-gray-700 mb-2">Task Done</h3>
      <p class="text-3xl font-bold text-green-600">0</p> <!-- lampirin disini ya wil untuk be nya ntar -->
    </div>
  </div>

</main>

<?php include_once('../../includes/footer.php'); ?>

