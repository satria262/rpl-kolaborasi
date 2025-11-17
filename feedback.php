<?php
require_once 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['username'];
    $rating = $_POST['rating'];
    $job = $_POST['job'];
    $message = $_POST['message'];

    $stmt = $conn->prepare('INSERT INTO feedback (username, occupation, feedback, rating) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('ssss', $name, $job, $message, $rating);
    if ($stmt->execute()) {
        // echo 'berhasil';
        header('Location: index.php');
        $name = $rating = $job = $message = '';
    } else {
        echo 'gagal';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-[#111A23]">
    <div class="grid grid-cols-5">
    <div class="col-span-1">
    <?php include 'dashboard/sidebar.php' ?>
    </div>
    <div class="flex justify-center items-center pt-10  col-span-4">
        <div class="grid grid-cols-2 grid-rows-5 gap-6 w-8/10">
            <div class="row-span-3 rounded-xl bg-[#233647]">
                <img src="./logos/client.png" alt="" class="rounded-xl w-auto h-full object-auto ">
            </div>
            <div class="row-span-5 bg-[#233647] flex flex-col space-y-8 p-4 rounded-xl border-1 border-white">
                <div>
                    <p class="text-white font-semibold text-4xl">Get in touch</p>
                    <p class="text-[#88ABCA] text-lg font-semibold">Our friendly team would love to hear from you.</p>
                </div>
                <form method="POST" class="flex flex-col h-full justify-between">
                    <div class="space-y-2">
                        <div class="flex flex-col space-y-1">
                            <label class="text-[#88ABCA] font-semibold text-lg">Your name</label>
                            <input type="text" name="username" placeholder="Please enter your name..." class="outline-none w-full border-1 border-white rounded-lg p-2 text-white   ">
                        </div>

                        <div class="flex flex-col space-y-1">
                            <label class="text-[#88ABCA] font-semibold text-lg">Rating</label>
                            <select name="rating" class="outline-none w-full border-1 border-white rounded-lg p-2 text-white    ">
                                <option value="⭐⭐⭐⭐⭐">⭐⭐⭐⭐⭐</option>
                                <option value="⭐⭐⭐⭐">⭐⭐⭐⭐</option>
                                <option value="⭐⭐⭐">⭐⭐⭐</option>
                                <option value="⭐⭐">⭐⭐</option>
                                <option value="⭐">⭐</option>
                            </select>
                        </div>

                        <div class="flex flex-col space-y-1">
                            <label class="text-[#88ABCA] font-semibold text-lg">Your job</label>
                            <input type="text" name="job" placeholder="Please enter your job..." class="outline-none w-full border-1 border-white rounded-lg p-2 text-white ">
                        </div>

                        <div class="flex flex-col space-y-1">
                            <label class="text-[#88ABCA] font-semibold text-lg">Message</label>
                            <input type="text" name="message" placeholder="Leave us a message..." class="outline-none w-full border-1 border-white rounded-lg p-2 text-white    ">
                        </div>
                    </div>
                    <button type="submit" class="w-full rounded-lg  bg-[#1447E6] text-white p-2 text-xl font-semibold">Send message</button>
                </form>
            </div>
            <div class="flex flex-col bg-[#233647] justify-between row-span-2 rounded-xl border-1 border-white p-4">
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-11 bg-[#233647] rounded-full p-2 text-white" >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H6.911a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661Z" />
                    </svg>
                    <div>
                        <p class="text-[#88ABCA] text-lg font-semibold">Email</p>
                        <p class="text-white font-semibold">rafifcomp@gmail.com</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-11 bg-[#233647] rounded-full p-2 text-white" >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H6.911a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661Z" />
                    </svg>
                    <div>
                        <p class="text-[#88ABCA] text-lg font-semibold">Phone</p>
                        <p class="text-white font-semibold">0856-4063-2694</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-11 bg-[#233647] rounded-full p-2 text-white" >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H6.911a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661Z" />
                    </svg>
                    <div>
                        <p class="text-[#88ABCA] text-lg font-semibold">Office</p>
                        <p class="text-white font-semibold">Jl. Klero-Suruh No.18, Klerokrajan, Semarang</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
</html>