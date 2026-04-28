<?php

$conn = new mysqli("localhost","root","","shop_db");

if($conn->connect_error){
    die("connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);

$uname = $data['username'];
$pass = $data['password'];

$query = "SELECT * FROM users WHERE u_name='$uname' AND pass='$pass'";

$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);

if($row) {
    loginSuccess($row);
} else {
    echo json_encode(['code' => 502]);
}

function loginSuccess($res) {
    session_start();
    $_SESSION['user_id'] = $res['user_id'];
    $_SESSION['r_name'] = $res['r_name'];
    $_SESSION['u_name'] = $res['u_name'];

    echo json_encode(['code' => 401]);
}

$conn->close();

?>