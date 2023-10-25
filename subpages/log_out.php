<?php
session_start();

session_destroy();

if (session_status() === PHP_SESSION_NONE) {
  echo "<script> 
          location.href = '../index.php';  
        </script>";
} else {
  echo '로그아웃 실패';
}
