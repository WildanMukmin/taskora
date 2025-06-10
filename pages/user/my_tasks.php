<?php
$title_page = 'My Tasks';
include_once('../../includes/header.php');
include_once('../../includes/gate_user.php');

// Dummy task list

$tasks = [
    [
        'title' => 'Finish UI Design',
        'description' => 'Create mobile layout',
        'due_date' => '2025-06-14',
        'priority' => 'high',
        'status' => 'progress'
    ],
    [
        'title' => 'Prepare presentation',
        'description' => 'For next week\'s demo',
        'due_date' => '2025-06-18',
        'priority' => 'medium',
        'status' => 'done'
    ]
];
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
            <form method="get" class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                <select name="status" class="text-sm rounded-lg border-gray-200 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 py-2 px-3 bg-gray-50 hover:bg-white transition">
                    <option value="all">All Status</option>
                    <option value="progress">In Progress</option>
                    <option value="done">Completed</option>
                </select>
                <select name="category" class="text-sm rounded-lg border-gray-200 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 py-2 px-3 bg-gray-50 hover:bg-white transition">
                    <option value="all">All Categories</option>
                    <option value="1">Work</option>
                    <option value="2">Personal</option>
                    <option value="3">Study</option>
                </select>
                <select name="priority" class="text-sm rounded-lg border-gray-200 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 py-2 px-3 bg-gray-50 hover:bg-white transition">
                    <option value="all">All Priorities</option>
                    <option value="high">High</option>
                    <option value="medium">Medium</option>
                    <option value="low">Low</option>
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
