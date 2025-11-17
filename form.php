<?php
require_once 'config/db.php';
$success = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['username'];
    $pin = $_POST['pin'];
    $type = $_POST['type'];
    $message = $_POST['message'];
    $phone = $_POST['phone'];

    $stmt = $conn->prepare("INSERT INTO request (name, type, message, phone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $name, $type, $message, $phone);
    if ($stmt->execute()) {
        $success = '';
    }
}
$stmt = $conn->prepare('SELECT * FROM product ORDER BY id DESC LIMIT 10');
$stmt->execute();
$result = $stmt->get_result();

$statement = $conn->prepare('SELECT name, status, pp_path FROM admin');
$statement->execute();
$rslt = $statement->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-[#111A23]">
    <?php include 'components/navbar.php' ?>
    <div class="flex flex-col items-center space-y-12 mt-38">
        <!-- table -->
         <div class="bg-[#233647] w-9/10 rounded-xl p-4 space-y-2 border-1 border-white">
            <div class="space-y-1">
                <p class="text-white text-4xl font-semibold">Our Products</p>
                <div class="flex space-x-2">
                    <p class="text-white text-2xl">Available Product: </p>
                    <p class="text-white text-2xl font-semibold">
                        <?php
                        $stmt = $conn->prepare('SELECT COUNT(*) as total_row FROM product');
                        $stmt->execute();
                        $total = $stmt->get_result()->fetch_assoc();
                        echo $total['total_row'];                    
                        ?>
                    </p>
                </div>
            </div>
            <table class="w-full h-12 table-auto">
                <tr class="text-[#88ABC1] border-b-1 border-b-white h-12">
                    <th class="text-start">Name</th>
                    <th class="text-start">Description</th>
                    <th class="text-start">Price</th>
                    <th class="text-start">Stock</th>
                    <th class="text-start">Update</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr class="h-14 border-b-1 border-b-white text-white text-lg ">
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['description'] ?></td>
                    <td><?php echo "Rp ".number_format($row['price'], 0, ',', '.'); ?></td>
                    <td><?php echo $row['stock'] ?></td>
                    <td><?php echo $row['create_at'] ?></td>
                </tr>
                <?php } ?>
            </table>
         </div>
        <!-- table end -->
        <!-- form -->
         <div class="flex flex-col items-center bg-[#233647] w-9/10 py-8 p-2 rounded-xl border-1 border-white">
            <div class="w-9/10 space-y-4">
                <div class="flex justify-between">
                    <p class="text-white text-2xl font-semibold">Order Now</p>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                    </svg>
                </div>
                <form method="POST" class="text-white space-y-2">

                    <div class="flex flex-col space-y-1">
                        <label>Name</label>
                        <input type="text" name="username" placeholder="Please enter your name.." required class="outline-none p-2 border-1 border-white rounded-lg" >
                    </div>

                    <div class="flex flex-col space-y-1">
                        <label>Id</label>
                        <input type="text" name="pin" placeholder="Please remember your pin number" required class="outline-none p-2 border-1 border-white rounded-lg" value="<?php
                        $stmt = $conn->prepare('SELECT id as highest_id FROM request ORDER BY id DESC LIMIT 1');
                        $stmt->execute();
                        $ttl = $stmt->get_result()->fetch_assoc();
                        $high = $ttl['highest_id'] + 1;
                        echo $high;
                        ?>">
                    </div>

                    <div class="flex flex-col space-y-1">
                        <label>Phone number</label>
                        <input type="text" name="phone" placeholder="Example: 082133928185" required class="outline-none p-2 border-1 border-white rounded-lg" >
                    </div>

                    <div class="flex flex-col rounded-xl space-y-1">
                        <label class="">Buy/Order</label>
                        <select name="type" class=" outline-none rounded-lg p-2 border-1 border-white">
                            <option value="" class="text-[#004AE9]"><p class=""></p></option>
                            <option value="buy" class="text-[#004AE9]">Buy</option>
                            <option value="order" class="text-[#004AE9]">Order</option>
                        </select>
                    </div>

                    <div class="flex flex-col space-y-1">
                        <label>Order</label>
                        <input type="text" name="message" placeholder="What do you want to order.." required class="outline-none p-2 border-1 border-white rounded-lg" >
                    </div>

                    
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg font-medium hover:bg-blue-700 transition" onclick="return alert('please remember your pin')">Submit</button>
                </form>
            </div>
         </div>
        <!-- form end -->
         <!-- maps -->
          <div class="grid  bg-[#233647] p-4 space-y-4 rounded-xl w-9/10 border-1 border-white">
            <div class="grid grid-cols-10 ">
                <div class="col-span-3 space-y-4">
                    <p class="text-white font-semibold text-4xl">Rafif Computer</p>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d262.743953017128!2d110.51639741553764!3d-7.405694180933569!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a7b1ede6feb95%3A0x88d11f7567c0c349!2sRafif%20computer!5e0!3m2!1sid!2sid!4v1762510042422!5m2!1sid!2sid"  style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="rounded-xl"></iframe>
                </div>
                <div class="col-span-7 flex flex-col justify-between py-2  space-y-2 h-full"> 
                    <div class="flex justify-between">
                        <div class="flex items-center space-x-2">
                            <?php while ($admin = $rslt->fetch_assoc()) { ?>
                            <img src="<?php echo $admin['pp_path'] ?>" alt="" class="rounded-full h-10 w-10">
                            <div>
                                <p class="text-white text-xl font-medium"><?php echo $admin['name'] ?></p>
                                <p class="text-[#88ABCA] text-lg"><?php echo $admin['status'] ?></p>
                            </div>
                            <?php } ?>
                        </div>
                        <a href="https://wa.me/qr/7H5OSESBMJI6H1">
                        <button class="text-white bg-blue-600 p-2 h-full rounded-lg">
                            WhatsApp
                        </button>
                        </a>
                    </div>
                    <div>
                        <p class="text-white text-lg">At Rafif Computer, we believe every device has a story and every problem has a solution. We exist not just to repair items, but to restore your comfort and trust. With the experience and dedication of our team, we are commited to providing fast, honest, and quality service. Thank you for entrusting your device to us - your satisfaction is our top priority.</p>
                    </div>
                </div>
            </div>
          </div>
         <!-- maps end -->
    </div>
    <?php include 'components/footer.php' ?>
</body>
</html>