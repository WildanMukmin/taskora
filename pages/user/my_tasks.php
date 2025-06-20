<?php
if (
    isset($_GET['status']) && $_GET['status'] === "all" &&
    isset($_GET['category']) && $_GET['category'] === "all" &&
    isset($_GET['priority']) && $_GET['priority'] === "all"
) {
    header("Location: my_tasks.php");
    exit;
}
$title_page = 'My Tasks';
require_once __DIR__ . '/../../includes/header.php';
require_once __DIR__ . '/../../includes/gate_user.php';
require_once __DIR__ . '/../../functions/users.php';
require_once __DIR__ . '/../../functions/tasks.php';
require_once __DIR__ . '/../../functions/category.php';

$tasks = getTasksById($user_id);
$total_tasks = 0;
$total_tasks_progress = 0;
$total_tasks_done = 0;
$total_tasks_high_priority = 0;
$categories = getCategories();
$status = "";
$category = "";
$priority = "";


if (isset($_GET['status']) && isset($_GET['category']) && isset($_GET['priority'])) {
    $status = $_GET['status'];
    $category = $_GET['category'];
    $priority = $_GET['priority'];
    $tasks = getTasksByStatusCategoryPriority($user_id, $status, $category, $priority);
}

if ($tasks) {
    foreach ($tasks as $task) {
        if ($task['status'] === 'progress') {
            $total_tasks_progress++;
        }
        elseif ($task['status'] === 'done') {
            $total_tasks_done++;
        }
        if($task['priority'] === 'high'){
            $total_tasks_high_priority++;
        }
        $total_tasks++; 
    }
}
?>

<main class="p-6 bg-gray-50 min-h-screen">
    <div class="max-w-5xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">My Tasks</h1>
            <button id="openModalBtn" class="px-4 py-2 bg-indigo-600 text-white text-sm rounded hover:bg-indigo-700 transition">
                Add Task
            </button>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-xl shadow-sm p-5 mb-6 border border-gray-100">
                    <form method="get" class="grid grid-cols-1 sm:grid-cols-4 gap-3 w-full md:w-auto">
                        <select name="category" class="text-sm rounded-lg py-2 px-3 border-gray-200">
                            <option value="all" <?= ($category === 'all') ? 'selected' : ''; ?>>All Categories</option>
                            <?php foreach ($categories as $cat): // Ganti $category menjadi $cat untuk menghindari konflik dengan variabel $category dari $_GET ?>
                                <option value="<?= $cat['id']; ?>" <?= ((string)$cat['id'] === $category) ? 'selected' : ''; ?>>
                                    <?= $cat['name']; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            
                            <select name="priority" class="text-sm rounded-lg py-2 px-3 border-gray-200">
                                <option value="all" <?= ($priority === 'all') ? 'selected' : ''; ?>>All Priorities</option>
                                <option value="high" <?= ($priority === 'high') ? 'selected' : ''; ?>>High</option>
                                <option value="medium" <?= ($priority === 'medium') ? 'selected' : ''; ?>>Medium</option>
                                <option value="low" <?= ($priority === 'low') ? 'selected' : ''; ?>>Low</option>
                            </select>
                            
                            <select name="status" class="text-sm rounded-lg py-2 px-3 border-gray-200">
                                <option value="all" <?= ($status === 'all') ? 'selected' : ''; ?>>All Status</option>
                                <option value="progress" <?= ($status === 'progress') ? 'selected' : ''; ?>>Progress</option>
                                <option value="done" <?= ($status === 'done') ? 'selected' : ''; ?>>Done</option>
                            </select>

                            <button type="submit" class="text-sm font-medium bg-indigo-600 text-white py-2 px-3 rounded-lg hover:bg-indigo-700 transition">
                            Apply Filters
                        </button>
                    </form>
        </div>

        <!-- Tasks List -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
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
                            <div class="text-xs text-gray-500 truncate max-w-xs"><?= ucfirst($task['category_name'] ?? '-') ?></div>
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
                            <a href="/pages/user/edit_task_user.php?id=<?= $task['id'] ?>" class="text-indigo-600 hover:text-indigo-900" title="Edit">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            </a>
                            <?php if ($task['status'] !== 'done'): ?>
                                <a href="/pages/user/markdone_task_my_task.php?id=<?= $task['id'] ?>" class="text-green-600 hover:text-green-900" title="Complete" disabled>
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                </a>
                            <?php endif; ?>
                            <a href="/pages/user/delete_task_my_task.php?id=<?= $task['id'] ?>" class="text-red-600 hover:text-red-900" title="Delete">
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
        </div>
    </div>

    <!-- Include popup form -->
    <?php include('add_task_my_task.php'); ?>
</main>

<!-- Modal Script -->
<script>
    const openModalBtn = document.getElementById('openModalBtn');
    const modalBackdrop = document.getElementById('modalBackdrop');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const closeModalX = document.getElementById('closeModalX');

    openModalBtn?.addEventListener('click', () => {
        modalBackdrop?.classList.remove('hidden');
    });

    const closeModal = () => {
        modalBackdrop?.classList.add('hidden');
    }

    closeModalBtn?.addEventListener('click', closeModal);
    closeModalX?.addEventListener('click', closeModal);
    modalBackdrop?.addEventListener('click', (e) => {
        if (e.target === modalBackdrop) closeModal();
    });
</script>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
