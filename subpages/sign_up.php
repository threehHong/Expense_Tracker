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
          <input type="id" name="id" class="form-control signup_id" id="signup_id" placeholder="ID">
          <label for="signup_id">ID</label>
          <div class="validation_message"></div>
        </div>

        <div class="form-floating">
          <input type="password" name="password" class="form-control signup_password" id="signup_password" placeholder="Password">
          <label for="signup_password">Password</label>
          <div class="validation_message"></div>
        </div>

        <div class="form-floating">
          <input type="password" class="form-control signup_password_check" id="signup_password_check" placeholder="Password">
          <label for="signup_password_check">Password Check</label>
          <div class="validation_message"></div>
        </div>

        <div class="form-floating email">
          <input type="email" class="form-control signup_email" id="floatingEmail" placeholder="Password">
          <label for="floatingEmail">Email</label>
          <button class="btn btn-outline-secondary signup_email_verify_btn" type="button">인증</button>
          <div class="validation_message"></div>
        </div>

        <div class="form-floating verification_code">
          <input type="text" class="form-control" id="floatingPassword" placeholder="Password">
          <label for="floatingPassword">인증 코드</label>
          <div class="validation_message"></div>
        </div>

        <div class="btn_account sign_up">
          <button type="submit" class="btn btn-primary" disabled> 회원가입 </button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    const signupIdInput = $(".signup_id");
    const signupPasswordInput = $(".signup_password");
    const signupPasswordInputCheck = $(".signup_password_check");
    const emailInput = $(".signup_email");
    const emailVerifyBtn = $(".signup_email_verify_btn");
    const emailVerificationCode = $(".verification_code");
    const emailVerificationCodeInput = $(".verification_code input");

    const idRegEx = /^[a-zA-Z0-9]{6,}$/
    const passwordRegEx = /^.{6,}$/;
    const emailRegEx = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    let isIdValid = false;
    let isPasswordValid = false;
    let isPasswordCheckValid = false;
    let isEmailValid = false;
    let isVerificationCodeValid = false;

    signupIdInput.on("input", function() {
      if (!idRegEx.test($(this).val())) {
        $(this).siblings('.validation_message').text('6자 이상 문자나 숫자를 입력하세요');
      } else {
        $(this).siblings('.validation_message').text('');
        isIdValid = true;
        checkAllValid()
      }
    });

    signupIdInput.on("input", function() {
      let signupIdInputValue = $(this).val();

      $.ajax({
        type: 'post',
        url: '../database/account/sign_up_validation.php',
        data: {
          signupIdInputValue: signupIdInputValue,
        },
        dataType: 'json',
        error: function() {
          console.log('error');
        },
        success: function(response) {
          if (response.user_id_check) {
            signupIdInput.siblings('.validation_message').text('중복된 아이디 입니다.');
          } else {
            /* signupIdInput.siblings('.validation_message').text(''); */
            isIdValid = true;
            checkAllValid()
          }
        }
      });
    });

    signupPasswordInput.on("input", function() {
      if (!passwordRegEx.test($(this).val())) {
        $(this).siblings('.validation_message').text('6자 이상 입력하세요');
      } else {
        $(this).siblings('.validation_message').text('');
        isPasswordValid = true;
        checkAllValid()
      }
    });

    signupPasswordInputCheck.on("input", function() {
      if (signupPasswordInput.val() !== $(this).val()) {
        $(this).siblings('.validation_message').text('비밀번호 불일치');
      } else {
        $(this).siblings('.validation_message').text('');
        isPasswordCheckValid = true;
        checkAllValid()
      }
    });

    emailInput.on("input", function() {
      if (!emailRegEx.test($(this).val())) {
        $(this).siblings('.validation_message').text('이메일 형식 불일치');
      } else {
        $(this).siblings('.validation_message').text('');
        isEmailValid = true;
        checkAllValid()
      }
    });

    emailVerifyBtn.on("click", function() {
      if (!emailInput.val()) {
        emailInput.siblings('.validation_message').text('이메일을 입력하세요');
      } else if (emailRegEx.test(emailInput.val())) {
        console.log("출력 확인")
        /* emailVerifyBtn.prop("disabled", true); */
        emailVerificationCode.css({
          "display": "block",
          "opacity": "1",
          "transition": "1s",
        });
        isEmailValid = true;
        checkAllValid()
      }
    })

    emailVerificationCodeInput.on("input", function() {
      if (emailVerificationCodeInput.val()) {
        isVerificationCodeValid = true;
        checkAllValid()
      }
    })

    function checkAllValid() {
      if (isIdValid && isPasswordValid && isPasswordCheckValid && isEmailValid && isVerificationCodeValid) {
        $(".sign_up .btn").removeAttr("disabled");
        $(".sign_up .btn").css({
          "opacity": "1",
          "transition": "1s",
        });
      }
    }


    function onSubmitCheck(e) {

      e.preventDefault();

      console.log(signupIdInput, signupPasswordInput, signupPasswordInputCheck)


      /* validateId(signinIdInput, signinPasswordInput); */

      /* 
      밑에와 같은 방식으로 리팩토링 하기.
      if (!validateForm()) e.preventDefault();
      console.log("출력 확인"); 
      */

    }
  </script>
</body>

</html>