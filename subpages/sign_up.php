<?php
  include "../config/db_connect.php";
?>

<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./assets/css/common.css">

    <link rel="stylesheet" href="../assets/css/account.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <title>Sign up</title>
  </head>
  <body>
    <div id="wrap">
      <div class="form_wrap">
        <form action="">
          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">ID</label>
            <div class="validation_message"> validation message </div>
          </div>

          <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
            <div class="validation_message"> validation message </div>
          </div>

          <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password Check</label>
            <div class="validation_message"> validation message </div>
          </div>

          <div class="form-floating email">
            <input type="email" class="form-control" id="floatingEmail" placeholder="Password">
            <label for="floatingEmail">Email</label>
            <button class="btn btn-outline-secondary" type="button">인증</button>
            <div class="validation_message"> validation message </div>
          </div>

          <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">인증 코드</label>
          </div>

          <div class="account">
            <button type="submit" class="btn btn-primary"> 회원가입 </button>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>