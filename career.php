<?php
require_once 'config/db.php';
$stmt = $conn->prepare('SELECT * FROM career');
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-[#111A23]">
    <?php include 'components/navbar.php' ?>
    <div class="flex flex-col items-center mt-28 space-y-10">
        <div class="w-9/10 text-white space-y-4">
            <p class="font-bold text-5xl">Our Career</p>
            <p class="w-35/100 text-2xl font-semibold">At Rafif Computer, we believe that success starts with great people. We're always looking for talented, passionate individuals who are ready to grow together to create innovation and a real impact for our customers and communities.</p>
        </div>
        <div class="grid grid-cols-3 gap-4 w-9/10">
            <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="bg-[#233647] p-4 rounded-xl text-white space-y-4">
                <div class="svg" id="icon"><?php echo $row['svg'] ?></div>
                <div class="space-y-2">
                    <p class="text-3xl font-bold"><?php echo $row['title'] ?></p>
                    <p class="font-medium text-lg"><?php echo $row['subtitle'] ?></p>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php include 'components/footer.php'?>
</body>
</html>