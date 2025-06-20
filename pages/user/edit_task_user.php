<?php
$title_page = 'Edit Task';
require_once __DIR__ . '/../../functions/tasks.php';

$id = (int) $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    updateTaskById($id, $_POST['title'], $_POST['description'], $_POST['priority'], $_POST['due_date'], $_POST['category_id']);
    header('Location: my_tasks.php');
    exit;
}
require_once __DIR__ . '/../../includes/gate_user.php'; 
require_once __DIR__ . '/../../includes/header.php';
require_once __DIR__ . '/../../functions/category.php';

if (!isset($_GET['id'])){
    header('Location: my_tasks.php');
    exit;
}

$task = getTaskById($id);
$categories = getCategories();

?>

<main class="min-h-screen bg-gray-50 flex items-center justify-center p-6">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
        <h2 class="text-xl font-semibold mb-4 text-center">Edit Task</h2>

        <form action="?id=<?= $id ?>" method="POST" class="space-y-4">
            <input type="hidden" name="user_id" value="<?= $user_id; ?>">
            <input type="hidden" name="status" value="progress">

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Task Title</label>
                <input type="text" name="title" id="title" required value="<?= htmlspecialchars($task['title']) ?>"
                    class="w-full mt-1 border rounded px-3 py-2 focus:outline-indigo-500 text-sm">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="3"
                    class="w-full mt-1 border rounded px-3 py-2 focus:outline-indigo-500 text-sm"><?= htmlspecialchars($task['description']) ?></textarea>
            </div>

            <div>
                <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
                <input type="date" name="due_date" id="due_date" value="<?= $task['due_date'] ?>"
                    class="w-full mt-1 border rounded px-3 py-2 focus:outline-indigo-500 text-sm">
            </div>

            <div>
                <label for="priority" class="block text-sm font-medium text-gray-700">Priority</label>
                <select name="priority" id="priority" 
                    class="w-full mt-1 border rounded px-3 py-2 text-sm focus:outline-indigo-500">
                    <option value="low" <?= $task['priority'] === 'low' ? 'selected' : '' ?>>Low</option>
                    <option value="medium" <?= $task['priority'] === 'medium' ? 'selected' : '' ?>>Medium</option>
                    <option value="high" <?= $task['priority'] === 'high' ? 'selected' : '' ?>>High</option>
                </select>
            </div>

            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">Categories</label>
                <select name="category_id" id="category_id"
                    class="w-full mt-1 border rounded px-3 py-2 text-sm focus:outline-indigo-500">
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id']; ?>" 
                            <?= $category['id'] == $task['category_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($category['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="flex justify-end space-x-3 pt-4 border-t">
                <a href="my_tasks.php" 
                   class="px-4 py-2 border rounded text-gray-700 hover:bg-gray-100 transition">Cancel</a>
                <button type="submit" name="update_task"
                    class="px-5 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                    Update Task
                </button>
            </div>
        </form>
    </div>
</main>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
