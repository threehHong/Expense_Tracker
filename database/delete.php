<?php
  include "../config/db_connect.php";

  $idx = $_GET['idx'];

  $query = "DELETE from expense_tracker where idx='".$idx."' ";
 
  global $conn;

  if ($conn->query($query) !== TRUE) {
    echo "Error: " . $query . "<br>" . $conn->error;
  }

  // AUTO_INCREMENT 초기화
  $query_reset_auto_increment = "ALTER TABLE expense_tracker AUTO_INCREMENT = 1";
  $conn->query($query_reset_auto_increment);

  // idx 값 업데이트
  $query_update_idx = "SET @COUNT = 0";
  $conn->query($query_update_idx);
  $query_update_idx = "UPDATE expense_tracker SET idx = @COUNT:=@COUNT+1";
  $conn->query($query_update_idx);

  echo "<script>
            location.href='../index.php'
        </script>";

  $conn->close();
