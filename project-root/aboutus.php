<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="icon" href="assets/images/logoBakiRZ.png">
  <title>BakiRZ | درباره ما</title>
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

    /* محتوای اصلی */
    main {
      direction: rtl;
      flex: 1;
      padding: 40px 20px;
    }

    /* باکس درباره ما */
    .about-container {
      max-width: 1000px;
      margin: 0 auto;
      background: white;
      border-radius: 24px;
      box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.08);
      overflow: hidden;
      transition: all 0.3s ease;
      animation: fadeInUp 0.8s ease;
    }

    /* هدر سبز داخل باکس */
    .about-header {
      background: linear-gradient(135deg, #2c7a4d, #1e5a3a);
      padding: 40px 30px;
      text-align: center;
      color: white;
    }

    .about-header h1 {
      font-size: 2.5rem;
      margin: 0;
      font-weight: 700;
      letter-spacing: -0.5px;
    }

    .about-header p {
      font-size: 1.1rem;
      margin-top: 10px;
      opacity: 0.9;
    }

    /* محتوای داخلی */
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
      transition: 0.2s;
    }

    .values-list li:hover {
      background: #2c7a4d;
      color: white;
      transform: translateY(-3px);
    }

    /* انیمیشن */
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

    /* واکنش‌گرا */
    @media (max-width: 768px) {
      .about-content {
        padding: 25px 20px;
      }
      .about-header h1 {
        font-size: 1.9rem;
      }
      .section h2 {
        font-size: 1.4rem;
      }
      .values-list li {
        display: block;
        text-align: center;
        margin: 10px 0;
      }
    }
  </style>
</head>
<body>

<?php include("includes/header.php") ?>

<main>
  <div class="about-container">
    <div class="about-header">
      <h1>✨ درباره فروشگاه BakIRZ</h1>
      <p>کیفیت، اعتماد، تجربه مدرن خرید آنلاین</p>
    </div>

    <div class="about-content">
      <div class="section">
        <h2>داستان ما</h2>
        <p>فروشگاه آنلاین <strong>BakIRZ</strong> با هدف ارائه محصولات باکیفیت، قیمت منصفانه و تجربه خریدی لذت‌بخش شروع به کار کرد. ما به مشتری‌ها نه به عنوان یک تراکنش، بلکه به عنوان همراه همیشگی نگاه می‌کنیم.</p>
      </div>

      <div class="section">
        <h2>🎯 ماموریت</h2>
        <p>ارائه محصولات اصل، ارسال سریع و پشتیبانی حرفه‌ای در ۷ روز هفته. مأموریت ما ساختن اعتماد و لبخند رضایت روی صورت شماست.</p>
      </div>

      <div class="section">
        <h2>💎 ارزش‌های ما</h2>
        <ul class="values-list">
          <li>کیفیت بی‌چون‌وچرا</li>
          <li>رضایت مشتری اولویت اول</li>
          <li>کار تیمی و شفافیت</li>
          <li>استفاده از تکنولوژی روز</li>
          <li>احترام به زمان شما</li>
        </ul>
      </div>

      <div class="section">
        <h2>🏆 اهداف ما</h2>
        <p>افزایش رضایت مشتری، گسترش فروشگاه در سطح کشوری و ایجاد تجربه خریدی هوشمند و بدون استرس برای همه کاربران ایرانی.</p>
      </div>

      <div class="section">
        <h2>📦 محصولات ما</h2>
        <p>از دیجیتال گرفته تا پوشاک و سبک زندگی، همه محصولات با ضمانت بازگشت وجه و گارانتی اصالت کالا ارائه می‌شوند.</p>
      </div>

      <div class="section">
        <h2>📞 ارتباط با ما</h2>
        <p>📧 ایمیل: <strong>info@shopfun.com</strong><br>
        📞 تلفن پشتیبانی: <strong>۰۹۱۲۳۴۵۶۷۸۹</strong><br>
        🕰 ساعات پاسخگویی: ۹ صبح تا ۸ شب ( حتی تعطیلات )</p>
      </div>
    </div>
  </div>
</main>

<?php include("includes/footer.php") ?>

</body>
</html>