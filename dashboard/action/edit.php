<?php
require_once '../../config/db.php';
require_once '../../config/session.php';

if (isLoggedIn()) {
    $product_id = $_GET['id'];
    $msg = '';

    $stmt = $conn->prepare('SELECT * FROM product WHERE id = ? ');
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $new_name = $_POST['name'];
        $new_description = $_POST['description'];
        $new_type = $_POST['type'] ?? 0;
        $new_price = $_POST['price'];
        $new_stock = $_POST['stock'];

        if (empty($new_type)) {
            $msg = 'Choose one of the type';
        } elseif ($new_price <= 0) {
            $msg = 'The price can not be zero or minus';
        } elseif ($new_stock <= 0) {
            $msg = 'The stock can not be zero or minus';
        } else {
            $stmt = $conn->prepare('UPDATE product SET name = ?, description = ?, type = ?, price = ?, stock = ? WHERE id = ? ');
            $stmt->bind_param("sssdii", $new_name, $new_description, $new_type, $new_price, $new_stock, $product_id);

            if ($stmt->execute()) {
                $new_name || $new_description || $new_type || $new_price || $new_stock = '';
                header('Location: ../../dashboard/product.php');
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
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-[#111A23]">
    <div class="grid grid-cols-5">
        <?php include '../../dashboard/sidebar.php' ?>
        <div class="p-4 col-span-4">
            <div class="p-4 mt-10 rounded-xl border-1 border-white">
                <div>
                    <p class="text-4xl font-semibold text-white">Products</p>
                    <p class="text-[#88ABCA]">Edit Products</p>
                </div>
                <form method="POST" class="text-white">
                    <?php while ($row = $result->fetch_assoc()) { ?>
                    <table class="h-12 table-auto w-full">
                        <tr class="text-[#88ABC1] border-b-1 border-b-white h-12">
                            <th class="text-start">Name</th>
                            <th class="text-start">Description</th>
                            <th class="text-start">Price</th>
                            <th class="text-start">Stock</th>
                        </tr>
                        <tr class="h-14 border-b-1 border-b-white text-white text-lg ">
                            <td><input type="text" name="name" value="<?php echo $row['name'] ?>"></td>
                            <td><input type="text" name="description" value="<?php echo $row['description'] ?>"></td>
                            <td><input type="text" name="price" value="<?php echo $row['price'] ?>"></td>
                            <td><input type="text" name="stock" value="<?php echo $row['stock'] ?>"></td>
                        </tr>
                    </table>
                    <div class="grid grid-cols-2 mt-4 gap-4">
                        <div class="flex justify-between col-span-2">
                            <p>Type: <?php echo $row['type'] ?></p>
                            <p class="text-yellow-500"><?php echo $msg ?></p>
                        </div>

                        <div class="rounded-lg border-1 border-white p-2 flex justify-between">
                            <label>Accessories</label>
                            <input type="radio" name="type" value="Accessories">
                        </div>

                        <div class="rounded-lg border-1 border-white p-2 flex justify-between">
                            <label>Components</label>
                            <input type="radio" name="type" value="Components">
                        </div>

                        <div class="rounded-lg border-1 border-white p-2 flex justify-between">
                            <label>Sparepart Laptop</label>
                            <input type="radio" name="type" value="Sparepart Laptop">
                        </div>
                        
                        <div class="rounded-lg border-1 border-white p-2 flex justify-between">
                            <label>Sparepart Pc</label>
                            <input type="radio" name="type" value="Sparepart Pc">
                        </div>

                        <button type="submit" class="col-span-2 bg-[#137FEC] rounded-lg p-2 text-xl font-medium">Update</button>
                    </div>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
</body>
</html>