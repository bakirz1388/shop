<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/store.php';

$sessionUser = requireLogin();
$row = fetchUserById($sessionUser['user_id']);
?>

<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BakiRZ | User Panel</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="icon" href="../assets/images/logoBakiRZ.png">
</head>
<body>
<?php include("../includes/header.php"); ?>


<main>
    <div class="form-area">
              <div class="form-title">ویرایش اطلاعات کاربری</div>
              <div id="profileForm">
                  <div class="double-group">
                      <div class="input-group">
                          <label>نام و نام خانوادگی</label>
                          <input type="text" id="name-panel" placeholder="نام کامل" value="<?= h($row['r_name']) ?>">
                      </div>
                      <div class="input-group">
                          <label>نام کاربری</label>
                          <input type="text" id="uname-panel" placeholder="نام کاربری" value="<?= h($row['u_name']) ?>">
                      </div>
                  </div>
                  <div class="input-group">
                      <label>ایمیل</label>
                      <input type="email" id="email-panel" placeholder="ایمیل" value="<?= h($row['email']) ?>">
                  </div>
                  <div class="input-group">
                      <label>رمز عبور جدید (اختیاری)</label>
                      <input type="password" id="pass-panel" placeholder="در صورت تمایل رمز جدید وارد کنید">
                  </div>
                  <div class="double-group">
                    <button class="btn-save">ذخیره تغییرات</button>
                    <span class="error-msg"></span>
                  </div>
              </div>
    </div>

</main>
  <?php include("../includes/footer.php"); ?>

<script src="../assets/js/jquery.main.js"></script>
<script src="../assets/js/main.js"></script>

</body>
</html>
