<?php
require_once '../config/db.php';
require_once '../config/session.php';
if (isLoggedIn()) {
        $stmt = $conn->prepare("SELECT * FROM request");
        $stmt->execute();
        $result = $stmt->get_result();
        // $req = $result->fetch_assoc();
        // if ($req) {
        //     echo $req['name'];
        // } else {
        //     echo 'gagal';
        // }
} else {
    header('location: ../login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-[#111A23]">
    <div class="flex">
        <?php include '../dashboard/sidebar.php' ?>
        <div class="text-white">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Product</th>
                    <th>Date</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['status'] ?></td>
                    <td><?php echo $row['product'] ?></td>
                    <td><?php echo $row['create_at'] ?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</body>
</html>