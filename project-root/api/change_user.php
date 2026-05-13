<?php
session_start();

$userID = $_SESSION['user_id'];
$userID2 = $_SESSION['u_name'];

$conn = new mysqli("localhost","root","","shop_db");

if($conn->connect_error){
    die("connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);

$rname = $data['realname'];
$uname = $data['username'];
$email = $data['email'];
$pass = $data['password'];

$oldPass = "SELECT * FROM users WHERE user_id = $userID";
$oldPassRes = mysqli_query($conn,$oldPass);
$oldPassRow = mysqli_fetch_array($oldPassRes);


if ($userID2 != $uname) {
    $ucheck = "SELECT * FROM users WHERE u_name = '$uname'";
    $result = $conn->query($ucheck);

    if($result->num_rows > 0){
        echo json_encode(["code" => "508"]);
        return;
    }
}

if ($pass == "") {
    $pass = $oldPassRow['pass'];
}

$query = "UPDATE users 
    SET r_name = '$rname', 
        u_name = '$uname',
        email = '$email',
        pass = '$pass'
    WHERE user_id = $userID";

    if($conn->query($query) === TRUE) {
        echo json_encode(['code' => 400]);
    } else {
        echo json_encode(['code' => 501]);
    }


$conn->close();


?>