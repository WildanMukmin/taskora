<?php
$title_page = 'Dashboard User';
include_once('../../includes/header.php');
include_once('../../includes/gate_user.php');
include_once('../../functions/users.php');
include_once('../../functions/tasks.php');
include_once('../../functions/category.php');

$tasks = getTasksById($user_id);
$total_tasks = 0;
$total_tasks_progress = 0;
$total_tasks_done = 0;
$total_tasks_high_priority = 0;
$categories = getCategories();
$status = "";
$category = "";
$priority = "";

if(isset($_GET["message"])) {
    echo $_GET['massage'];
}
if (isset($_GET['status']) === "all" && isset($_GET['category']) === "all" && isset($_GET['priority']) === "all"){
    header("Location: dashboard.php");
    exit;
}

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

<main class="flex-grow p-4 md:p-6 bg-gray-50">
    <div class="mb-8">
        <div class="bg-gradient-to-r from-indigo-50 to-blue-50 rounded-2xl shadow-sm p-6 flex flex-col md:flex-row items-start md:items-center justify-between border border-gray-100">
            <div>
                <h1 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-2">
                    Welcome back, <span class="text-indigo-600"><?= $username; ?></span>!
                </h1>
                <p class="text-gray-600">
                    You have <span class="font-medium text-gray-800"><?= $total_tasks; ?> tasks</span> in your list
                </p>
            </div>
            <button id="openModalBtn" class="mt-4 md:mt-0 px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                Add New Task
            </button>
        </div>
    </div>

       <!-- Stats Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <!-- Total Tasks -->
        <div class="bg-white rounded-xl p-5 hover:shadow-md transition border border-gray-100 group">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Tasks</p>
                    <h3 class="text-2xl font-bold text-gray-800"><?= $total_tasks; ?></h3>
                </div>
                <div class="p-2 rounded-lg bg-indigo-50 text-indigo-600 group-hover:bg-indigo-100 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-2 h-1 w-full bg-gray-100 rounded-full overflow-hidden">
                <div class="h-full bg-indigo-500" style="width: 100%"></div>
            </div>
        </div>

        <!-- In Progress -->
        <div class="bg-white rounded-xl p-5 hover:shadow-md transition border border-gray-100 group">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Progress</p>
                    <h3 class="text-2xl font-bold text-gray-800"><?= $total_tasks_progress; ?></h3>
                </div>
                <div class="p-2 rounded-lg bg-blue-50 text-blue-600 group-hover:bg-blue-100 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-2 h-1 w-full bg-gray-100 rounded-full overflow-hidden">
                <div class="h-full bg-blue-500" style="width: 60%"></div>
            </div>
        </div>

        <!-- Done -->
        <div class="bg-white rounded-xl p-5 hover:shadow-md transition border border-gray-100 group">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Done</p>
                    <h3 class="text-2xl font-bold text-gray-800"><?= $total_tasks_done; ?></h3>
                </div>
                <div class="p-2 rounded-lg bg-green-50 text-green-600 group-hover:bg-green-100 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-2 h-1 w-full bg-gray-100 rounded-full overflow-hidden">
                <div class="h-full bg-green-500" style="width: 40%"></div>
            </div>
        </div>

        <!-- High Priority -->
        <div class="bg-white rounded-xl p-5 hover:shadow-md transition border border-gray-100 group">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">High Priority</p>
                    <h3 class="text-2xl font-bold text-gray-800"><?= $total_tasks_high_priority; ?></h3>
                </div>
                <div class="p-2 rounded-lg bg-red-50 text-red-600 group-hover:bg-red-100 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-2 h-1 w-full bg-gray-100 rounded-full overflow-hidden">
                <div class="h-full bg-red-500" style="width: 20%"></div>
            </div>
        </div>

    </div>


    <!-- Task and Sidebar -->
    <div class="flex flex-col lg:flex-row gap-6">
        <div class="lg:w-2/3">
            <div class="bg-white rounded-xl shadow-sm p-5 mb-6 border border-gray-100">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <h2 class="text-lg font-semibold text-gray-800">My Tasks</h2>
                    <form method="get" class="grid grid-cols-1 sm:grid-cols-4 gap-3 w-full md:w-auto">
                        <select name="status" class="text-sm rounded-lg py-2 px-3 border-gray-200">
                            <option value="all" <?= ($status === 'all') ? 'selected' : ''; ?>>All Status</option>
                            <option value="progress" <?= ($status === 'progress') ? 'selected' : ''; ?>>Progress</option>
                            <option value="done" <?= ($status === 'done') ? 'selected' : ''; ?>>Done</option>
                        </select>

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
                        <button type="submit" class="text-sm font-medium bg-indigo-600 text-white py-2 px-3 rounded-lg hover:bg-indigo-700 transition">
                            Apply Filters
                        </button>
                    </form>
                </div>
            </div>

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
                                    <a href="/taskora/pages/user/edit_task_user.php" class="text-indigo-600 hover:text-indigo-900" title="Edit">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    </a>
                                    <a href="#" class="text-green-600 hover:text-green-900" title="Complete">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    </a>
                                    <a href="/taskora/pages/user/delete_task_dashboard.php?id=<?= $task['id'] ?>" class="text-red-600 hover:text-red-900" title="Delete">
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

        <!-- Right Sidebar -->
        <div class="lg:w-1/3">
            <div class="bg-white rounded-xl shadow-sm p-5 mb-6 border border-gray-100">
                <div class="flex-grow p-4 md:p-6 bg-gray-50 min-h-screen">
                    <div class="max-w-4xl mx-auto">
                        <div class="mb-6">
                            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Upcoming Deadlines</h2>

                            <div class="space-y-4">
                                <?php
                                $today = date('Y-m-d');

                                foreach ($tasks as $task):
                                    $due = $task['due_date'];
                                    $status = $task['status'];

                                    // Tampilkan hanya tugas yang masih dalam progress dan due date >= hari ini
                                    if ($status === 'progress' && $due >= $today):
                                        $daysLeft = (strtotime($due) - strtotime($today)) / (60 * 60 * 24);
                                        $badgeClass = match (true) {
                                            $daysLeft <= 2 => 'bg-red-100 text-red-800',
                                            $daysLeft <= 5 => 'bg-yellow-100 text-yellow-800',
                                            default => 'bg-green-100 text-green-800',
                                        };
                                ?>
                                <div class="p-5 rounded-xl border border-gray-100 hover:border-indigo-200 hover:bg-indigo-50/40 transition group bg-white shadow-sm">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-800 group-hover:text-indigo-600 transition">
                                                <?= htmlspecialchars($task['title']) ?>
                                            </h3>
                                            <p class="text-sm text-gray-600 mt-1">
                                                <?= htmlspecialchars($task['description']) ?>
                                            </p>
                                        </div>
                                        <span class="text-xs font-medium px-3 py-1 rounded-full <?= $badgeClass ?> self-start">
                                            <?= $daysLeft ?> day<?= $daysLeft != 1 ? 's' : '' ?> left
                                        </span>
                                    </div>
                                    <div class="mt-3 flex items-center text-xs text-gray-500">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <?= date('M d, Y', strtotime($due)) ?>
                                    </div>
                                </div>
                                <?php endif; endforeach; ?>

                                <?php if (!array_filter($tasks, fn($t) => $t['status'] === 'progress' && $t['due_date'] >= $today)): ?>
                                <p class="text-sm text-gray-500 text-center italic">No upcoming deadlines.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Include Modal -->
<?php include('add_task_user.php'); ?>

<!-- Script for modal toggle -->
<script>
    const openModalBtn = document.getElementById('openModalBtn');
    const modalBackdrop = document.getElementById('modalBackdrop');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const closeModalX = document.getElementById('closeModalX');

    openModalBtn?.addEventListener('click', () => {
        modalBackdrop?.classList.remove('hidden');
    });

    const closeModal = () => modalBackdrop?.classList.add('hidden');
    closeModalBtn?.addEventListener('click', closeModal);
    closeModalX?.addEventListener('click', closeModal);
    modalBackdrop?.addEventListener('click', (e) => {
        if (e.target === modalBackdrop) closeModal();
    });
</script>

<?php include_once('../../includes/footer.php'); ?>
