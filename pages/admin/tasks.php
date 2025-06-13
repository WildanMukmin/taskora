<?php
$title_page = 'Manage Task Users Account';
require_once __DIR__ . '/../../includes/gate_admin.php'; 
require_once __DIR__ . '/../../includes/header.php';
require_once __DIR__ . '/../../functions/users.php';
require_once __DIR__ . '/../../functions/tasks.php';
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
  <div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <div class="flex justify-between items-center">
      <div class="flex items-center space-x-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
        <h1 class="text-xl font-bold text-blue-600">Task Users</h1>
      </div>
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
      <div class="flex items-center space-x-3 mb-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
        <h3 class="text-lg font-semibold text-gray-700">Total Task</h3>
      </div>
      <p class="text-3xl font-bold text-blue-600 mb-1">
        <?= $total_tasks; ?>
      </p>
      <p class="text-sm text-gray-500">All task users</p>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
      <div class="flex items-center space-x-3 mb-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
        <h3 class="text-lg font-semibold text-gray-700">Total Progress</h3>
      </div>
      <p class="text-3xl font-bold text-blue-600 mb-1">
        <?= $total_tasks_progress; ?>
      </p>
      <p class="text-sm text-gray-500">All progress task users</p>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
      <div class="flex items-center space-x-3 mb-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
        <h3 class="text-lg font-semibold text-gray-700">Total Done</h3>
      </div>
      <p class="text-3xl font-bold text-blue-600 mb-1">
        <?= $total_tasks_done; ?>
      </p>
      <p class="text-sm text-gray-500">All done</p>
    </div>
  </div>

  <div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="min-w-full divide-y divide-white">
      <thead class="bg-white">
        <tr>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Id</th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">user </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">category</th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">title</th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">status</th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Priority</th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Due Date</th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Created at</th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Update at</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <?php if ($tasks && count($tasks) > 0): ?>
          <?php foreach ($tasks as $task): ?>
            <tr>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $task['id']; ?></td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($task['user_name']); ?></td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($task['category_name'] ?? '-'); ?></td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($task['title']); ?></td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $task['description']; ?></td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <span class="inline-block px-2 py-1 text-xs font-semibold rounded 
            <?= $task['status'] === 'done' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'; ?>">
                  <?= ucfirst($task['status']); ?>
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $task['priority']; ?></td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $task['due_date']; ?></td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $task['created_at']; ?></td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $task['updated_at']; ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
              No tasks found.
            </td>
          </tr>
        <?php endif; ?>
      </tbody>

    </table>
  </div>
</main>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>