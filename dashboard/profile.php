<?php 
require_once '../config/db.php';
require_once '../config/session.php';
if (isLoggedIn()) {
$stmt = $conn->prepare('SELECT * FROM admin');
$stmt->execute();
$result = $stmt->get_result();
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
        <?php while ($row = $result->fetch_assoc()) { ?>
        <?php include '../dashboard/sidebar.php' ?>
        <div class="col-span-4 p-4">
            <div class="text-white space-y-8">
                <p class="text-4xl font-medium">Edit Profile</p>
                <div class="rounded-xl border-1 border-white p-4 space-y-4">
                    <div class="flex space-x-4">
                        <img src="<?php echo $row['pp_path'] ?>" alt="" class="size-30">
                        <div class="flex justify-between w-full items-center">
                            <div class="flex flex-col justify-start h-full py-2 max-w-65/100">
                                <p class="text-3xl text-[#88ABCA]"><?php echo $row['status'] ?></p>
                                <p class="text-2xl border-b-1 border-b-white pb-1"><?php echo $row['name'] ?></p>
                                <p class="text-2xl"><?php echo $row['email'] ?></p>
                            </div>
                            <div class="rounded-full p-2 border-1 border-white">
                                <a href="/rpl-kolaborasi/dashboard/action/edit-profile.php?id=<?php echo $row['id'] ?>" class="flex items-center space-x-2">
                                    <p>Edit</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="p-2 rounded-lg">
                        <p></p>
                        <p><?php echo $row['bio'] ?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</body>
</html>