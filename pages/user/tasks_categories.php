<?php
$title_page = 'Tasks by Category';
include_once('../../includes/header.php');
include_once('../../includes/gate_user.php'); 

// Dummy data task
include('tasks.php');
?>
<main class="p-6 bg-gray-50 min-h-screen">
    <div class="max-w-5xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Tasks by Category</h1>

        <!-- Personal -->
        <section class="mb-10">
            <h2 class="text-xl font-semibold text-pink-600 mb-4">Personal</h2>
            <div class="space-y-4">
                <?php foreach ($tasks as $task): ?>
                    <?php if ($task['category'] === 'personal'): ?>
                        <div class="bg-white border border-gray-100 rounded-lg p-4 shadow-sm hover:shadow-md transition">
                            <div class="flex justify-between items-start">
                                <h3 class="text-lg font-semibold text-gray-800"><?= htmlspecialchars($task['title']) ?></h3>
                                <span class="text-xs bg-pink-100 text-pink-700 px-2 py-1 rounded-full">Personal</span>
                            </div>
                            <p class="text-sm text-gray-600 mt-1"><?= htmlspecialchars($task['description']) ?></p>
                            <div class="text-xs text-gray-500 mt-2">Due: <?= date("M d, Y", strtotime($task['due_date'])) ?></div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- School -->
        <section class="mb-10">
            <h2 class="text-xl font-semibold text-blue-600 mb-4">School</h2>
            <div class="space-y-4">
                <?php foreach ($tasks as $task): ?>
                    <?php if ($task['category'] === 'school'): ?>
                        <div class="bg-white border border-gray-100 rounded-lg p-4 shadow-sm hover:shadow-md transition">
                            <div class="flex justify-between items-start">
                                <h3 class="text-lg font-semibold text-gray-800"><?= htmlspecialchars($task['title']) ?></h3>
                                <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded-full">School</span>
                            </div>
                            <p class="text-sm text-gray-600 mt-1"><?= htmlspecialchars($task['description']) ?></p>
                            <div class="text-xs text-gray-500 mt-2">Due: <?= date("M d, Y", strtotime($task['due_date'])) ?></div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Work -->
        <section>
            <h2 class="text-xl font-semibold text-yellow-600 mb-4">Work</h2>
            <div class="space-y-4">
                <?php foreach ($tasks as $task): ?>
                    <?php if ($task['category'] === 'work'): ?>
                        <div class="bg-white border border-gray-100 rounded-lg p-4 shadow-sm hover:shadow-md transition">
                            <div class="flex justify-between items-start">
                                <h3 class="text-lg font-semibold text-gray-800"><?= htmlspecialchars($task['title']) ?></h3>
                                <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full">Work</span>
                            </div>
                            <p class="text-sm text-gray-600 mt-1"><?= htmlspecialchars($task['description']) ?></p>
                            <div class="text-xs text-gray-500 mt-2">Due: <?= date("M d, Y", strtotime($task['due_date'])) ?></div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
</main>

<?php include_once('../../includes/footer.php'); ?>
