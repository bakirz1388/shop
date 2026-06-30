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
  <title>BakiRZ | About Us</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f5f7fc;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    main {
      direction: rtl;
      flex: 1;
      padding: 40px 20px;
    }

    .about-container {
      max-width: 1000px;
      margin: 0 auto;
      background: white;
      border-radius: 24px;
      box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.08);
      overflow: hidden;
      animation: fadeInUp 0.8s ease;
    }

    .about-header {
      background: linear-gradient(45deg, #FF6B6B, #4ECDC4);
      padding: 40px 30px;
      text-align: center;
      color: white;
    }

    .about-header h1 {
      font-size: 2.5rem;
      font-weight: 700;
    }

    .about-header p {
      font-size: 1.1rem;
      margin-top: 10px;
      opacity: 0.9;
    }

    .about-content {
      padding: 40px 35px;
    }

    .section {
      margin-bottom: 35px;
      border-bottom: 1px solid #eef2f6;
      padding-bottom: 25px;
    }

    .section:last-child {
      border-bottom: none;
      margin-bottom: 0;
      padding-bottom: 0;
    }

    .section h2 {
      color: #2c7a4d;
      font-size: 1.7rem;
      margin-bottom: 15px;
      position: relative;
      padding-right: 15px;
    }

    .section h2::before {
      content: "";
      position: absolute;
      right: 0;
      top: 8px;
      bottom: 8px;
      width: 4px;
      background: #2c7a4d;
      border-radius: 4px;
    }

    .section p {
      color: #2d3e50;
      line-height: 1.8;
      font-size: 1rem;
      margin-right: 15px;
    }

    .values-list {
      list-style: none;
      margin-right: 15px;
    }

    .values-list li {
      background: #f0f4f9;
      margin: 12px 0;
      padding: 12px 20px;
      border-radius: 60px;
      display: inline-block;
      margin-left: 12px;
      color: #1e3a2f;
      font-weight: 500;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>
<body>

<?php include("../includes/header.php") ?>

<main>
  <div class="about-container">
    <div class="about-header">
      <h1>درباره فروشگاه BakiRZ</h1>
      <p>کیفیت، سادگی و تجربه خرید قابل اعتماد</p>
    </div>

    <div class="about-content">
      <div class="section">
        <h2>داستان ما</h2>
        <p>BakiRZ با هدف ساختن یک فروشگاه ساده و قابل‌اعتماد برای خرید آنلاین شروع شد. تمرکز پروژه روی این است که فرآیند ثبت محصول، انتخاب کالا و خرید نهایی تا حد ممکن شفاف و سریع باشد.</p>
      </div>

      <div class="section">
        <h2>ماموریت</h2>
        <p>ارائه محصولات متنوع، مدیریت بهتر سفارش‌ها و ایجاد تجربه‌ای که هم برای مشتری و هم برای مدیر سایت قابل کنترل و توسعه باشد.</p>
      </div>

      <div class="section">
        <h2>ارزش‌های ما</h2>
        <ul class="values-list">
          <li>شفافیت در خرید</li>
          <li>تمرکز روی تجربه کاربر</li>
          <li>امنیت بیشتر در ورود و مدیریت</li>
          <li>قابلیت توسعه تدریجی</li>
          <li>سادگی در استفاده</li>
        </ul>
      </div>

      <div class="section">
        <h2>چشم‌انداز</h2>
        <p>این پروژه پایه‌ای برای توسعه یک فروشگاه کامل‌تر است؛ از مدیریت سفارش و گزارش‌گیری تا جستجو، فیلتر و پنل‌های حرفه‌ای‌تر.</p>
      </div>
    </div>
  </div>
</main>

<?php include("../includes/footer.php") ?>

</body>
</html>
