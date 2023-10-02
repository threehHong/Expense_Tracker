<?php
  include "../config/db_connect.php";

  $idx = $_GET['idx'];

  $query = "DELETE from Expense_Tracker where idx='".$idx."' ";
 
  global $conn;

  if ($conn->query($query) !== TRUE) {
    echo "Error: " . $query . "<br>" . $conn->error;
  }

  echo "<script>
            location.href='../index.php'
        </script>";

  /* $conn->close(); */
?>
