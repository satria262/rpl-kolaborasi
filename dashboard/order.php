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
} else ( requireLogin())
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
        

        <div class="border-1 border-white rounded-xl p-4 mt-10 h-100 w-full text-white">
            <table class="w-full">
                <tr>
                    <th class="text-start">Name</th>
                    <th class="text-start">Status</th>
                    <th class="text-start">Product</th>
                    <th class="text-start">Date</th>
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