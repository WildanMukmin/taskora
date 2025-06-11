<?php
$title_page = 'Profile Settings';
include_once('../../functions/users.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    updateProfileUser($id, $name, $email);
    header("Location: profile_user.php");
    exit;
}
include_once('../../includes/gate_user.php');
include_once('../../includes/header.php');

$user = getUser($user_id);

?>

<main class="flex justify-center items-center min-h-screen bg-gray-50 p-6">
    <div class="bg-white rounded-xl shadow-md border border-gray-200 max-w-xl w-full p-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Edit Profile</h2>
        <form method="POST" class="space-y-5">
            <input type="hidden" name="user_id" value="<?= $user_id; ?>">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="name" required value="<?= htmlspecialchars($user['name']); ?>"
                    class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" required value="<?= htmlspecialchars($user['email']); ?>"
                    class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm">
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition font-semibold text-sm">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</main>

<?php include_once('../../includes/footer.php'); ?>
