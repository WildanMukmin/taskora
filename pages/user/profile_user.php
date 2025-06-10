<?php
$title_page = 'User Profile';
include_once('../../includes/gate_user.php');
include_once('../../includes/header.php');

// Dummy 
$user = [
    'first_name' => 'mao',
    'last_name' => 'mao',
    'email' => 'user@example.com',
    'birth_date' => '2005-05-15',
    'gender' => 'female',
    'photo' => 'default.jpg',
    'bio' => 'Passionate about productivity and getting things done. Loves nature and coffee.'
];
?>

<main class="flex justify-center items-center min-h-screen bg-gray-50 p-6">
    <div class="bg-white rounded-xl shadow-md border border-gray-200 max-w-xl w-full p-8">
        <div class="flex flex-col items-center">
            <img src="uploads/<?= htmlspecialchars($user['photo']); ?>" alt="User Photo" class="w-32 h-32 rounded-full object-cover border-4 border-indigo-500 shadow-sm mb-6">
            <h1 class="text-2xl font-semibold text-gray-800 mb-1"><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></h1>
            <p class="text-gray-500 mb-6"><?= htmlspecialchars($user['email']); ?></p>

            <div class="w-full space-y-4 text-gray-700">
                <div class="flex justify-between border-b pb-2">
                    <span class="font-medium">E-mail:</span>
                    <span><?= htmlspecialchars($user['email']); ?></span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span class="font-medium">Date of Birth:</span>
                    <span><?= date('F j, Y', strtotime($user['birth_date'])); ?></span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span class="font-medium">Gender:</span>
                    <span><?= ucfirst(htmlspecialchars($user['gender'])); ?></span>
                </div>
                <div>
                    <span class="font-medium">About Me:</span>
                    <p class="mt-1 text-gray-600"><?= nl2br(htmlspecialchars($user['bio'])); ?></p>
                </div>
            </div>

            <a href="edit_profile.php" class="mt-8 px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition font-semibold text-sm">
                Edit Profile
            </a>
        </div>
    </div>
</main>

<?php include_once('../../includes/footer.php'); ?>
