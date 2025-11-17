<?php
require_once '../config/db.php';
require_once '../config/session.php';
if (isLoggedIn()) {
        $stmt = $conn->prepare("SELECT * FROM request ORDER BY id DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        // $req = $result->fetch_assoc();
        // if ($req) {
        //     echo $req['name'];
        // } else {
        //     echo 'gagal';
        // }
} else {
    requireLogin();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="/rpl-kolaborasi/style.css">
</head>
<body class="bg-[#111A23]">
    <div class="grid grid-cols-5">
        <?php include '../dashboard/sidebar.php' ?>
        <div class="col-span-4 p-4 overflow-auto h-screen">
            <div class="border-1 border-white rounded-xl p-4 mt-10 text-white space-y-10">
                <div>
                    <p class="text-4xl font-semibold">Orders</p>
                    <p class="text-[#88ABCA] mb-4">View your upcoming and recent orders</p>
                </div>
                <div class="rounded-xl border-1 border-white p-4 space-y-6">
                    <p class="text-[#88ABCA]">Balance</p>
                    <div class="grid grid-cols-4 w-full">
                        <!-- total order -->
                        <div>
                            <p class="text-[#88ABCA] text-3xl font-semibold">
                                <?php
                                $stmt = $conn->prepare('SELECT COUNT(*) as total_orders FROM request');
                                $stmt->execute();
                                $ttl = $stmt->get_result()->fetch_assoc();
                                echo $ttl['total_orders'];
                                ?>
                            </p>
                            <p class="text-white">Total Orders</p>
                        </div>
                        <!-- total buy -->
                        <div>
                            <p class="text-[#88ABCA] text-3xl font-semibold">
                                <?php
                                $stmt = $conn->prepare('SELECT COUNT(*) as total_buy FROM request WHERE type = ? ');
                                $status = 'buy';
                                $stmt->bind_param('s', $status);
                                $stmt->execute();
                                $ttl = $stmt->get_result()->fetch_assoc();
                                echo $ttl['total_buy'];
                                ?>
                            </p>
                            <p class="text-white">Total Buy</p>
                        </div>
                        <!-- total booking -->
                        <div>
                            <p class="text-[#88ABCA] text-3xl font-semibold">
                                <?php
                                $stmt = $conn->prepare('SELECT COUNT(*) as total_buy FROM request WHERE type = ? ');
                                $status = 'order';
                                $stmt->bind_param('s', $status);
                                $stmt->execute();
                                $ttl = $stmt->get_result()->fetch_assoc();
                                echo $ttl['total_buy'];
                                ?>
                            </p>
                            <p class="text-white">Total Book</p>
                        </div>
                        <!-- latest order -->
                        <div>
                            <p class="text-[#88ABCA] text-3xl font-semibold">
                                <?php
                                $stmt = $conn->prepare('SELECT create_at FROM request ORDER BY id DESC LIMIT 1');
                                $stmt->execute();
                                $ttl = $stmt->get_result()->fetch_assoc();
                                echo $ttl['create_at'];
                                ?>
                            </p>
                            <p class="text-white">Latest Order</p>
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    <table class="table-auto w-full">
                        <tr class=" h-10">
                            <th class="text-start">Name</th>
                            <th class="text-start">Type</th>
                            <th class="text-start">Message</th>
                            <th class="text-start">Create at</th>
                            <th class="text-start">Phone</th>
                            <th class="text-start">Action</th>
                        </tr>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr class="h-8 border-b-1 border-b-gray-400 h-15">
                            <td class=""><?php echo $row['name'] ?></td>
                            <td class=""><?php echo $row['type'] ?></td>
                            <td class=""><?php echo $row['message'] ?></td>
                            <td class=""><?php echo $row['create_at'] ?></td>
                            <td class=""><?php echo $row['phone'] ?></td>
                            <td class=""><a href="../dashboard/action/action.php?id=<?php echo $row['id'] ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </a></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>