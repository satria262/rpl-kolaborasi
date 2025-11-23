<?php
require_once 'config/db.php';

$pw = 'adminsatria';
$hash_pw = password_hash($pw, PASSWORD_BCRYPT);

$stmt = $conn->prepare('UPDATE admin SET password = ?');
$stmt->bind_param("s", $hash_pw);
 if ($stmt->execute()) {
    echo 'berhasil';
 } else {
    echo 'gagal';
 }
 exit();
?>