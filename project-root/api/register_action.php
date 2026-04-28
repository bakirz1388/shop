<?php


$conn = new mysqli("localhost","root","","shop_db");

if($conn->connect_error){
    die("connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);

$rname = $data['realname'];
$uname = $data['username'];
$pass = $data['password'];
$email = $data['email'];
$role = $data['role'];

$ucheck = "SELECT * FROM users WHERE u_name = '$uname'";
$result = $conn->query($ucheck);

if($result->num_rows > 0){
    echo json_encode(["code" => "500"]);
    return;
}

$query = "INSERT INTO users (r_name,u_name,pass,email,role) 
VALUES ('$rname', '$uname', '$pass', '$email', '$role')";

if($conn->query($query) === TRUE) {
    echo json_encode(['code' => 400]);
} else {
    echo json_encode(['code' => 501]);
}


$conn->close();


?>