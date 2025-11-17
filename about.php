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
    <title>Rafif Computer</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-[#111A23]">
    <?php include 'components/navbar.php' ?>
    <div class="flex justify-center">
        <div class="w-9/10 mt-38 space-y-12">
            <!-- about us -->
             <div class="border-1 border-white rounded-xl space-y-8 p-8">
                <p class="w-full text-center text-[#004AE9] text-6xl font-bold">About Us</p>
                <div class="grid grid-cols-2 w-full gap-4">
                    <!-- lorem -->
                    <div class="text-white space-y-4">
                        <div class="flex items-center space-x-2 border-2 border-gray-600 w-24 rounded-full px-2 py-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />
                            </svg>
                            <p>Team</p>
                        </div>
                        <p class="text-5xl font-semibold">We are here to provide effective solutions.</p>
                        <p class="text-2xl font-medium"><span class="text-[#004AE9]">Rafif Computer </span>started with a desire to help people find easier, more efficient, adn more reliable solutions. To this days we continue to grow to provide services that truly provide value and positive impact to our users.</p>
                        <a href="form.php">
                        <div class="flex items-center justify-between border-2 border-gray-600 w-34 rounded-full px-2 py-1 text-[#004AE9] font-medium">
                            <p>We're Here!</p>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                              <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                        </div>
                        </a>
                    </div>
                    <!-- img -->
                    <div class="">
                        <img src="./logos/background.jpg" alt="" class=" rounded-xl">
                    </div>
                </div>
                <div class="w-full text-center text-[#004AE9] text-3xl font-medium">
                    <p>Owner Solikin, and Rafif team</p>
                </div>
             </div>
            <!-- about us end -->
             <div class="w-full flex flex-col items-center space-y-4">
                <div class="flex flex-col items-center pb-4">
                    <img src="./logos/logo-saka.png" alt=""  class="size-20">
                    <p class="text-4xl text-center text-white font-semibold">We don’t just talk — we prove it.
                    The numbers below reflect our journey and the trust our clients place in us.
                    Here’s what we’ve accomplished so far.</p>
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