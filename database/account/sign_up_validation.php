<?php
include "../../config/db_connect.php";

$user_id = $_POST['id'];
$user_pw = $_POST['password'];

echo $user_id, $user_pw;

$sql = "INSERT INTO expense_tracker_member (id, password) VALUES ('{$user_id}', '{$user_pw}')";

if ($conn->query($sql) === true) {

  echo "<script> 
          alert('회원가입이 완료되었습니다');  
          location.href = '../../subpages/sign_in.php'; 
        </script>";
} else {
  echo "<script>
          alert('회원가입 실패');
          location.href = '../../subpages/sign_in.php'; 
        </script>";
}

$conn->close();
