<?php
$title_page = 'Profile Settings';
include_once('../../includes/gate_user.php');
include_once('../../includes/header.php');

// Sample user data (replace with your actual database query)
$user = [
    'first_name' => 'Mao',
    'last_name' => 'Mao',
    'email' => 'mao@example.com',
    'birth_date' => '2005-05-15',
    'gender' => 'female',
    'photo' => 'default.jpg',
    'bio' => 'Passionate about productivity and getting things done. Loves nature and coffee.',
    'theme_preference' => 'light',
    'notifications_enabled' => true,
    'timezone' => 'Asia/Jakarta'
];
?>

<main class="flex items-center justify-center min-h-screen bg-gray-50 p-4 md:p-8">
    <div class="w-full max-w-4xl bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <!-- Header with back button -->
        <div class="flex items-center gap-4 mb-6">
            <a href="dashboard.php" class="text-gray-500 hover:text-indigo-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
            </a>
            <h1 class="text-xl font-semibold text-gray-800">Profile Settings</h1>
        </div>

        <form action="update_profile.php" method="POST" enctype="multipart/form-data" class="space-y-8">
            <!-- Profile Section -->
            <div class="space-y-6">
                <h2 class="text-lg font-medium text-gray-800 border-b pb-2">Profile Information</h2>
                
                <!-- Profile Photo -->
                <div class="flex flex-col sm:flex-row items-start gap-6">
                    <div class="relative">
                        <img src="uploads/<?= $user['photo'] ?>" 
                             class="w-24 h-24 rounded-full object-cover border-2 border-white shadow-sm" 
                             id="photoPreview" 
                             alt="Profile Photo">
                        <div class="absolute bottom-0 right-0 bg-white rounded-full p-1 shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </div>
                    
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Update Profile Photo</label>
                        <div class="flex flex-col sm:flex-row gap-3">
                            <label class="flex-1 cursor-pointer">
                                <input type="file" 
                                       name="photo" 
                                       id="photoUpload" 
                                       class="sr-only"
                                       accept="image/jpeg,image/png">
                                <div class="w-full border border-dashed border-gray-300 rounded-lg px-4 py-8 text-center hover:border-indigo-300 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <p class="mt-1 text-sm text-gray-600">Click to upload</p>
                                    <p class="text-xs text-gray-400 mt-1">JPG or PNG, max 2MB</p>
                                </div>
                            </label>
                            <button type="button" onclick="document.getElementById('photoUpload').value = ''" class="px-4 py-2 border rounded-md text-sm text-gray-700 hover:bg-gray-50 self-center">
                                Remove
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Personal Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                        <input type="text" 
                               name="first_name" 
                               id="first_name" 
                               value="<?= htmlspecialchars($user['first_name']) ?>" 
                               class="w-full px-3 py-2 border rounded-md text-sm focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition">
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                        <input type="text" 
                               name="last_name" 
                               id="last_name" 
                               value="<?= htmlspecialchars($user['last_name']) ?>" 
                               class="w-full px-3 py-2 border rounded-md text-sm focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition">
                    </div>
                </div>
                
                <div>
                    <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">About Me</label>
                    <textarea name="bio" 
                              id="bio" 
                              rows="3" 
                              class="w-full px-3 py-2 border rounded-md text-sm focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition"><?= htmlspecialchars($user['bio']) ?></textarea>
                </div>
            </div>
            
            <!-- Account Settings -->
            <div class="space-y-6">
                <h2 class="text-lg font-medium text-gray-800 border-b pb-2">Account Settings</h2>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           value="<?= htmlspecialchars($user['email']) ?>" 
                           class="w-full px-3 py-2 border rounded-md text-sm bg-gray-50 cursor-not-allowed" 
                           readonly>
                    <p class="text-xs text-gray-500 mt-1">Contact support to change your email address</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                        <input type="date" 
                               name="birth_date" 
                               id="birth_date" 
                               value="<?= $user['birth_date'] ?>" 
                               class="w-full px-3 py-2 border rounded-md text-sm focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition">
                    </div>
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                        <select name="gender" 
                                id="gender" 
                                class="w-full px-3 py-2 border rounded-md text-sm focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition">
                            <option value="male" <?= $user['gender'] === 'male' ? 'selected' : '' ?>>Male</option>
                            <option value="female" <?= $user['gender'] === 'female' ? 'selected' : '' ?>>Female</option>
                            <option value="other" <?= $user['gender'] === 'other' ? 'selected' : '' ?>>Other</option>
                            <option value="prefer-not-to-say">Prefer not to say</option>
                        </select>
                    </div>
                </div>
            </div>
                    
            <!-- Actions -->
            <div class="pt-6 border-t flex flex-col sm:flex-row justify-end gap-3">
                <a href="dashboard.php" class="px-4 py-2 border rounded-md text-sm text-gray-700 hover:bg-gray-50 text-center transition">Cancel</a>
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-700 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Profile photo preview
    const photoUpload = document.getElementById('photoUpload');
    const photoPreview = document.getElementById('photoPreview');
    
    if (photoUpload && photoPreview) {
        photoUpload.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    photoPreview.src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }
    
    // Form validation could be added here
});
</script>

<?php include_once('../../includes/footer.php'); ?>