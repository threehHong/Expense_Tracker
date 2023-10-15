<?php
    include "../config/db_connect.php";

    $idx = $_POST['idx'];
    $date = $_POST['date'];
    $item = $_POST['item'];
    $amount = $_POST['amount'];

    /* echo $idx[0]."".$date[0]."".$item[0]."".$amount[0]; */

    // 숫자가 아닌 문자 제거
    $amount = preg_replace('/[^0-9]/', '', $amount);
 
    $query = "UPDATE Expense_Tracker set date='$date[0]', item='$item[0]', amount='$amount[0]' where idx='{$idx[0]}'";

    global $conn;

    if ($conn->query($query) !== TRUE) {
        echo "Error: " . $query . "<br>" . $conn->error;
    }

    echo "<script>
            location.href='../index.php'
          </script>";
?>