<?php 
$title_page = 'Dashboard admin';
include_once('../../includes/header.php'); 
include_once('../../functions/users.php');
include_once('../../functions/tasks.php');

$total_users = getTotalUsers();
$tasks = getTasks();
$total_tasks = 0;
$total_tasks_progress = 0;
$total_tasks_done = 0;

if ($tasks) {
    foreach ($tasks as $task) {
        if ($task['status'] === 'progress') {
            $total_tasks_progress++;
        } elseif ($task['status'] === 'done') {
            $total_tasks_done++;
        }
        $total_tasks++;
    }
}


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
        <?= $total_users; ?>
      </p>
    </div>
    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
      <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Task</h3>
      <p class="text-3xl font-bold text-green-600"><?= $total_tasks; ?></p> <!-- lampirin disini ya wil untuk be nya ntar -->
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
      <h3 class="text-lg font-semibold text-gray-700 mb-2">Task Progress</h3>
      <p class="text-3xl font-bold text-blue-600">
        <?= $total_tasks_progress; ?> <!-- lampirin disini ya wil untuk be nya ntar -->
      </p>
    </div>
    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
      <h3 class="text-lg font-semibold text-gray-700 mb-2">Task Done</h3>
      <p class="text-3xl font-bold text-green-600"><?= $total_tasks_done; ?></p> <!-- lampirin disini ya wil untuk be nya ntar -->
    </div>
  </div>

</main>

<?php include_once('../../includes/footer.php'); ?>

