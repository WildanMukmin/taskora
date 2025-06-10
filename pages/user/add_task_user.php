<?php
$title_page = 'Add New Task';
include_once('../../includes/gate_user.php');
include_once('../../includes/header.php');
?>

<main class="p-6 min-h-screen bg-gray-50">

    <!-- Modal backdrop -->
        <div id="modalBackdrop" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex justify-center items-center">

        <!-- Modal content -->
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
            <h2 class="text-xl font-semibold mb-4">Add New Task</h2>

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
                        <option value="medium" selected>Medium</option>
                        <option value="high">High</option>
                    </select>
                </div>

                <div>
                    <label for="categories" class="block text-sm font-medium text-gray-700">Categories</label>
                    <select name="priority" id="priority"
                        class="w-full mt-1 border rounded px-3 py-2 text-sm focus:outline-indigo-500">
                        <option value="personal">Work</option>
                        <option value="work" selected>Personal</option>
                        <option value="school">Study</option>
                    </select>
                </div>

                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <button type="button" id="closeModalBtn"
                        class="px-4 py-2 border rounded text-gray-700 hover:bg-gray-100 transition">Cancel</button>
                    <button type="submit" name="add_task"
                        class="px-5 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                        Add Task
                    </button>
                </div>
            </form>

            <!-- Close button -->
            <button id="closeModalX" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 text-xl" title="Close">
                &times;
            </button>
        </div>
    </div>
</main>

<script>
// Simple toggle modal
document.getElementById('openModalBtn').addEventListener('click', () => {
    document.getElementById('modalBackdrop').classList.remove('hidden');
});
document.getElementById('closeModalBtn').addEventListener('click', () => {
    document.getElementById('modalBackdrop').classList.add('hidden');
});
document.getElementById('closeModalX').addEventListener('click', () => {
    document.getElementById('modalBackdrop').classList.add('hidden');
});
</script>

<?php include_once('../../includes/footer.php'); ?>
