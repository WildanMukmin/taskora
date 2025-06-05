<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../config/config.php';

if (isset($_SESSION['user']) && $role === 'user') {
    header("Location: ../user/dashboard.php");
    exit;
}
else if (isset($_SESSION['user']) && $role === 'admin') {
    header("Location: ../admin/dashboard.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($pass, $user['password'])) {
            unset($user['password']); // Jangan simpan password di session
            $_SESSION['user'] = $user;
            if ($user['role'] === 'user') {
                header("Location: ../user/dashboard.php");
                exit;
            }else if ($user["role"] === "admin") {
              header("Location: ../admin/dashboard.php");
              exit;
            }
        } else {
            $_SESSION['error'] = "Password salah.";
        }
    } else {
        $_SESSION['error'] = "Email tidak ditemukan.";
    }

    header("Location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - Taskora</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center px-4">
  <div class="w-full max-w-md p-8 space-y-6 bg-white border border-gray-200 rounded-xl shadow-lg">
    <div class="text-center">
      <h1 class="text-3xl font-bold text-indigo-600">Welcome to Taskora</h1>
      <p class="text-sm text-gray-500 mt-1">Login to manage your tasks efficiently.</p>
    </div>

    <?php if (isset($_SESSION['error'])): ?>
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded">
        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
      </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded">
        <?= $_SESSION['success']; unset($_SESSION['success']); ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="login.php" class="space-y-5">
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input type="email" name="email" id="email" required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input type="password" name="password" id="password" required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
      </div>

      <button type="submit"
              class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
        Sign In
      </button>
    </form>

    <p class="text-center text-sm text-gray-500">
      Don't have an account?
      <a href="register.php" class="text-indigo-600 hover:underline font-medium">Register here</a>
    </p>
  </div>
</body>
</html>
