<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" href="../assets/images/logoBakiRZ.png">
    <title>BakiRZ | Contact Us</title>
    <style>
        body {
         font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
         background-color: #f0f0f0;
        }

        .call {
            margin: 40px 25% 0 25%;
            direction: rtl;
            max-width: 60%;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            animation: fadeIn 1s;
        }

        .call:hover{
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .contact{
            display: block;
            margin-bottom: 10px;
            padding: 10px;
            font-weight:bold;
            background-color: #f1f1f1;
            color: #000;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }

        .contact:hover {
            background-color: #d6d6d6;
        }

        @keyframes fadeIn {
         from {
          opacity: 0;
          transform: translateY(20px);
         }
         to {
          opacity: 1;
          transform: translateY(0);
         }
        }
    </style>
</head>
<body>

<?php include('../includes/header.php'); ?>

<main>
    <center>
        <div class="call">
            <h1>تماس با ما</h1><br>
            <h3>اگر سوالی دارید یا نیاز به کمک دارید از راه‌های زیر با ما در ارتباط باشید.</h3><br>
            <a href="tel:09123456789" class="contact">تماس با ما: 09123456789</a>
            <a href="https://wa.me/989123456789" target="_blank" class="contact">ارتباط در واتساپ</a>
            <a href="mailto:info@bakirz.local" class="contact">ارتباط از طریق ایمیل</a>
        </div>
    </center>
</main>

<?php include('../includes/footer.php'); ?>

</body>
</html>
