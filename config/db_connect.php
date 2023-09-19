<?php

$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);

if($conn -> connect_error) {
    echo "DB 연결에 실패했습니다";
    echo $conn -> connect_error;
    exit;
} 

?>