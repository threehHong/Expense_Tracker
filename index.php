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
                /* $query = "SELECT * FROM Expense_Tracker";

                $result = $conn->query($query); */

                $sum = 0;
                
                /* while($row = mysqli_fetch_array($result)) {
                  if($row['amount']) {
                    $sum += $row['amount'];
                  }
                } */
                foreach ($data as $row) {
                  if ($row['amount']) {
                      $sum += $row['amount'];
                  }
                } 
              ?>
              
              <p> <strong> <?php echo "총"." ".number_format($sum)."원 지출" ?> </strong> </p>
            </div>
  
            <div class="add_button">
              <input type="button" value="추가">
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
                </tr>
              </thead>
              
              <tbody>
                <tr class="input_group">
                  <td>
                    -
                  </td>
  
                  <td>
                    <input type="text" id="datepicker" class="datepicker" name="date[]" autocomplete="off" required>
                  </td>
                  
                  <td>
                    <input type="text" class="item" name="item[]" autocomplete="off" required>
                  </td>
  
                  <td>
                    <input type="text" class="amount" name="amount[]" autocomplete="off" required>
                  </td>
                </tr>
              </tbody>
            </table>
  
            <form action="./db/save.php" method="POST" class="input_list" onsubmit="onSubmit()">
  
              <div class="submit_btn_wrap">
                <button type="submit" class="submit_btn"> 저장 </button>
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

            <table class="table db">
                <colgroup>
                  <col class="col1">
                  <col class="col2">
                  <col class="col3">
                  <col class="col4">
                </colgroup>
  
                <tbody class="a">
                  <?php
                    /* $result = $conn->query($query);

                    while($row = mysqli_fetch_array($result)) {  */

                    // 배열 뒤집기.
                    /* $reverseData = array_reverse($data); */

                    foreach($data as $row) {
                  ?>
                    <tr> 
                      <th scope="row" class="idx"> <?php echo $row['idx']; ?> </th>
                      <td> <?php echo $row['date']; ?> </td>
                      <td> <?php echo $row['item']; ?> </td>
                      <td> <?php echo number_format($row['amount']); ?> </td>
                    </tr>
                  <?php }; ?>
                </tbody>
              </table>
          </div>
        </div>

        <script src='https://cdn.jsdelivr.net/npm/chart.js'></script>
        <script src="js/main.js"> </script>
        <script src="js/chart.js"> </script>
    </body>
</html>
