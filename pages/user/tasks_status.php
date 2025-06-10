<?php
$title_page = 'Tasks by Status';
include_once('../../includes/header.php');
include_once('../../includes/gate_user.php'); 

// Dummy task list
include('tasks.php');
?>

<main class="p-6 bg-gray-50 min-h-screen">
    <div class="max-w-5xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Tasks by Status</h1>

        <!-- Progress Tasks -->
        <section class="mb-10">
            <h2 class="text-xl font-semibold text-indigo-600 mb-4">In Progress</h2>
            <div class="space-y-4">
                <?php foreach ($tasks as $task): ?>
                    <?php if ($task['status'] === 'progress'): ?>
                        <div class="bg-white border border-gray-100 rounded-lg p-4 shadow-sm hover:shadow-md transition">
                            <div class="flex justify-between items-start">
                                <h3 class="text-lg font-semibold text-gray-800"><?= htmlspecialchars($task['title']) ?></h3>
                                <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full">Progress</span>
                            </div>
                            <p class="text-sm text-gray-600 mt-1"><?= htmlspecialchars($task['description']) ?></p>
                            <div class="text-xs text-gray-500 mt-2">
                                Due: <?= date("M d, Y", strtotime($task['due_date'])) ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Done Tasks -->
        <section>
            <h2 class="text-xl font-semibold text-green-600 mb-4">Completed</h2>
            <div class="space-y-4">
                <?php foreach ($tasks as $task): ?>
                    <?php if ($task['status'] === 'done'): ?>
                        <div class="bg-white border border-gray-100 rounded-lg p-4 shadow-sm hover:shadow-md transition">
                            <div class="flex justify-between items-start">
                                <h3 class="text-lg font-semibold text-gray-800"><?= htmlspecialchars($task['title']) ?></h3>
                                <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">Completed</span>
                            </div>
                            <p class="text-sm text-gray-600 mt-1"><?= htmlspecialchars($task['description']) ?></p>
                            <div class="text-xs text-gray-500 mt-2">
                                Due: <?= date("M d, Y", strtotime($task['due_date'])) ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
</main>

<?php include_once('../../includes/footer.php'); ?>
