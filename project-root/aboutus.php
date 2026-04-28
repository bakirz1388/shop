<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>درباره ما</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
     

     .about {
       width: 60%;
       margin: 40px auto;
       padding: 20px;
       background-color: #f9f9f9;
       border: 1px solid #ddd;
       animation: fadeIn 1s;
       direction:rtl;
      }
      .about:hover{
       box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }
     h1, h2 {
       color: #3e26c2;
       margin-bottom: 10px;
      }
      p{
       margin-right:40px;
      }

     .list {
       margin-bottom: 10px;
       margin-right:50px;
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
  <?php include("includes/header.php") ?>
  <div class="about">
    <h1>درباره ما </h1><br>
    <p>فروشگاه آنلاین ما با هدف ارائه محصولات با کیفیت و خدمات عالی به مشتریان عزیز فعالیت خود را آغاز کرده است.</p><br>
    <h2>ماموریت ما</h2><br>
    <p>ماموریت ما ارائه محصولات با کیفیت، خدمات عالی و رضایت مشتریان عزیز می باشد.</p><br>
    <h2>ارزش های ما</h2><br>
    <ul class="list">
      <li>کیفیت و دقت در ارائه محصولات</li>
      <li>رضایت مشتریان و پاسخگویی به نیازهای آنها</li>
      <li>همکاری و کار تیمی</li>
      <li>استفاده از تکنولوژی روز دنیا</li>
    </ul>
    <h2>اهداف ما</h2><br>
    <p>ارائه محصولات با کیفیت و خدمات عالی، افزایش رضایت مشتریان و گسترش فعالیت ها، ایجاد ارزش افزوده برای مشتریان و سهامداران</p><br>
    <h2>محصولات ما</h2><br>
    <p>ما در فروشگاه آنلاین خود، محصولات متنوعی را ارائه می دهیم.</p><br>
    <h2>چگونه با ما تماس بگیرید</h2><br>
    <p>اگر سوالی دارید یا نیاز به کمک دارید، لطفا از طریق تلفن ، ایمیل با ما در تماس باشید.</p><br>
   
  </div> 
  <?php include("includes/footer.php") ?>
</body>
</html>