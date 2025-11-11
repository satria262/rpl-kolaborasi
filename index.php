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
<?php include "config/db.php"; ?>
<?php foreach($query as $baris) { ?>  
    <?php include "components/navbar.php" ?>
    <?php include "components/hero.php" ?>
    <?php include "components/sponsor.php" ?>
    <?php include "components/service.php" ?>
    <?php include "components/contact.php" ?>
    <?php include "testimonial.php" ?>
    <?php include "components/review.php" ?>
    <?php include "components/footer.php" ?>
<?php } ?>
</body>
</html>
