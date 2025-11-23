<?php
require_once __DIR__.'/../../config/db.php';
require_once __DIR__.'/../../config/session.php';
if (isLoggedIn()) {
        $id = $_GET['id'];
        $stmt = $conn->prepare("SELECT * FROM request WHERE id = ? ORDER BY id DESC");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        // $req = $result->fetch_assoc();
        // if ($req) {
        //     echo $req['name'];
        // } else {
        //     echo 'gagal';
        // }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $status = $_POST['status'] ?? 'Your order is processed';
            $detail = $_POST['detail'] ?? 'Your order is processed';

            $stmt = $conn->prepare('UPDATE request SET status = ?, DETAIL = ? WHERE id = ?');
            $stmt->bind_param("ssi", $status, $detail, $id);
            if ($stmt->execute()) {
                header('location: ../order.php');
                $status || $detail = '';
            }
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
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="/RPL-KOLABORASI/style.css">
</head>
<body class="bg-[#111A23]">
    <div class="grid grid-cols-5">
        <?php include __DIR__.'/../../dashboard/sidebar.php' ?>
        <div class="col-span-4 p-4 overflow-auto">
            <div class="border-1 border-white rounded-xl p-4 mt-10 text-white space-y-10">
                <div>
                    <p class="text-4xl font-semibold">Action</p>
                    <p class="text-[#88ABCA] mb-4">Reply the messages</p>
                </div>
                <div class="w-full">
                    <table class="table-auto w-full">
                        <tr class=" h-10">
                            <th class="text-start">Name</th>
                            <th class="text-start">Type</th>
                            <th class="text-start">Message</th>
                            <th class="text-start">Create at</th>
                            <th class="text-start">Phone</th>
                        </tr>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr class="h-8 border-b-1 border-b-gray-400 h-15">
                            <td class=""><?php echo $row['name'] ?></td>
                            <td class=""><?php echo $row['type'] ?></td>
                            <td class=""><?php echo $row['message'] ?></td>
                            <td class=""><?php echo $row['create_at'] ?></td>
                            <td class=""><?php echo $row['phone'] ?></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
                <div>
                    <p class="text-2xl font-medium">Your reply will be visible to buyer</p>
                    <form method="POST" class="grid grid-cols-5 gap-8">

                        <div class="flex flex-col space-y-2 col-span-1">
                            <label>Status: </label>
                            <select name="status" class="outline-none border-1 border-white h-full p-2 rounded-lg">
                                <option value="">Select</option>
                                <option value="Has been read" class="text-black">Has been read</option>
                                <option value="Has been confirmed" class="text-black">Has been confirmed</option>
                                <option value="Has been declined" class="text-black">Has been declined</option>
                            </select>
                        </div>
                        
                        <div class="flex flex-col space-y-2 col-span-3">
                            <label>Message:</label>
                            <input type="text" name="detail" placeholder="Type the details" class="outline-none border-1 border-white p-2 rounded-lg bg-[#111A23]">
                        </div>

                        <button type="submit" class="bg-[#137FEC] p-2 rounded-lg font-medium text-2xl" onclick="return alert('Your reply has been sent')">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>