<?php
    include "../config/db_connect.php";

    if(isset($_GET['startDate'])) {
        $startDate = $_GET['startDate'];
    
        // 데이터가 이미 있는지 확인
        $checkQuery = "SELECT COUNT(*) as count FROM expense_tracker_date_range WHERE idx = 1";
        $result = $conn->query($checkQuery);
    
        if ($result) {
            $row = $result->fetch_assoc();
            $count = $row['count'];
    
            if ($count > 0) {
                // 데이터가 있으면 업데이트
                $query = "UPDATE expense_tracker_date_range SET start_date = '${startDate}' WHERE idx = 1";
            } else {
                // 데이터가 없으면 삽입
                $query = "INSERT INTO expense_tracker_date_range (idx, start_date) VALUES (1, '${startDate}')";
            }
        }
    } else if(isset($_GET['endDate'])) {
        $endDate = $_GET['endDate'];
    
        // 데이터가 이미 있는지 확인
        $checkQuery = "SELECT COUNT(*) as count FROM expense_tracker_date_range WHERE idx = 1";
        $result = $conn->query($checkQuery);
    
        if ($result) {
            $row = $result->fetch_assoc();
            $count = $row['count'];
    
            if ($count > 0) {
                // 데이터가 있으면 업데이트
                $query = "UPDATE expense_tracker_date_range SET end_date = '${endDate}' WHERE idx = 1";
            } else {
                // 데이터가 없으면 삽입
                $query = "INSERT INTO expense_tracker_date_range (idx, end_date) VALUES (1, '${endDate}')";
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
?>