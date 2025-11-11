<?php  

$stmt = $conn->prepare('SELECT * FROM feedback ORDER BY id DESC LIMIT 6');
$stmt->execute();
$result = $stmt->get_result();
?>
<div class="space-y-8 py-8">
    <div class="flex flex-col items-center space-y-4">
        <p class="text-3xl text-white font-semibold">Testimonial</p>
        <p class="text-4xl text-white font-semibold">What our happy users says!</p>
    </div>
    <div class="flex justify-evenly gap-5 w-screen  overflow-auto px-10">
        <!-- first card -->
    <?php while ($row = $result->fetch_assoc()) { ?>
         <div class="min-w-80 p-4 text-xl font-semibold flex flex-col justify-between rounded-lg border-2 border-[#233647] space-y-4">
            <p class="text-sky-800">Rate:<?php echo $row['rating']?></p>
            <div class="text-white h-full flex flex-col justify-between space-y-4">
                <p class="whitespace-normal"><?php echo $row['feedback']?></p>
                <div class="flex items-center border-t border-t-1 border-t-[#233647] space-x-4 pt-2">
                    <img src="images\user.png" alt="lorem" class="w-10 h-10 rounded-full">
                    <div class="text-lg -space-y-2">
                        <p><?php echo $row['username']?></p>
                        <p class="text-base font-light text-[#88ABCA]"><?php echo $row['occupation']?></p>
                    </div>
                </div> 
            </div>
         </div>
        <?php } ?>
        <!-- first card end -->
    </div>
</div>