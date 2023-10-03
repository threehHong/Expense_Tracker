<?php
  include "config/db_connect.php";

  $query = "SELECT * FROM Expense_Tracker ORDER BY idx DESC";

  $result = $conn->query($query);

  $data = array();
  while ($row = mysqli_fetch_array($result)) {
      $data[] = $row;
  }
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="css/common.css">
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

        <link rel="stylesheet" href="css/main.css">

        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

        <title> Expense Tracker </title>
    </head>


    <body>
        <div id="wrap">
          <div class="chart-container">
            <canvas id="bar-chart"></canvas>
          </div>

          <div class="board">
            <div class="expenditure">
              <?php

                $sum = 0;
                
                foreach ($data as $row) {
                  if ($row['amount']) {
                      $sum += $row['amount'];
                  }
                } 
              ?>
              
              <p> <strong> <?php echo "총"." ".number_format($sum)."원 지출" ?> </strong> </p>
            </div>

            <table class="table input_table">
              <colgroup>
                <col class="col1">
                <col class="col2">
                <col class="col3">
                <col class="col4">
              </colgroup>
              
              <thead>
                <tr>
                  <th scope="col"> No </th>
                  <th scope="col"> 날짜 </th>
                  <th scope="col"> 항목 </th>
                  <th scope="col"> 금액 </th>
                  <th scope="col"> </th>
                </tr>
              </thead>
              
              <tbody>
                <tr class="input_group">
                  <td>
                    -
                  </td>
  
                  <td>
                    <input type="text" class="datepicker input_date" name="date[]" autocomplete="off" required>
                  </td>
                  
                  <td>
                    <input type="text" class="item" name="item[]" autocomplete="off" required>
                  </td>
  
                  <td>
                    <input type="text" class="amount" name="amount[]" autocomplete="off" required>
                  </td>

                  <td class="btn_edit"> 
                    <a href="./db/delete.php?idx=<?php echo $row['idx']; ?>" class="delete_btn common_btn"> 삭제 </a>
                    <a href="" class="edit_btn common_btn"> 수정 </a>
                  </td>
                </tr>
              </tbody>
            </table>
  
            <form action="./db/save.php" method="POST" class="input_list" onsubmit="onSubmit()">
  
              <div class="btn_wrap">
                <input type="button" class="add_btn common_btn" value="추가">
                <button type="submit" class="save_btn common_btn"> 저장 </button>
              </div>
  
              <table class="table">
                <colgroup>
                  <col class="col1">
                  <col class="col2">
                  <col class="col3">
                  <col class="col4">
                </colgroup>
  
                <tbody>
                  <!-- 입력 데이터 위치 -->
                </tbody>
              </table>
            </form>

            <form action="./db/edit.php" method="POST" class="" onsubmit="onSubmit()">
              <table class="table db">
                <colgroup>
                  <col class="col1">
                  <col class="col2">
                  <col class="col3">
                  <col class="col4">
                </colgroup>
  
                <tbody>
                  <?php
                    foreach($data as $row) {
                  ?>
                    <tr class="db_row">
                      <th scope="row" class="idx">
                        <input type="number" name="idx[]" value="<?php echo $row['idx']; ?>" disabled> 
                      </th>
                      <td> 
                        <input type="text" class="datepicker" name="date[]" value="<?php echo $row['date']; ?>" disabled> 
                      </td>
                      <td class="db_item"> 
                        <input type="text" class="item" name="item[]" value="<?php echo $row['item']; ?>" autocomplete="off" disabled>
                      </td>
                      <td class="db_amount"> 
                        <input type="text" class="amount" name="amount[]" value="<?php echo number_format($row['amount']); ?>" autocomplete="off" disabled>
                      </td>
                      <td class="btn_edit"> 
                        <a href="./db/delete.php?idx=<?php echo $row['idx']; ?>" class="delete_btn common_btn"> 삭제 </a>
                        <a class="edit_btn common_btn"> 수정 </a>
                        
                        <a class="cancel_btn common_btn hidden"> 취소 </a>
                        <button type="submit" class="complete_btn common_btn hidden"> 완료 </button>
                      </td>
                    </tr>
                  <?php }; ?>
                </tbody>
              </table>
            </form>

          </div>
        </div>

        <script src='https://cdn.jsdelivr.net/npm/chart.js'></script>
        <script src="js/main.js"> </script>
        <script src="js/chart.js"> </script>
    </body>
</html>
