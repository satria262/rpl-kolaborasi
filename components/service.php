<?php  
$stmt = $conn->prepare('SELECT * FROM services');
$stmt->execute();
$result = $stmt->get_result();
?>
<div class="flex flex-col justify-center items-center p-5 space-y-10">
    <div class="flex flex-col justify-center items-center text-black font-bold space-y-4">
        <p class="text-[#126BD9] text-8xl font-semibold"><?php echo $baris['card_title'] ?></p>
        <p class="text-[#126BD9]">We are a team of professionals commited to providing the best service to meet your needs.</p>
    </div>
    <div class="grid grid-cols-3 gap-6">
        <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="flex flex-col-reverse bg-[#233647] rounded-2xl border-[1px] border-[#233647]">
            <div class=" bg-[#233647] rounded-b-2xl p-4 -mt-10">
                <p class="text-white"><?php echo $row['title'] ?></p>
                <p class="text-[#3A3838]"></p>
                <div class="flex justify-between items-center">
                    <p class="text-white"><?php echo $row['subtitle'] ?></p>
                    <a href="/rpl-kolaborasi/form.php">
                        <button class="bg-[#1A5CEB] p-2 text-white rounded-lg text-sm">Order</button>
                    </a>
                </div>
            </div>
            <img src="<?php echo $row['image_path'] ?>" alt="" class="">
        </div>
        <?php } ?>
    </div>
</div>