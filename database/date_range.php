<?php
include "../config/db_connect.php";

session_start();

if (isset($_GET['startDate'])) {
  $startDate = $_GET['startDate'];

  // 데이터가 이미 있는지 확인
  $checkQuery = "SELECT COUNT(*) as count FROM expense_tracker_date_range";
  $result = $conn->query($checkQuery);

  if ($result) {
    $row = $result->fetch_assoc();
    $count = $row['count'];

    if ($count > 0) {
      // 데이터가 있으면 업데이트
      if (isset($_SESSION['ID'])) {
        $user_id = $_SESSION['ID'];
        $query = "UPDATE expense_tracker_date_range SET start_date = '${startDate}' WHERE user_id = '${user_id}'";
      } else {
        $query = "UPDATE expense_tracker_date_range SET start_date = '${startDate}' WHERE user_id IS NULL";
      }
    } else {
      // 데이터가 없으면 삽입
      $query = "INSERT INTO expense_tracker_date_range (start_date, user_id) VALUES ('${startDate}', '${$user_id}')";
    }
  }
} else if (isset($_GET['endDate'])) {
  $endDate = $_GET['endDate'];

  // 데이터가 이미 있는지 확인
  $checkQuery = "SELECT COUNT(*) as count FROM expense_tracker_date_range WHERE idx = 1";
  $result = $conn->query($checkQuery);

  if ($result) {
    $row = $result->fetch_assoc();
    $count = $row['count'];

    if ($count > 0) {
      // 데이터가 있으면 업데이트
      if (isset($_SESSION['ID'])) {
        $user_id = $_SESSION['ID'];
        $query = "UPDATE expense_tracker_date_range SET end_date = '${endDate}' WHERE user_id = '${user_id}'";
      } else {
        $query = "UPDATE expense_tracker_date_range SET end_date = '${endDate}' WHERE user_id IS NULL";
      }
    } else {
      // 데이터가 없으면 삽입
      $query = "INSERT INTO expense_tracker_date_range (end_date, user_id) VALUES ('${endDate}' , '${$user_id}')";
    }
  }
}

global $conn;

if ($conn->query($query) !== TRUE) {
  echo "Error: " . $query . "<br>" . $conn->error;
}

echo "<script>
          location.href='../index.php'
          </script>";
