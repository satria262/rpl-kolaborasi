<?php
require_once 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['username'];
    $status = $_POST['status'];
    $product = $_POST['product'];

    $stmt = $conn->prepare("INSERT INTO request (name, status, product) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $status, $product);
    if ($stmt->execute()) {
        echo 'berhasil';
    }

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
    <?php include 'components/navbar.php' ?>
    <div class="flex flex-col items-center space-y-12 mt-20">
        <!-- table -->
         <div class="bg-[#233647] w-8/10 rounded-xl p-4 space-y-2">
            <div class="space-y-1">
                <p class="text-white text-4xl font-semibold">Our Products</p>
                <p class="text-[#1243BD] text-3xl font-semibold">0</p>
            </div>
            <table class="w-full border-b-1 border-b-white h-12">
                <tr class="text-[#88ABC1]">
                    <th class="text-start">Name</th>
                    <th class="text-start">Price</th>
                    <th class="text-start">Stock</th>
                    <th class="text-start">Update</th>
                </tr>
            </table>
         </div>
        <!-- table end -->
        <!-- form -->
         <div class="flex flex-col items-center bg-[#233647] w-8/10 py-8 p-2 rounded-xl">
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

                    <div class="flex flex-col rounded-xl space-y-1">
                        <label class="">Buy/Order</label>
                        <select name="status" class=" outline-none rounded-lg p-2 border-1 border-white">
                            <option value="" class="text-[#004AE9]"><p class=""></p></option>
                            <option value="buy" class="text-[#004AE9]">Buy</option>
                            <option value="order" class="text-[#004AE9]">Order</option>
                        </select>
                    </div>

                    <div class="flex flex-col space-y-1">
                        <label>Product</label>
                        <input type="text" name="product" placeholder="Select the product" required class="outline-none p-2 border-1 border-white rounded-lg" >
                    </div>

                    
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg font-medium hover:bg-blue-700 transition">Submit</button>
                </form>
            </div>
         </div>
        <!-- form end -->
         <!-- maps -->
          <div class="grid w-8/10 bg-[#233647] p-4 space-y-4 rounded-xl">
            <p class="text-white font-semibold text-4xl">Rafif Computer</p>
            <div class="grid grid-cols-10">
                <div class="col-span-3">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d262.743953017128!2d110.51639741553764!3d-7.405694180933569!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a7b1ede6feb95%3A0x88d11f7567c0c349!2sRafif%20computer!5e0!3m2!1sid!2sid!4v1762510042422!5m2!1sid!2sid"  style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="rounded-xl"></iframe>
                </div>
                <div class="col-span-7 space-y-2"> 
                    <div class="flex justify-between border-t-1 border-t-white pt-4">
                        <div class="flex items-center space-x-2">
                            <img src="./images/service(1).png" alt="" class="rounded-full h-10 w-10">
                            <div>
                                <p class="text-white">Solikin</p>
                                <p class="text-[#88ABCA]">Teknisi</p>
                            </div>
                        </div>
                        <button class="text-white bg-blue-600 p-2 rounded-lg">
                            WhatsApp
                        </button>
                    </div>
                    <div>
                        <p class="text-white">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Adipisci accusamus officia ab quisquam illo, enim autem perferendis voluptate porro mollitia hic quia labore ut assumenda? Velit doloremque molestiae, nesciunt neque omnis eius quas.</p>
                    </div>
                </div>
            </div>
          </div>
         <!-- maps end -->
    </div>
</body>
</html>