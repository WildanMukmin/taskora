<?php
$title_page = 'Edit Task';
include_once('../../includes/gate_user.php'); 
include_once('../../includes/header.php');

// Dummy task 
include('tasks.php');
?>

<main class="min-h-screen bg-gray-50 flex items-center justify-center p-6">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
        <h2 class="text-xl font-semibold mb-4 text-center">Edit Task</h2>

        <form action="#" method="POST" class="space-y-4">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Task Title</label>
                <input type="text" name="title" id="title" required
                    class="w-full mt-1 border rounded px-3 py-2 focus:outline-indigo-500 text-sm">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="3"
                    class="w-full mt-1 border rounded px-3 py-2 focus:outline-indigo-500 text-sm"></textarea>
            </div>

            <div>
                <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
                <input type="date" name="due_date" id="due_date"
                    class="w-full mt-1 border rounded px-3 py-2 focus:outline-indigo-500 text-sm">
            </div>

            <div>
                <label for="priority" class="block text-sm font-medium text-gray-700">Priority</label>
                <select name="priority" id="priority"
                    class="w-full mt-1 border rounded px-3 py-2 text-sm focus:outline-indigo-500">
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>

            <div>
                <label for="categories" class="block text-sm font-medium text-gray-700">Categories</label>
                <select name="category" id="categories"
                    class="w-full mt-1 border rounded px-3 py-2 text-sm focus:outline-indigo-500">
                    <option value="personal">Personal</option>
                    <option value="work">Work</option>
                    <option value="school">School</option>
                </select>
            </div>

            <div class="flex justify-end space-x-3 pt-4 border-t">
                <button type="button" id="closeModalBtn"
                    class="px-4 py-2 border rounded text-gray-700 hover:bg-gray-100 transition">Cancel</button>
                <button type="submit" name="add_task"
                    class="px-5 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                    Update Task
                </button>
            </div>
        </form>
    </div>
</main>

<?php include_once('../../includes/footer.php'); ?>
