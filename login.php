<?php

require_once 'config/db.php';
require_once 'config/session.php';

$error = '';


if (isLoggedIn()) {
    header('location: dashboard/dashboard.php');
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        if (empty($email) || empty($password)) {
            $error = 'Email, dan password harus diisi!';
        } else {
            $stmt = $conn->prepare("SELECT  name, email, password FROM admin WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {

                $admin = $result->fetch_assoc();
                if (password_verify(  $password,$admin['password'])) {
                    $_SESSION['id'] = $password;
                    header("Location: dashboard/dashboard.php");
                    exit();
                }
                else {
                $error = 'password salah';
                }
            } else {
                $error = 'akun tidak ditemukan';
            }
            $stmt->close();
        }
    }
}
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Seller Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-[#111A23]">
    <div class="min-h-screen flex items-center justify-center">
        <div class="w-full max-w-md bg-[#233647] rounded-lg shadow-md p-8">
            <h1 class="text-3xl font-bold text-center text-[#88ABCA] mb-8">Login Admin</h1>

            <?php if ($error): ?>
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-white mb-1">Email</label>
                    <input type="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-white mb-1">Password</label>
                    <input type="password" name="password" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg font-medium hover:bg-blue-700 transition">Login</button>
            </form>
        </div>
    </div>
</body>

</html>