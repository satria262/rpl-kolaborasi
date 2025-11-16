<?php 
require_once  __DIR__.'/../../config/db.php';
require_once  __DIR__.'/../../config/session.php';

if (isLoggedIn()) {
    $error = '';
    $id = $_GET['id'];

    $statement = $conn->prepare('SELECT password FROM admin WHERE id = ?');
    $statement->bind_param("i", $id);
    $statement->execute();
    $password_result = $statement->get_result();
    $admin = $password_result->fetch_assoc();

    $stmt = $conn->prepare('SELECT * FROM admin');
    $stmt->execute();
    $admin_result = $stmt->get_result(); 

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $new_status = $_POST['status'];
        $new_name = $_POST['name'];
        $new_email = $_POST['email'];
        $new_bio = $_POST['bio'];
        $old_password = $_POST['old'];
        $new_password = $_POST['new'];
        $confirm_password = $_POST['confirm'];

        if (empty($old_password) || empty($new_password) || empty($confirm_password)) {
            $stmt = $conn->prepare('UPDATE admin SET status = ?, name = ?, email = ?, bio = ? WHERE id = ? ');
            $stmt->bind_param("sssss", $new_status, $new_name, $new_email, $new_bio, $id);

                if ($stmt->execute()) {
                header('location: /rpl-kolaborasi/dashboard/profile.php');
                $new_status || $new_name || $new_email || $new_bio  = '';
            }
        } else {
            // $statement = $conn->prepare('SELECT password FROM admin WHERE id = ?');
            // $statement->bind_param("i", $id);
            // $statement->execute();
            // $password_result = $statement->get_result();
            // $admin = $password_result->fetch_assoc();

            if ($new_password !== $confirm_password) {
                $error = 'Try Again';
            } elseif ( !password_verify($old_password, $admin['password'])) {
                    $error = 'Wrong Password';
            } else {  
                    // hash pw
                    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

                    $stmt = $conn->prepare('UPDATE admin SET status = ?, name = ?, email = ?, password = ?, bio = ? WHERE id = ? ');
                    $stmt->bind_param("ssssss", $new_status, $new_name, $new_email, $hashed_password, $new_bio, $id);  
                    if ($stmt->execute()) {
                        $msg = 'success update password';
                    header('location: /rpl-kolaborasi/dashboard/profile.php');
                    // $new_status || $new_name || $new_email || $new_password || $new_bio  = '';
                }
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
        <?php while ($row = $admin_result->fetch_assoc()) { ?>
        <?php include __DIR__.'/../sidebar.php' ?>
        <div class="col-span-4 p-4">
            <div class="text-white space-y-8">
                <p class="text-4xl font-medium">Edit Profile</p>
                <form method="POST">
                    <div class="rounded-xl border-1 border-white p-4 space-y-4">
                        <div class="flex space-x-4">
                            <img src="<?php echo $row['pp_path'] ?>" alt="" class="size-30">
                            <div class="flex justify-between items-center w-full">
                                <div class="flex flex-col justify-start h-full py-2 max-w-65/100">
                                    <p class="text-3xl text-[#88ABCA]"><input type="text" name="status" value="<?php echo $row['status'] ?>" class="w-full outline-none hover:animate-pulse focus:animate-pulse"></p>
                                    <p class="text-2xl border-b-1 border-b-white pb-1"><input type="text" name="name" value="<?php echo $row['name'] ?>" class="w-full outline-none hover:animate-pulse focus:animate-pulse"></p>
                                    <p class="text-2xl"><input type="email" name="email" value="<?php echo $row['email'] ?>" class="w-full outline-none"></p>
                                </div>
                            </div>
                            <button type="submit" class="text-xl font-medium bg-[#137FEC] p-2 rounded-lg h-full" onclick="return confirm('You sure you want to update your profile?')">Update Profile</button>
                        </div>
                        <p class="text-xl"><input type="text" name="bio" value="<?php echo $row['bio'] ?>" class="w-8/10 outline-none"></p>
                        <div class="space-y-2">
                            <p class="text-2xl font-medium">Set New Pasword</p>
                            <p class="text-lg font-medium">Create a password with at least 8 characters.</p>
                            <p class="text-yellow-500 rounded-sm"><?php if (isset($error)) { echo $error; }?></p>
                        </div>
                        <div>
                            <div class="flex flex-col">
                                <label class="-mb-2 ml-4 z-10 bg-[#111A23] py-[1px] px-[3px] w-26">Old Password</label>
                                <input type="password" name="old" placeholder="Type your old password here" class="bg-[#111A23] outline-none rounded-lg border-1 border-white p-2">
                            </div>

                            <div class="flex flex-col">
                                <label class="-mb-2 ml-4 z-10 bg-[#111A23] py-[1px] px-[3px] w-28 whitespace-nowrap">New Password</label>
                                <input type="password" name="new" placeholder="Type your new password here" class="bg-[#111A23] outline-none rounded-lg border-1 border-white p-2">
                            </div>

                            <div class="flex flex-col">
                                <label class="-mb-2 ml-4 z-10 bg-[#111A23] py-[1px] px-[3px] w-34 whitespace-nowrap">Confirm Password</label>
                                <input type="password" name="confirm" placeholder="Confirm your new password here" class="bg-[#111A23] outline-none rounded-lg border-1 border-white p-2">
                            </div>
                        </div>
                        <!-- <button type="submit" class="text-xl font-medium bg-[#137FEC] p-2 rounded-lg h-16" onclick="return confirm('You sure you want to update your profile?')">Update Profile</button> -->
                    </div>
                </form>
            </div>
        </div>
        <?php } ?>
    </div>
</body>
</html>