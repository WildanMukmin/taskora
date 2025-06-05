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
    $name   = mysqli_real_escape_string($conn, trim($_POST['name']));
    $email  = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

    if (empty($name) || empty($email) || empty($_POST['password'])) {
        $_SESSION['error'] = "Semua field wajib diisi.";
        header("Location: register.php");
        exit;
    }

    $checkQuery = "SELECT * FROM users WHERE email = '$email'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if ($checkResult && mysqli_num_rows($checkResult) > 0) {
        $_SESSION['error'] = "Email sudah terdaftar.";
        header("Location: register.php");
        exit;
    }

    $insertQuery = "INSERT INTO users (name, email, password) 
                    VALUES ('$name', '$email', '$password')";

    if (mysqli_query($conn, $insertQuery)) {
        $_SESSION['success'] = "Registrasi berhasil! Silakan login.";
        header("Location: login.php");
        exit;
    } else {
        $_SESSION['error'] = "Terjadi kesalahan saat menyimpan data.";
        header("Location: register.php");
        exit;
    }
}
?>



<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Register - Taskora</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center px-4">
  <div class="w-full max-w-md p-8 space-y-6 bg-white border border-gray-200 rounded-xl shadow-lg">
    <div class="text-center">
      <h1 class="text-3xl font-bold text-indigo-600">Create Account</h1>
      <p class="text-sm text-gray-500 mt-1">Join Taskora and start organizing better.</p>
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

    <form method="POST" action="register.php" class="space-y-4">
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
        <input type="text" name="name" id="name" required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
      </div>

      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" name="email" id="email" required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" name="password" id="password" required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
      </div>

      <button type="submit"
              class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
        Register
      </button>
    </form>

    <p class="text-center text-sm text-gray-500">
      Already have an account?
      <a href="login.php" class="text-indigo-600 hover:underline font-medium">Log in</a>
    </p>
  </div>
</body>
</html>
