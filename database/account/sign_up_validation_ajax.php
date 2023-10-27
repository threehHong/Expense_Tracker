<?php
include "../../config/db_connect.php";

if (isset($_POST['signupIdInputValue'])) {
  $user_id = $_POST['signupIdInputValue'];

  $sql = "SELECT * from expense_tracker_member where id='{$user_id}'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_object();
    $response['user_id_check'] = '아이디 중복';
  } else {
  }
} else if (isset($_POST['emailInputValue'])) {
  $email_Input_value = $_POST['emailInputValue'];

  $sql = "SELECT * from expense_tracker_member where email='{$email_Input_value}'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_object();
    $response['user_email_check'] = '이메일 중복';
  } else {
    $response['user_email_check'] = '';
  }
}

echo json_encode($response);

$conn->close();
