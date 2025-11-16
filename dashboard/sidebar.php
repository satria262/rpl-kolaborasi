<?php 
require_once __DIR__.'/../config/db.php';
require_once __DIR__.'/../config/session.php';

if (isLoggedIn()) {
$admin_stmt = $conn->prepare('SELECT * FROM admin');
$admin_stmt->execute();
$admin_result = $admin_stmt->get_result(); 
}
?>
<aside class="flex flex-col justify-between bg-[#111A23] h-dvh p-[18px] pb-[31px] space-y-9">
    <div class="space-y-[34px]">
        <?php while ($admin = $admin_result->fetch_assoc()) { ?>
        <div class="flex items-center space-x-[14px]">
            <a href="/rpl-kolaborasi/dashboard/action/edit-profile.php?id=<?php echo $admin['id'] ?>"><img src="<?php echo $admin['pp_path'] ?>" alt="" class="rounded-full w-[45px] h-auto object-cover"></a>
            <div class="">
                <p class="text-white text-[19px] font-semibold">Hello, <?php echo $admin['name'] ?></p>
                <p class="text-[#88ABCA] font-semibold"><?php echo $admin['status'] ?></p>
            </div>
        </div>
        <?php } ?>
        <div class=" flex flex-col">
            <ul class="text-white space-y-[9px]">
                <li >
                    <a href="/rpl-kolaborasi/dashboard/product.php">
                    <button class="flex items-center w-1/1 h-[45px] p-2 pl-[16px] font-semibold space-x-4 rounded-lg focus:bg-[#233647] hover:bg-[#233647]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 0 0 2.25-2.25V6a2.25 2.25 0 0 0-2.25-2.25H6A2.25 2.25 0 0 0 3.75 6v2.25A2.25 2.25 0 0 0 6 10.5Zm0 9.75h2.25A2.25 2.25 0 0 0 10.5 18v-2.25a2.25 2.25 0 0 0-2.25-2.25H6a2.25 2.25 0 0 0-2.25 2.25V18A2.25 2.25 0 0 0 6 20.25Zm9.75-9.75H18a2.25 2.25 0 0 0 2.25-2.25V6A2.25 2.25 0 0 0 18 3.75h-2.25A2.25 2.25 0 0 0 13.5 6v2.25a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                        <p>Product</p>
                    </button>
                    </a>
                </li>
                <li >
                    <a href="/rpl-kolaborasi/dashboard/order.php">
                    <button class="flex items-center w-1/1 h-[45px] p-2 pl-[16px] font-semibold space-x-4 rounded-lg focus:bg-[#233647] hover:bg-[#233647]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>
                        <p>Order</p>
                    </button>
                    </a>
                </li>
                <li >
                    <a href="/rpl-kolaborasi/dashboard/add-product.php">
                    <button class="flex items-center w-1/1 h-[45px] p-2 pl-[16px] font-semibold space-x-4 rounded-lg focus:bg-[#233647] hover:bg-[#233647]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                        </svg>
                        <p>Add Product</p>
                    </button>
                    </a>
                </li>
                <li >
                    <a href="/rpl-kolaborasi/index.php">
                    <button class="flex items-center w-1/1 h-[45px] p-2 pl-[16px] font-semibold space-x-4 rounded-lg focus:bg-[#233647] hover:bg-[#233647]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <p>Landing Page</p>
                    </button>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <a href="/rpl-kolaborasi/dashboard/profile.php" class="bg-[#137FEC] rounded-lg h-618/10000">
    <button class="flex justify-center w-full h-full items-center ">
        <p class="text-white text-base font-bold">Profile Settings</p>
    </button>
    </a>
</aside>
