<?php
require_once '../../config/db.php';
require_once '../../config/session.php';

if (isLoggedIn()) {
    $id = $_GET['id'];
    echo $id;
    $stmt = $conn->prepare('DELETE FROM product WHERE id = ?');
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo 'berhasil';
        header('location: ../../dashboard/product.php');
    } else {
        echo 'gagal';
    }
} else {
    requireLogin();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
    <button type="submit">delete</button>
    </form>
</body>
</html>