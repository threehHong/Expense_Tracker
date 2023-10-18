<?php
  include "../config/db_connect.php";
  
  if(isset($_POST['datepicker']) && isset($_POST['item']) && isset($_POST['amount'])) {
    $dates = $_POST['datepicker'];
    $items = $_POST['item'];
    $amounts = $_POST['amount'];

    for($i = count($dates) - 1; $i >= 0; $i--) {
      $date = $dates[$i];
      $item = $items[$i];
      $amount = $amounts[$i];

      // 숫자가 아닌 문자 제거
      $amount = preg_replace('/[^0-9]/', '', $amount);

      /* echo $date." ".$item." ".$amount. "<br>"; */

      $query = "INSERT INTO expense_tracker (date, item, amount) VALUES ('$date', '$item', '$amount')";
      
      global $conn;
      
      if ($conn->query($query) !== TRUE) {
          echo "Error: " . $query . "<br>" . $conn->error;
      }

      echo "<script>
              location.href='../index.php'
            </script>";
    }
  } else {
    echo "데이터가 제대로 전송되지 않았습니다.";
  }

?>