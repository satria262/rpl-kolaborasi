<?php
require_once '../config/db.php';
require_once '../config/session.php';
$msg = '';

if (isLoggedIn()) {
    // if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        // $search = $_GET['searchbar'] ?? '';
        $statement = $conn->prepare("SELECT * FROM product ORDER BY id DESC");//untuk fungsi search tambahkan " WHERE name LIKE ?"
        // $param = '%$search%';
        // $statement->bind_param("s", $param);
        $statement->execute();
        $rslt = $statement->get_result();
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
    <title>Product</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="/rpl-kolaborasi/style.css">
</head>
<body class="bg-[#111A23]">
    <div class="grid grid-cols-5">
        <?php include '../dashboard/sidebar.php' ?>
        <div class="p-4 col-span-4 h-screen overflow-auto">
            <div class="p-4 mt-10 rounded-xl border-1 border-white space-y-10">
                <div class="flex justify-between items-center -mb-0">
                    <div>
                        <p class="text-4xl font-semibold text-white">Products</p>
                        <p class="text-[#88ABCA] mb-4">View and manage your products</p>
                    </div>
                    <!-- comment dibawah untuk menambah searchbar -->
                    <!-- <div class="flex items-center space-x-2 px-2 h-12 w-3/10 border-1 border-white rounded-xl text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                        <form method="GET"><input type="text" name="searchbar" placeholder="Search for products" class="outline-none    "></form>
                    </div> -->
                </div>
                <div class="rounded-xl border-1 border-white p-4 space-y-6 text-white">
                    <p class="text-[#88ABCA]">Balance</p>
                    <div class="w-full grid grid-cols-5 text-center ">
                        <!-- total product -->
                        <div>
                            <p class="text-[#88ABCA] text-3xl font-semibold">
                                <?php
                                $stmt = $conn->prepare('SELECT COUNT(*) as total_product FROM product');
                                $stmt->execute();
                                $ttl = $stmt->get_result()->fetch_assoc();
                                echo $ttl['total_product'];
                                ?>
                            </p>
                            <p class="text-white">Total Product</p>
                        </div>
                        <!-- total stock -->
                        <div>
                            <p class="text-[#88ABCA] text-3xl font-semibold">
                                <?php
                                $stmt = $conn->prepare('SELECT SUM(stock) as total_stock FROM product ');
                                $stmt->execute();
                                $ttl = $stmt->get_result()->fetch_assoc();
                                echo $ttl['total_stock'];
                                if ($ttl['total_stock'] < 50) {
                                    $msg = 'Low';
                                }
                                ?>
                            </p>
                            <p class="text-white">Total Stock</p>
                            <p class="text-yellow-500"><?php echo $msg ?></p>
                        </div>
                        <!-- total value -->
                        <div>
                            <p class="text-[#88ABCA] text-3xl font-semibold">
                                <?php
                                $stmt = $conn->prepare('SELECT SUM(price * stock) as total_price FROM product ');
                                $stmt->execute();
                                $ttl = $stmt->get_result()->fetch_assoc();
                                echo 'Rp: '.number_format($ttl['total_price']);
                                if ($ttl['total_price'] > 10000000) {
                                    $msg = "High";
                                }
                                ?>
                            </p>
                            <p class="text-white">Total Value</p>
                            <p class="text-yellow-500"><?php echo $msg ?></p>
                        </div>
                        <!-- Highest stock -->
                        <div>
                            <p class="text-[#88ABCA] text-3xl font-semibold">
                                <?php
                                $stmt = $conn->prepare('SELECT stock as highest_stock FROM product ORDER BY stock DESC LIMIT 1');
                                $stmt->execute();
                                $ttl = $stmt->get_result()->fetch_assoc();
                                echo 'Rp: '.number_format($ttl['highest_stock']);
                                ?>
                            </p>
                            <p class="text-white">Highest Stock</p>
                        </div>
                        <!-- Highest price -->
                        <div>
                            <p class="text-[#88ABCA] text-3xl font-semibold">
                                <?php
                                $stmt = $conn->prepare('SELECT price as highest_price FROM product ORDER BY price DESC LIMIT 1');
                                $stmt->execute();
                                $ttl = $stmt->get_result()->fetch_assoc();
                                echo 'Rp: '.number_format($ttl['highest_price']);
                                if ($ttl['highest_price'] > 150000) {
                                    $msg = 'High';
                                }
                                ?>
                            </p>
                            <p class="text-white">Highest Stock</p>
                            <p class="text-yellow-500"><?php echo $msg ?></p>
                        </div>
                    </div>
                </div>
                <table class="h-12 table-auto w-full">
                    <tr class="text-[#88ABC1] border-b-1 border-b-white h-12">
                        <th class="text-start">Name</th>
                        <th class="text-start">Description</th>
                        <th class="text-start">Type</th>
                        <th class="text-start">Price</th>
                        <th class="text-start">Stock</th>
                        <th class="text-start">Update</th>
                        <th class="text-start">Edit</th>
                    </tr>
                    <?php while ($product = $rslt->fetch_assoc()) { ?>
                    <tr class="h-16 border-b-1 border-b-white text-white text-base ">
                        <td><?php echo htmlspecialchars($product['name']) ?></td>
                        <td><?php echo htmlspecialchars($product['description']) ?></td>
                        <td><?php echo htmlspecialchars($product['type']) ?></td>
                        <td><?php echo "Rp ".number_format($product['price'], 0, ',', '.').',00'; ?></td>
                        <td><?php echo $product['stock'] ?></td>
                        <td><?php echo $product['create_at'] ?></td>
                        <td>
                            <a href="../dashboard/action/edit.php?id=<?php echo $product['id'] ?>">
                                <p class="bg-green-500 px-2 rounded-full mb-1 text-center">Edit</p>
                            </a>
                            <a href="../dashboard/action/remove.php?id=<?php echo $product['id'] ?>" onclick="return confirm('Are you sure you want to delete this product?')">
                                <p class="bg-red-500 px-2 rounded-full mb-1 text-center">Delete</p>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>