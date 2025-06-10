<?php
$title_page = 'Tasks by Priority';
include_once('../../includes/header.php');
include_once('../../includes/gate_user.php');

// Dummy data tasks
include('tasks.php');
?>

<main class="p-6 bg-gray-50 min-h-screen">
    <div class="max-w-5xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Tasks by Priority</h1>

        <!-- High Priority -->
        <section class="mb-10">
            <h2 class="text-xl font-semibold text-red-600 mb-4">High Priority</h2>
            <div class="space-y-4">
                <?php foreach ($tasks as $task): ?>
                    <?php if ($task['priority'] === 'high'): ?>
                        <div class="bg-white border border-gray-100 rounded-lg p-4 shadow-sm hover:shadow-md transition">
                            <div class="flex justify-between items-start">
                                <h3 class="text-lg font-semibold text-gray-800"><?= htmlspecialchars($task['title']) ?></h3>
                                <span class="text-xs bg-red-100 text-red-700 px-2 py-1 rounded-full">High</span>
                            </div>
                            <p class="text-sm text-gray-600 mt-1"><?= htmlspecialchars($task['description']) ?></p>
                            <p class="text-xs text-gray-500 mt-2">Due: <?= date('M d, Y', strtotime($task['due_date'])) ?></p>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Medium Priority -->
        <section class="mb-10">
            <h2 class="text-xl font-semibold text-yellow-600 mb-4">Medium Priority</h2>
            <div class="space-y-4">
                <?php foreach ($tasks as $task): ?>
                    <?php if ($task['priority'] === 'medium'): ?>
                        <div class="bg-white border border-gray-100 rounded-lg p-4 shadow-sm hover:shadow-md transition">
                            <div class="flex justify-between items-start">
                                <h3 class="text-lg font-semibold text-gray-800"><?= htmlspecialchars($task['title']) ?></h3>
                                <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full">Medium</span>
                            </div>
                            <p class="text-sm text-gray-600 mt-1"><?= htmlspecialchars($task['description']) ?></p>
                            <p class="text-xs text-gray-500 mt-2">Due: <?= date('M d, Y', strtotime($task['due_date'])) ?></p>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Low Priority -->
        <section>
            <h2 class="text-xl font-semibold text-green-600 mb-4">Low Priority</h2>
            <div class="space-y-4">
                <?php foreach ($tasks as $task): ?>
                    <?php if ($task['priority'] === 'low'): ?>
                        <div class="bg-white border border-gray-100 rounded-lg p-4 shadow-sm hover:shadow-md transition">
                            <div class="flex justify-between items-start">
                                <h3 class="text-lg font-semibold text-gray-800"><?= htmlspecialchars($task['title']) ?></h3>
                                <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">Low</span>
                            </div>
                            <p class="text-sm text-gray-600 mt-1"><?= htmlspecialchars($task['description']) ?></p>
                            <p class="text-xs text-gray-500 mt-2">Due: <?= date('M d, Y', strtotime($task['due_date'])) ?></p>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
</main>

<?php include_once('../../includes/footer.php'); ?>
