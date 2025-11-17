<?php
require_once '../config/db.php';
require_once '../config/session.php';
$msg = '';

if (isLoggedIn()) {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $product = $_POST['name'];
        $description = $_POST['description'];
        $type = $_POST['type'] ?? 0;
        $price = $_POST['price'];
        $stock = $_POST['stock'];

        if (empty($product) || empty($description) || empty($price) || empty($stock) || empty($type)) {
            $msg = 'Please fill the empty fields';
        } else {
            $stmt = $conn->prepare('INSERT INTO product (name, description, type, price, stock) VALUES (?, ?, ?, ?, ?)');
            $stmt->bind_param("sssdi", $product, $description, $type, $price, $stock);
            if ($stmt->execute()) {
                $msg = 'Success insert product';
                $product || $description || $type || $price || $stock = '';
            }
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
    <title>Add - Product</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-[#111A23]">
    <div class="grid grid-cols-5">
        <?php include '../dashboard/sidebar.php' ?>
        <div class="flex justify-center col-span-4 p-4 mt-10 space-y-4">
            <div class="border-1 border-white w-full rounded-xl p-4 text-white space-y-4">
                <div class="flex justify-between">
                    <div>
                        <p class="text-3xl font-medium">Add Product</p>
                        <p class="text-xl font-medium text-[#88ABCA]">Insert the new product</p>
                    </div>
                    <p class="text-[#88ABCA] transition-all duration-500  text-3xl font-medium"><?php echo $msg ?></p>
                </div>
                <form method="POST" class="space-y-3">
                    <div class="flex flex-col">
                        <label>Name</label>
                        <input type="text" name="name" placeholder="Give your product a short and clear name." class="outline-none border-1 border-white p-2 mt-1 rounded-lg bg-[#111A23]">
                    </div>

                    <div class="flex flex-col">
                        <label>Description</label>
                        <input type="text" name="description" placeholder="Give your product a short and clear description." class="outline-none   border-1 border-white p-2 mt-1 rounded-lg bg-[#111A23]">
                    </div>

                    <div class="flex flex-col">
                        <label>Price</label>
                        <input type="text" name="price" placeholder="Set the price" class="outline-none border-1 border-white p-2 mt-1 rounded-lg bg-[#111A23]">
                    </div>

                    <div class="flex flex-col">
                        <label>Stock</label>
                        <input type="text" name="stock" placeholder="Set the stock" class="outline-none border-1 border-white p-2 mt-1 rounded-lg bg-[#111A23]">
                    </div>

                    <p>Type</p>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex justify-between border-1 border-white rounded-lg p-2 hover:border-[#233467] transition-all">
                            <label>Accessories</label>
                            <input type="radio" name="type" value="Accessories">
                        </div>

                        <div class="flex justify-between border-1 border-white rounded-lg p-2 hover:border-[#233467] transition-all">
                            <label>Components</label>
                            <input type="radio" name="type" value="Components">
                        </div>

                        <div class="flex justify-between border-1 border-white rounded-lg p-2 hover:border-[#233467] transition-all">
                            <label>Sparepart Laptop</label>
                            <input type="radio" name="type" value="Sparepart Laptop">
                        </div>
    
                        <div class="flex justify-between border-1 border-white rounded-lg p-2 hover:border-[#233467] transition-all">
                            <label>Sparepart Pc</label>
                            <input type="radio" name="type" value="Sparepart Pc">
                        </div>
                    </div>

                    <button type="submit" class="bg-[#137FEC] p-4 rounded-lg w-full text-xl font-medium mt-4 border-1 border-blue-700">Publish Product</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>