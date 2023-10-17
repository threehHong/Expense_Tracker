<?php
  include "../config/db_connect.php";
?>

<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- favicon -->
    <link rel="shortcut icon" href="../assets/images/logo/favicon.svg" type="image/x-icon">

    <link rel="stylesheet" href="./assets/css/common.css">

    <link rel="stylesheet" href="../assets/css/account.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <title>Sign in</title>
  </head>
  <body>
    <div id="wrap">
      <div class="form_wrap">
        <form action="">
          <div class="logo">
            <a href="../index.php">
              <img src="../assets/images/logo/Logo.svg" alt="Logo">
            </a>
          </div>

          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">ID</label>
          </div>
          <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
          </div>

          <div class="btn_sign_up_path">
            <a href="sign_up.php"> 회원가입 </a>
          </div>

          <div class="validation_result">
            <p>
              유효성 검사 결과 표시
            </p>
          </div>

          <div class="btn_account sign_in">
            <button type="submit" class="btn btn-primary"> 로그인 </button>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>