<?php
require_once '../config/db.php';
require_once '../config/session.php';
if (isLoggedIn()) {
    $stmt = $conn->prepare('SELECT * FROM admin ORDER BY id DESC LIMIT 1');
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
    <title>Dashboard - Admin Management Page</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="../style.css">
</head>
<body class="bg-[#111A23] flex justify-center">
    <?php include '../components/navbar.php' ?>
    <!-- <img src="../logos/background.jpg" alt="" class="relative blur h-screen w-screen object-cover"> -->
    <div class="hidden md:block absolute h-66 w-238 bg-transparent top-18"></div> 
    <div class="flex flex-col items-center w-40 group overflow-visible whitespace-nowrap overscroll-auto mt-18" id="dashboard">
        <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="flex flex-col items-center space-y-4 mt-20 transition-all duration-500 text-xl md:text-4xl group-hover:opacity-0">
            <p class="text-white font-thin hidden md:block">Welcome to <span class="text-white font-semibold bg-[#233467] rounded-lg px-2 py-[6px]">Dashboard</span> Information and Management Page</p>
            <p class="text-white  font-thin">Hello, <span class="text-[#88ABCA] font-medium"><?php echo $row['name'] ?></span></p>
            <p class=" bg-[#233467] px-2 py-[6px] rounded-lg text-white font-medium">Rafif Computer</p>
        </div> 
        <?php } ?>
        <div class="absolute top-1/2 transform -translate-y-1/2 mt-16">
            <div class="relative">
                <!-- button utama -->
                <button class="size-50 relative bg-[#233467] rounded-full shadow-md transition-all duration-500 group-hover:scale-130 group-hover:ring-white group-hover:ring-2 group-hover:translate-y-30 z-100">
                    <img src="../logos/logo-saka.png" alt="" class="pt-1 animate-pulse group-hover:animate-none">
                </button>

                <!-- 3 button child -->
                 <div class="absolute text-lg font-medium inset-0 flex justify-center items-center transition-all group-hover:translate-x-28 opacity-0 rounded-full ring-2 ring-white text-white bg-[#233467] group-hover:-translate-y-28 group-hover:opacity-100 duration-500 scale-50 md:scale-76 z-40">
                    <a href="../dashboard/profile.php" class="flex flex-col justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-26 text-white">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>    
                    <p>Profile</p>
                    </a>
                 </div>

                 <div class="absolute text-lg font-medium inset-0 flex justify-center items-center transition-all translate-y-0 opacity-0 rounded-full ring-2 ring-white text-white bg-[#233467] group-hover:translate-x-52 group-hover:opacity-100 duration-500 scale-50 md:scale-80 z-50">
                    <a href="../dashboard/order.php" class="flex flex-col justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-26 text-white">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 3.03v.568c0 .334.148.65.405.864l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 0 1-1.161.886l-.143.048a1.107 1.107 0 0 0-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 0 1-1.652.928l-.679-.906a1.125 1.125 0 0 0-1.906.172L4.5 15.75l-.612.153M12.75 3.031a9 9 0 0 0-8.862 12.872M12.75 3.031a9 9 0 0 1 6.69 14.036m0 0-.177-.529A2.25 2.25 0 0 0 17.128 15H16.5l-.324-.324a1.453 1.453 0 0 0-2.328.377l-.036.073a1.586 1.586 0 0 1-.982.816l-.99.282c-.55.157-.894.702-.8 1.267l.073.438c.08.474.49.821.97.821.846 0 1.598.542 1.865 1.345l.215.643m5.276-3.67a9.012 9.012 0 0 1-5.276 3.67m0 0a9 9 0 0 1-10.275-4.835M15.75 9c0 .896-.393 1.7-1.016 2.25" />
                        </svg>
                        <p>Check Orders</p>
                    </a>
                 </div>

                 <div class="absolute text-lg font-medium inset-0 flex justify-center items-center transition-all translate-y-0 opacity-0 rounded-full ring-2 ring-white text-white bg-[#233467] group-hover:-translate-x-52 group-hover:opacity-100 duration-500 scale-50 md:scale-80">
                    <a href="../dashboard/product.php" class="flex flex-col justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-26 text-white">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                        </svg>
                        <p>Product</p>
                    </a>
                 </div>

                 <div class="absolute text-lg font-medium inset-0 flex justify-center items-center transition-all group-hover:-translate-y-28 opacity-0 rounded-full ring-2 ring-white text-white bg-[#233467] group-hover:-translate-x-28 group-hover:opacity-100 duration-500 scale-50 md:scale-76">
                    <a href="../dashboard/add-product.php" class="flex flex-col justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-26 text-white">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <p>Add Product</p>
                    </a>
                 </div>

                 <div class="absolute text-lg font-medium inset-0 flex justify-center items-center transition-all group-hover:-translate-y-40 opacity-0 rounded-full ring-2 ring-white text-white bg-[#233467] group-hover:translate-x-0 group-hover:opacity-100 duration-500 scale-50 md:scale-76 z-30">
                    <a href="../feedback.php" class="flex flex-col justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-26 text-white">
                          <path stroke-linecap="round" stroke-linejoin="round" d="m7.875 14.25 1.214 1.942a2.25 2.25 0 0 0 1.908 1.058h2.006c.776 0 1.497-.4 1.908-1.058l1.214-1.942M2.41 9h4.636a2.25 2.25 0 0 1 1.872 1.002l.164.246a2.25 2.25 0 0 0 1.872 1.002h2.092a2.25 2.25 0 0 0 1.872-1.002l.164-.246A2.25 2.25 0 0 1 16.954 9h4.636M2.41 9a2.25 2.25 0 0 0-.16.832V12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 12V9.832c0-.287-.055-.57-.16-.832M2.41 9a2.25 2.25 0 0 1 .382-.632l3.285-3.832a2.25 2.25 0 0 1 1.708-.786h8.43c.657 0 1.281.287 1.709.786l3.284 3.832c.163.19.291.404.382.632M4.5 20.25h15A2.25 2.25 0 0 0 21.75 18v-2.625c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125V18a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                        <p>Feedback</p>
                    </a>
                 </div>
            </div>
        </div> 
    </div>
</body>
</html>