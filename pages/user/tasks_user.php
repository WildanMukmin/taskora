<?php
$title_page = 'My Tasks';
require_once('../../includes/header.php');
require_once('../../includes/gate_user.php');
require_once('../../functions/tasks.php');
require_once('../../functions/categories.php');

// Get only the current user's tasks
$tasks = getTasksById();
//$categories = getCategories();

// Calculate task statistics
$total_tasks = count($tasks);
$total_progress = 0;
$total_done = 0;
$total_high = 0;
$total_medium = 0;
$total_low = 0;

foreach ($tasks as $task) {
    if ($task['status'] === 'progress') {
        $total_progress++;
    } elseif ($task['status'] === 'done') {
        $total_done++;
    }
    
    // Count by priority
    switch ($task['priority']) {
        case 'high': $total_high++; break;
        case 'medium': $total_medium++; break;
        case 'low': $total_low++; break;
    }
}

// Filter variables
$filter_status = $_GET['status'] ?? 'all';
$filter_category = $_GET['category'] ?? 'all';
$filter_priority = $_GET['priority'] ?? 'all';

// Apply filters
$filtered_tasks = array_filter($tasks, function($task) use ($filter_status, $filter_category, $filter_priority) {
    $status_match = ($filter_status === 'all') || ($task['status'] === $filter_status);
    $category_match = ($filter_category === 'all') || ($task['category_id'] == $filter_category);
    $priority_match = ($filter_priority === 'all') || ($task['priority'] === $filter_priority);
    
    return $status_match && $category_match && $priority_match;
});
?>

<main class="flex-grow p-4 md:p-6 bg-gray-50">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="bg-white rounded-xl shadow-md p-6 flex flex-col md:flex-row items-start md:items-center justify-between">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-indigo-600 mb-2">My Tasks</h1>
                <p class="text-gray-600">You have <?= $total_tasks ?> tasks in your list</p>
            </div>
            <a href="add_task.php" class="mt-4 md:mt-0 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg shadow-md transition flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add New Task
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Tasks</h3>
            <p class="text-3xl font-bold text-indigo-600"><?= $total_tasks ?></p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">In Progress</h3>
            <p class="text-3xl font-bold text-blue-500"><?= $total_progress ?></p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Completed</h3>
            <p class="text-3xl font-bold text-green-500"><?= $total_done ?></p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">High Priority</h3>
            <p class="text-3xl font-bold text-red-500"><?= $total_high ?></p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Due Soon</h3>
            <p class="text-3xl font-bold text-yellow-500"></p>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-8">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Filter Tasks</h2>
        <form method="get" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="all" <?= $filter_status === 'all' ? 'selected' : '' ?>>All Status</option>
                    <option value="progress" <?= $filter_status === 'progress' ? 'selected' : '' ?>>In Progress</option>
                    <option value="done" <?= $filter_status === 'done' ? 'selected' : '' ?>>Completed</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select name="category" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="all" <?= $filter_category === 'all' ? 'selected' : '' ?>>All Categories</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>" <?= $filter_category == $category['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($category['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
                <select name="priority" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="all" <?= $filter_priority === 'all' ? 'selected' : '' ?>>All Priorities</option>
                    <option value="high" <?= $filter_priority === 'high' ? 'selected' : '' ?>>High</option>
                    <option value="medium" <?= $filter_priority === 'medium' ? 'selected' : '' ?>>Medium</option>
                    <option value="low" <?= $filter_priority === 'low' ? 'selected' : '' ?>>Low</option>
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full md:w-auto px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Apply Filters
                </button>
                <?php if ($filter_status !== 'all' || $filter_category !== 'all' || $filter_priority !== 'all'): ?>
                    <a href="tasks.php" class="ml-2 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                        Clear
                    </a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <!-- Tasks Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priority</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (empty($filtered_tasks)): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No tasks found. Create your first task!</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($filtered_tasks as $task): ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-full bg-indigo-100 text-indigo-600">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($task['title']) ?></div>
                                            <div class="text-sm text-gray-500 truncate max-w-xs"><?= htmlspecialchars($task['description']) ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        <?= htmlspecialchars($task['category_name'] ?? 'Uncategorized') ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php 
                                    $priority_classes = [
                                        'high' => 'bg-red-100 text-red-800',
                                        'medium' => 'bg-yellow-100 text-yellow-800',
                                        'low' => 'bg-green-100 text-green-800'
                                    ];
                                    ?>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $priority_classes[$task['priority']] ?>">
                                        <?= ucfirst($task['priority']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php 
                                    $status_classes = [
                                        'progress' => 'bg-blue-100 text-blue-800',
                                        'done' => 'bg-green-100 text-green-800'
                                    ];
                                    ?>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $status_classes[$task['status']] ?>">
                                        <?= $task['status'] === 'done' ? 'Completed' : 'In Progress' ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php if ($task['due_date']): ?>
                                        <?= date('M d, Y', strtotime($task['due_date'])) ?>
                                        <?php if (strtotime($task['due_date']) < time() && $task['status'] !== 'done'): ?>
                                            <span class="ml-1 text-red-500">(Overdue)</span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        No due date
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <a href="edit_task.php?id=<?= $task['id'] ?>" class="text-indigo-600 hover:text-indigo-900">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <a href="complete_task.php?id=<?= $task['id'] ?>" class="text-green-600 hover:text-green-900">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </a>
                                        <a href="delete_task.php?id=<?= $task['id'] ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this task?');">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Upcoming Deadlines -->
    <div class="mt-8">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Upcoming Deadlines</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php 
            $upcoming_tasks = array_filter($tasks, function($task) {
                return $task['status'] !== 'done' && 
                       $task['due_date'] && 
                       strtotime($task['due_date']) > time() && 
                       strtotime($task['due_date']) <= strtotime('+7 days');
            });
            
            if (empty($upcoming_tasks)) {
                echo '<div class="bg-white rounded-xl shadow-md p-6 text-center text-gray-500">No upcoming deadlines in the next 7 days</div>';
            } else {
                foreach ($upcoming_tasks as $task): 
                    $days_left = floor((strtotime($task['due_date']) - time()) / (60 * 60 * 24));
            ?>
                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
                    <div class="flex justify-between items-start">
                        <h3 class="text-lg font-semibold text-gray-800"><?= htmlspecialchars($task['title']) ?></h3>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                            <?= $days_left <= 1 ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800' ?>">
                            <?= $days_left <= 1 ? 'Due tomorrow' : ($days_left . ' days left') ?>
                        </span>
                    </div>
                    <p class="text-gray-600 mt-2"><?= htmlspecialchars($task['description']) ?></p>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="text-sm text-gray-500">Due: <?= date('M d, Y', strtotime($task['due_date'])) ?></span>
                        <a href="edit_task.php?id=<?= $task['id'] ?>" class="text-sm text-indigo-600 hover:text-indigo-800">View Task</a>
                    </div>
                </div>
            <?php 
                endforeach;
            }
            ?>
        </div>
    </div>
</main>

<?php require_once('../../includes/footer.php'); ?>
