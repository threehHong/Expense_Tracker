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

  <link rel="stylesheet" href="../assets/css/common.css">

  <link rel="stylesheet" href="../assets/css/account.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <title>Sign in</title>
</head>

<body>
  <div id="wrap">
    <div class="form_wrap">
      <form action="login.php" onsubmit="onSubmitCheck(event)">
        <div class="logo">
          <a href="../index.php">
            <img src="../assets/images/logo/Logo.svg" alt="Logo">
          </a>
        </div>

        <div class="form-floating mb-3">
          <input type="id" class="form-control signin_id" id="floatingInput" placeholder="name@example.com">
          <label for="floatingInput">ID</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control signin_password" id="floatingPassword" placeholder="Password">
          <label for="floatingPassword">Password</label>
        </div>

        <div class="btn_sign_up_path">
          <a href="sign_up.php"> 회원가입 </a>
        </div>

        <div class="validation_result">
          <p> </p>
        </div>

        <div class="btn_account sign_in">
          <button type="submit" class="btn btn-primary"> 로그인 </button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    function onSubmitCheck(e) {

      e.preventDefault();

      const signinIdInput = $(".signin_id").val();
      const signinPasswordInput = $(".signin_password").val();

      console.log(signinIdInput, signinPasswordInput)

      validateId(signinIdInput, signinPasswordInput);

      /* 
      밑에와 같은 방식으로 리팩토링 하기.
      if (!validateForm()) e.preventDefault();
      console.log("출력 확인"); 
      */

    }

    function validateId(signinIdInput, signinPasswordInput) {
      $.ajax({
        type: 'post',
        url: '../database/account/sign_in_validation.php',
        data: {
          signinIdInput: signinIdInput,
          signinPasswordInput: signinPasswordInput
        },
        dataType: 'json',
        error: function() {
          console.log('error');
        },
        success: function(response) {

          console.log(response);

          if (response.signin_message === "로그인 성공") {
            location.href = '../index.php';
          } else {
            $(".validation_result p").html(response.signin_message);
          }

        }
      })
    }
  </script>
</body>

</html>