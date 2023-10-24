<?php
include "config/db_connect.php";

session_start();

// 로그인 했을 때 $_SESSION['ID']에 저장한 user ID
/* $user_id = $_SESSION['ID']; */

/* $query = "SELECT * FROM expense_tracker ORDER BY idx DESC"; */

$query = "SELECT * FROM expense_tracker WHERE date BETWEEN(SELECT start_date FROM expense_tracker_date_range WHERE idx = 1) AND (SELECT end_date FROM expense_tracker_date_range WHERE idx = 1) ORDER BY idx DESC";

$result = $conn->query($query);

$data = array();
while ($row = mysqli_fetch_array($result)) {
  $data[] = $row;
}
?>

<?php
$query = "SELECT * FROM expense_tracker_date_range";

$result = $conn->query($query);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $startDate = $row['start_date'];
  $endDate = $row['end_date'];
} else {
  // 데이터가 없는 경우 기본 값을 설정하거나 오류 처리
  $startDate = "";
  $endDate = "";
}
?>

<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- favicon -->
  <link rel="shortcut icon" href="./assets/images/logo/favicon.svg" type="image/x-icon">

  <link rel="stylesheet" href="./assets/css/common.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  <link rel="stylesheet" href="./assets/css/main.css">

  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

  <title> Expense Tracker </title>
</head>

<body>
  <div id="wrap">
    <header>
      <h1>
        <a href="index.php" class="logo">
          <img src="assets/images/logo/Logo.svg" alt="">
        </a>
      </h1>

      <nav>
        <ul>
          <li>
            <a href="./subpages/sign_in.php" class="account">
              로그인 / 회원가입
            </a>
          </li>
        </ul>
      </nav>
    </header>

    <div class="chart-container">
      <canvas id="bar-chart"></canvas>
    </div>

    <div class="date_range">
      <input type="text" class="datepicker input_date start_date" name="date[]" autocomplete="off" required>
      <span class="tilde"> ~ </span>
      <input type="text" class="datepicker input_date end_date" name="date[]" autocomplete="off" required>
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

        <p> <strong> <?php echo "총" . " " . number_format($sum) . "원 지출" ?> </strong> </p>
      </div>

      <div class="excel">
        <button class="excel_btn">
          <img src="./assets/images/button/excel.svg" alt="excel_image">
        </button>
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
              <a href="./database/delete.php?idx=<?php echo $row['idx']; ?>" class="delete_btn"> 삭제 </a>
              <a class="edit_btn"> 수정 </a>
            </td>
          </tr>
        </tbody>
      </table>

      <form action="./database/save.php" method="POST" class="input_list" onsubmit="return onSubmitCheck()">

        <div class="btn_wrap">
          <button type="submit" class="save_btn">
            <img src="./assets/images/button/save.svg" alt="save_button">
          </button>

          <img src="./assets/images/button/add.svg" class="add_btn" alt="add_button">
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

      <form action="./database/edit.php" method="POST" class="db_output" onsubmit="onSubmit()">
        <table class="table db">
          <colgroup>
            <col class="col1">
            <col class="col2">
            <col class="col3">
            <col class="col4">
          </colgroup>

          <tbody>
            <?php
            foreach ($data as $row) {
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
                  <a class="edit_btn">
                    <img src="./assets/images/button/edit.svg" alt="edit_button">
                  </a>
                  <a href="./database/delete.php?idx=<?php echo $row['idx']; ?>" class="delete_btn">
                    <img src="./assets/images/button/delete.svg" alt="delete_button">
                  </a>

                  <button type="submit" class="complete_btn hidden">
                    <img src="./assets/images/button/complete.svg" alt="complete_button">
                  </button>
                  <a class="cancel_btn hidden">
                    <img src="./assets/images/button/cancel.svg" alt="cancel_button">
                  </a>
                </td>
              </tr>
            <?php }; ?>
          </tbody>
        </table>
      </form>

    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.3.0/exceljs.min.js" integrity="sha512-UnrKxsCMN9hFk7M56t4I4ckB4N/2HHi0w/7+B/1JsXIX3DmyBcsGpT3/BsuZMZf+6mAr0vP81syWtfynHJ69JA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src='https://cdn.jsdelivr.net/npm/chart.js'></script>
  <script src="./assets/js/main.js"> </script>
  <script type='module' src="./assets/js/chart.js"> </script>
  <script type='module' src="./assets/js/excel.js"> </script>

  <script>
    let startDateFromDB = <?php echo json_encode($startDate); ?>;
    let endDateFromDB = <?php echo json_encode($endDate); ?>;

    if (startDateFromDB) {
      $(".datepicker.start_date").datepicker("setDate", startDateFromDB);
      $(".datepicker.end_date").datepicker("setDate", endDateFromDB);
    } else {
      /* let twoMonthsAgo = new Date(today);
      twoMonthsAgo.setMonth(today.getMonth() - 2);

      // 날짜를 yyyy-mm-dd 형식으로 포맷
      let formattedTwoMonthsAgo = twoMonthsAgo.getFullYear() + "-" + (twoMonthsAgo.getMonth() + 1).toString().padStart(2, '0') + "-" + twoMonthsAgo.getDate().toString().padStart(2, '0'); */

      let formattedToday = $.datepicker.formatDate("yy-mm-dd", today);

      $(".datepicker.start_date").datepicker("setDate", formattedToday);
      $(".datepicker.end_date").datepicker("setDate", formattedToday);
    }
  </script>
</body>

</html>