<?php
  include "../config/db_connect.php";

  $idx = $_GET['idx'];

  $query = "DELETE from Expense_Tracker where idx='".$idx."' ";
 
  global $conn;

  if ($conn->query($query) !== TRUE) {
    echo "Error: " . $query . "<br>" . $conn->error;
  }

  // AUTO_INCREMENT 초기화
  $query_reset_auto_increment = "ALTER TABLE Expense_Tracker AUTO_INCREMENT = 1";
  $conn->query($query_reset_auto_increment);

  // idx 값 업데이트
  $query_update_idx = "SET @COUNT = 0";
  $conn->query($query_update_idx);
  $query_update_idx = "UPDATE Expense_Tracker SET idx = @COUNT:=@COUNT+1";
  $conn->query($query_update_idx);

  echo "<script>
            location.href='../index.php'
        </script>";

  $conn->close();
?>
