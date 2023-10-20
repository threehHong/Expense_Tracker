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

  <title>Sign up</title>
</head>

<body>
  <div id="wrap">
    <div class="form_wrap">
      <form action="../database/account/sign_up_validation.php" method="POST" onsubmit="onSubmitCheck(event)">
        <div class="logo">
          <a href="../index.php">
            <img src="../assets/images/logo/Logo.svg" alt="Logo">
          </a>
        </div>

        <div class="form-floating mb-3">
          <input type="id" name="id" class="form-control signup_id" id="floatingInput" placeholder="name@example.com">
          <label for="floatingInput">ID</label>
          <div class="validation_message"> validation message </div>
        </div>

        <div class="form-floating">
          <input type="password" name="password" class="form-control signup_password" id="floatingPassword" placeholder="Password">
          <label for="floatingPassword">Password</label>
          <div class="validation_message"> validation message </div>
        </div>

        <div class="form-floating">
          <input type="password" class="form-control signup_password_check" id="floatingPassword" placeholder="Password">
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
          <input type="text" class="form-control" id="floatingPassword" placeholder="Password">
          <label for="floatingPassword">인증 코드</label>
        </div>

        <div class="btn_account sign_up">
          <button type="submit" class="btn btn-primary"> 회원가입 </button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    function onSubmitCheck(e) {

      /* e.preventDefault();

      const signupIdInput = $(".signup_id").val();
      const signupPasswordInput = $(".signup_password").val();
      const signupPasswordInputCheck = $(".signup_password_check").val();

      console.log(signupIdInput, signupPasswordInput, signupPasswordInputCheck) */

      /* validateId(signinIdInput, signinPasswordInput); */

      /* 
      밑에와 같은 방식으로 리팩토링 하기.
      if (!validateForm()) e.preventDefault();
      console.log("출력 확인"); 
      */

    }

    /* function validateId(signinIdInput, signinPasswordInput) {
      $.ajax({
        type: 'post',
        url: '../database/account/sign_in_validation.php',
        data: {
          signinIdInput: signinIdInput,
          signinPasswordInput,
          signinPasswordInput
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
    } */
  </script>
</body>

</html>