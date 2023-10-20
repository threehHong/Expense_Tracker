<?php
include "../../config/db_connect.php";

$user_id = $_POST['signinIdInput'];
$user_pw = $_POST['signinPasswordInput'];

$sql = "SELECT * from expense_tracker_member where id='{$user_id}' and password='{$user_pw}'";
$result = $conn->query($sql);
$result = $result->fetch_object();

if (!$result) {
  $response['signin_message'] = '아이디 또는 비밀번호를 확인해주세요';
} else if ($result) {
  $response['a'] = "1";
  /* echo $result;
  $_SESSION['ID'] = $result->user_id;
  $response['signin_message'] = '로그인 성공';
  echo
  "<script>
     location.href = '../../index.php';
    </script>"; */
  exit;
}

echo json_encode($response);

$conn->close();
