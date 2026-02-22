<?
if (isset($_POST['username']) && !empty($_POST['username']) &&
    isset($_POST['password']) && !empty($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
}else {
    exit ("برخی از فلید ها مقدار دهی نشده است");
}

$link = mysqli_connect("localhost","root","","shop_db");
if (mysqli_connect_errno()) {
    exit("خطای با شرح زیر رخ داده است". mysqli_connect_errno());
}

$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($link,$query);
$row = mysqli_fetch_array($result);

if ($row) {
    echo("<p style='color:green;'><b>{$row['realname']}به فروشگاه خوش آمدید</b></p>");
}else {
    echo("<p style='color:red;'><b>نام کاربری یا رمز عبور یافت نشد</b></p>");
}

mysqli_close($link);
?>