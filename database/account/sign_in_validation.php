<?php
include "../../config/db_connect.php";

session_start();

$user_id = $_POST['signinIdInput'];
$user_pw = $_POST['signinPasswordInput'];
$user_pw = hash('sha512', $user_pw);

$sql = "SELECT * from expense_tracker_member where id='{$user_id}' and password='{$user_pw}'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_object();
  $response['signin_message'] = '로그인 성공';
  $_SESSION['ID'] = $row->id;
} else {
  $response['signin_message'] = '아이디 또는 비밀번호를 확인해주세요';
}

echo json_encode($response);

$conn->close();
