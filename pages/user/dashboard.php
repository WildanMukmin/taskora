<?php
$title_page = 'Dashboard User';
include_once('../../includes/header.php');
include_once('../../includes/gate_user.php');


// Dummy Data
$nama_user = 'MaoMao';
$total_tasks = 5;
$progress = 3;
$done = 2;
$high_priority = 1;
$due_soon = 2;
?>

<main class="flex-grow p-4 md:p-6 bg-gray-50">
    <div class="mb-8">
        <div class="bg-gradient-to-r from-indigo-50 to-blue-50 rounded-2xl shadow-sm p-6 flex flex-col md:flex-row items-start md:items-center justify-between border border-gray-100">
            <div>
                <h1 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-2">
                    Welcome back, <span class="text-indigo-600"><?= $nama_user; ?></span>!
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
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
        <!-- Total Tasks -->
        <div class="bg-white rounded-xl p-5 hover:shadow-md transition border border-gray-100 group">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Tasks</p>
                    <h3 class="text-2xl font-bold text-gray-800">5</h3>
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
                    <h3 class="text-2xl font-bold text-gray-800">3</h3>
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
                    <h3 class="text-2xl font-bold text-gray-800">2</h3>
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
                    <h3 class="text-2xl font-bold text-gray-800">1</h3>
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

        <!-- Due Soon -->
        <div class="bg-white rounded-xl p-5 hover:shadow-md transition border border-gray-100 group">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Due Soon</p>
                    <h3 class="text-2xl font-bold text-gray-800">2</h3>
                </div>
                <div class="p-2 rounded-lg bg-yellow-50 text-yellow-600 group-hover:bg-yellow-100 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-2 h-1 w-full bg-gray-100 rounded-full overflow-hidden">
                <div class="h-full bg-yellow-500" style="width: 40%"></div>
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
                            <option value="all">All Status</option>
                            <option value="progress">Progress</option>
                            <option value="done">Completed</option>
                        </select>
                        <select name="category" class="text-sm rounded-lg py-2 px-3 border-gray-200">
                            <option value="all">All Categories</option>
                            <option value="1">Work</option>
                            <option value="2">Personal</option>
                            <option value="3">Study</option>
                        </select>
                        <select name="priority" class="text-sm rounded-lg py-2 px-3 border-gray-200">
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
            </div>

            <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                <?php include('tasks_user.php'); ?>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="lg:w-1/3">
            <div class="bg-white rounded-xl shadow-sm p-5 mb-6 border border-gray-100">
                <?php include('upcoming_deadlines.php'); ?>
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
