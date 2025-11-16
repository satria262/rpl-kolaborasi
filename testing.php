<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
  <!-- Judul -->
  <h1 class="text-2xl font-semibold mb-6 text-gray-700">Admin Dashboard</h1>

  <!-- Wrapper tombol -->
  <div class="relative group">
    <!-- Tombol utama -->
    <button class="w-28 h-28 bg-blue-600 text-white rounded-full flex items-center justify-center text-lg font-semibold shadow-lg transition-transform duration-300 group-hover:scale-110">
      <i class="fas fa-cogs text-3xl">tes</i>
    </button>

    <!-- Tombol tersembunyi (muncul saat hover) -->
    <div class="absolute inset-0 flex items-center justify-center">
      <!-- Tombol 1 -->
      <a href="orders.php"
         class="absolute opacity-0 group-hover:opacity-100 bg-white text-blue-600 w-16 h-16 rounded-full flex items-center justify-center shadow-md transition-all duration-500 translate-y-0 group-hover:-translate-y-28">
         <i class="fas fa-shopping-cart text-2xl">a</i>
      </a>

      <!-- Tombol 2 -->
      <a href="products.php"
         class="absolute opacity-0 group-hover:opacity-100 bg-white text-green-600 w-16 h-16 rounded-full flex items-center justify-center shadow-md transition-all duration-500 delay-200 translate-x-0 group-hover:-translate-x-28">
         <i class="fas fa-box text-2xl">b</i>
      </a>

      <!-- Tombol 3 -->
      <a href="profile.php"
         class="absolute opacity-0 group-hover:opacity-100 bg-white text-yellow-600 w-16 h-16 rounded-full flex items-center justify-center shadow-md transition-all duration-500 delay-400 translate-x-0 group-hover:translate-x-28">
         <i class="fas fa-user text-2xl">c</i>
      </a>
    </div>
  </div>
</div>

<span class="relative flex size-4">
  <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-sky-400 opacity-75"></span>
  <span class="relative inline-flex size-3 rounded-full bg-sky-500"></span>
</span>

<!-- Font Awesome CDN -->
<script src="https://kit.fontawesome.com/a2e0b1d25f.js" crossorigin="anonymous"></script>

<?php 
$x = 1 + 2;
$y = 6 + 2;
$z = 11;

if ($z != ($x + $y)) {
  echo 'benar';
} else {
  echo 'salah';
}
?>

<?php
require_once 'config/db.php';
$pw = 'helo';
$hashed_pw = password_hash($pw, PASSWORD_BCRYPT);


// $stmt = $conn->prepare('UPDATE admin SET password = ? WHERE id = 1');
// $stmt->bind_param("s", $hashed_pw);
// if ($stmt->execute()) {
//   echo 'helo';
// }

?>

<?php
require_once 'config/db.php';
$admin = [
  'password'=>'admin1234'
];
if ($_SERVER['REQUEST_METHOD'] == ['POST']) {
  $name = $_POST['name'];
  $password = $_POST['password'];
  $statement = $conn->prepare('SELECT * FROM admin WHERE name = ? AND password = ?');
  $statement->bind_param("ss", $name, $password);
  if ($statement->execute()) {
    $result = $statement->get_result()->fetch_assoc();
    echo $result['password'];

  }
}


?>
<form metod="POST">
  <label>username</label>
  <input type="text" name="name">

  <label>password</label>
  <input type="password" name="password">
  <button type="submit">submit</button>
</form>
</body>
</html>