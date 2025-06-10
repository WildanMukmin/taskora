<?php
$title_page = 'Tasks by Category';
include_once('../../includes/header.php');
include_once('../../includes/gate_user.php'); 
include_once('../../functions/tasks.php');
include_once('../../functions/category.php');

$categories = getCategories();
$tasks = getTasksById($user_id);
?>
<main class="p-6 bg-gray-50 min-h-screen">
    <div class="max-w-5xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Tasks by Category</h1>

        <!-- Personal -->
         <?php foreach ($categories as $category): ?>
            <section class="mb-10">
                <h2 class="text-xl font-semibold text-blue-600 mb-4"><?= $category['name'] ?></h2>
                <div class="space-y-4">
                    <?php foreach ($tasks as $task): ?>
                        <?php if ($task['category_id'] === $category['id']): ?>
                            <div class="bg-white border border-gray-100 rounded-lg p-4 shadow-sm hover:shadow-md transition">
                                <div class="flex justify-between items-start">
                                    <h3 class="text-lg font-semibold text-gray-800"><?= htmlspecialchars($task['title']) ?></h3>
                                    <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded-full"><?= $category['name'] ?></span>
                                </div>
                                <p class="text-sm text-gray-600 mt-1"><?= htmlspecialchars($task['description']) ?></p>
                                <div class="text-xs text-gray-500 mt-2">Due: <?= date("M d, Y", strtotime($task['due_date'])) ?></div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endforeach; ?>
    </div>
</main>

<?php include_once('../../includes/footer.php'); ?>
