<?php
include "../../config/db_connect.php";

$user_id = $_POST['id'];
$user_pw = $_POST['password'];
$user_email = $_POST['email'];
$user_pw = hash('sha512', $user_pw);

$sql = "INSERT INTO expense_tracker_member (id, password, email) VALUES ('{$user_id}', '{$user_pw}', '{$user_email}')";

/* if (strlen($user_id) > 0) { */
if ($conn->query($sql) === true) {
  echo "<script> 
            location.href = '../../index.php'; 
          </script>";
} else {
  echo "<script>
            alert('회원가입 실패');
            location.href = '../../subpages/sign_up.php';
          </script>";
}
/* } */

$conn->close();
