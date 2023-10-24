<?php
include "../../config/db_connect.php";

$user_id = $_POST['signupIdInputValue'];

$sql = "SELECT * from expense_tracker_member where id='{$user_id}'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_object();
  $response['user_id_check'] = '아이디 중복';
} else {
}

echo json_encode($response);

$conn->close();
