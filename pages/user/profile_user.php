<?php
$title_page = 'User Profile';
include_once('../../includes/gate_user.php');
include_once('../../includes/header.php');
include_once('../../functions/users.php');

$userProfile = getUser($user_id);

?>

<main class="flex justify-center items-center min-h-screen bg-gray-50 p-6">
    <div class="bg-white rounded-xl shadow-md border border-gray-200 max-w-xl w-full p-8">
        <div class="flex flex-col items-center">
            <h1 class="text-2xl font-semibold text-gray-800 mb-1"><?= htmlspecialchars($userProfile['name']); ?></h1>
            <p class="text-gray-500 mb-6"><?= htmlspecialchars($userProfile['email']); ?></p>

            <div class="w-full space-y-4 text-gray-700">
                <div class="flex justify-between border-b pb-2">
                    <span class="font-medium">E-mail:</span>
                    <span><?= htmlspecialchars($userProfile['email']); ?></span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span class="font-medium">Dibuat Pada:</span>
                    <span><?= date('F j, Y', strtotime($userProfile['created_at'])); ?></span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span class="font-medium">Role:</span>
                    <span><?= ucfirst(htmlspecialchars($userProfile['role'])); ?></span>
                </div>
            </div>

            <a href="edit_profile.php?id=<?= $userProfile['id']; ?>" class="mt-8 px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition font-semibold text-sm">
                Edit Profile
            </a>
        </div>
    </div>
</main>

<?php include_once('../../includes/footer.php'); ?>
