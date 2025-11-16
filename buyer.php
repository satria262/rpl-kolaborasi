<?php
$error ='';
$class = '';
error_reporting(0);
require_once 'config/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $pin = $_POST['pin'];

    $stmt = $conn->prepare('SELECT * FROM request WHERE name = ? AND id = ?');
    $stmt->bind_param("si", $name, $pin);
    $stmt->execute();
    $result = $stmt->get_result() ?? 0;
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
    <div class="flex flex-col items-center items-center space-y-4">
        <div class="w-4/10 border-1 border-white rounded-lg p-4 mt-38 text-white space-y-6">
            <div>
                <p class="text-xl">Check your order status</p>
            </div>
            <form method="POST" class="text-white space-y-4">
                <div class="flex flex-col space-y-1">
                <label class="-mb-2 bg-[#111A23] z-10 ml-2 w-135/1000">Your name</label>
                <input type="text" name="name" placeholder="enter ur name" class="border-1 border-white rounded-lg p-2 outline-none">
                </div>
                <div class="flex flex-col space-y-1">
                <label class="-mb-2 bg-[#111A23] z-10 ml-2 w-93/1000">Your id</label>
                <input type="text" name="pin" placeholder="enter ur id" class="border-1 border-white rounded-lg p-2 outline-none">
                </div>
                <div class="flex justify-center">
                    <button type="submit" class="bg-[#004AE9] w-full text-xl font-medium rounded-lg h-10">Check</button>
                </div>
            </form>
        </div>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="border-1 border-white p-4 w-4/10 rounded-lg text-white space-y-4 text-center">
            <p class="text-2xl"><?php echo $row['name']."'s order:" ?></p>
            <p class="text-xl"><?php echo $row['message'] ?></p>
            <p class="text-xl"><?php echo "Create at ".$row['create_at'] ?></p>
            <p class="text-xl"><?php echo "Phone Number: ".$row['phone'] ?></p>
            <div class="border-t-1 border-t-white pb-2">
                <div class="flex space-x-1 text-xl">
                    <p class="">Status:</p>
                    <?php
                    if ($row['status'] == 'Has been read') {
                        $class = 'text-green-600 font-medium';
                    } elseif($row['status'] == 'Has been confirmed') {
                        $class = 'text-green-600 font-medium';                        
                    } else {
                        $class = 'text-red-500 font-medium';
                    }
                    ?>
                    <p class="<?php echo $class ?>"><?php echo$row['status'] ?></p>
                </div>
                <div class="flex space-x-1 text-xl">
                    <p>Admin Replied:</p>
                    <p><?php echo $row['DETAIL'] ?></p>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

</body>
</html>