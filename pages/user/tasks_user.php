<?php
$title_page = 'Tasks User';
require_once __DIR__ . '/../../includes/gate_user.php'; 
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="flex-grow p-4">
  <!-- Task List Table -->
  <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Task</th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priority</th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
          <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">

        <?php foreach ($tasks as $task): ?>
          <tr class="hover:bg-gray-50 transition">
            <td class="px-6 py-4">
              <div class="flex items-center">
                <div class="flex-shrink-0 h-9 w-9 flex items-center justify-center rounded-lg bg-indigo-50 text-indigo-600 group-hover:bg-indigo-100 transition">
                  <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                  </svg>
                </div>
                <div class="ml-4">
                  <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($task['title']) ?></div>
                  <div class="text-xs text-gray-500 truncate max-w-xs"><?= ucfirst($task['category'] ?? '-') ?></div>
                </div>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                <?= match($task['priority']) {
                    'high' => 'bg-red-100 text-red-800',
                    'medium' => 'bg-yellow-100 text-yellow-800',
                    'low' => 'bg-green-100 text-green-800',
                    default => 'bg-gray-100 text-gray-800'
                } ?>">
                <?= ucfirst($task['priority']) ?>
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                <?= $task['status'] === 'done' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' ?>">
                <?= ucfirst($task['status']) ?>
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              <div class="flex items-center">
                <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span><?= date('M d, Y', strtotime($task['due_date'])) ?></span>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              <div class="flex justify-end space-x-3">
                <a href="/pages/user/edit_task_user.php" class="text-indigo-600 hover:text-indigo-900" title="Edit">
                  <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                  </svg>
                </a>
                <a href="#" class="text-green-600 hover:text-green-900" title="Complete">
                  <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                  </svg>
                </a>
                <a href="#" class="text-red-600 hover:text-red-900" title="Delete">
                  <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                  </svg>
                </a>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>

      </tbody>
    </table>
  </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>