<?php
$title_page = 'My Tasks';
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

        <!-- Tasks List -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
            <?php include('tasks_user.php'); ?>
        </div>
    </div>

    <!-- Include popup form -->
    <?php include('add_task_user.php'); ?>
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

<?php include_once('../../includes/footer.php'); ?>
