<?php
require_once 'config/db.php';
$stmt = $conn->prepare('SELECT * FROM about_card');
$stmt->execute();
$result = $stmt->get_result();
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
    <div class="flex justify-center">
        <div class="w-8/10 mt-20 space-y-12">
            <!-- about us -->
            <div class="flex flex-col items-center rounded-xl border-1 border-gray-600 p-4 space-y-4">
                <p class="text-[#004AE9] text-4xl font-semibold">About Us</p>
                <div class="flex w-full justify-evenly">
                    <!-- promise -->
                     <?php while ($row = $result->fetch_assoc()) { ?>
                    <div class="border-2 border-[#004AE9] rounded-lg p-2 w-3/10 space-y-4 pb-12">
                        <p class="text-[#004AE9] text-xl font-semibold text-center"><?php echo $row['title'] ?></p>
                        <p class="text-lg text-white text-center"><?php echo $row['description'] ?></p>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <!-- about us end -->
             <div class="w-full flex flex-col items-center space-y-4">
                <div class="flex flex-col items-center pb-4">
                    <img src="./logos/logo-saka.png" alt=""  class="size-20">
                    <p class="text-4xl text-center text-white font-semibold">Lorem Ipsum is simply dummy text of the printing and industry. has been the industry's.</p>
                </div>
                <div class="w-full flex justify-between relative mb-40">
                    <!-- age -->
                    <div class="flex flex-col items-center">
                        <p class="text-[#004AE9] text-4xl font-semibold ">9+</p>
                        <p class="text-white text-3xl">Years Experience</p>
                    </div>
                    <!-- trust -->
                    <div class="flex flex-col items-center absolute w-full justify-center">
                        <p class="text-[#004AE9] text-4xl font-semibold">
                            <?php 
                            $total = $conn->prepare('SELECT COUNT(*) - 1 as total_request FROM request');
                            $total->execute();
                            $ttl = $total->get_result()->fetch_assoc();
                            echo $ttl['total_request'].'+   ';
                            ?>
                        </p>
                        <p class="text-white text-3xl">Users Trust</p>
                    </div>
                    <!-- feedback -->
                     <div class="flex flex-col items-center">
                        <p class="text-[#004AE9] text-4xl font-semibold">
                            <?php
                            $total = $conn->prepare('SELECT COUNT(*) - 1 as total_feedback FROM feedback');  
                            $total->execute();
                            $ttl = $total->get_result()->fetch_assoc();
                            echo $ttl['total_feedback'].'+';
                            ?>
                        </p>
                        <p class="text-white text-3xl">Feedback</p>
                     </div>
                </div>
             </div>
        </div>
    </div>
    <?php include 'components/footer.php' ?>
</body>
</html>