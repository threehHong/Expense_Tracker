<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "verifyEmail") {
	$result = requestEmailVerification("emailAdrress");

	echo json_encode($result);
}

function requestEmailVerification($user_email)
{
	require '../../config/config.php';

	$mail = new PHPMailer(true);

	// 0 비활성화, 2 화성화
	$mail->SMTPDebug = 0;

	$mail->isSMTP();

	$mail->Host = 'smtp.naver.com';

	$mail->Port = 465;

	$mail->SMTPSecure = 'ssl';

	$mail->CharSet = 'UTF-8';

	$mail->SMTPAuth = true;

	$mail->Username = $config['email_id'];

	$mail->Password = $config['email_password'];

	$mail->setFrom($config['email_id'], '운영자');

	$verificationCode = bin2hex(random_bytes(16));

	$mail->addAddress($user_email, 'null');

	$mail->Subject = '회원 가입 인증';

	$mail->Body = '이메일 인증 링크 : ' . $verificationCode;

	try {
		$mail->send();

		return $verificationCode;

		echo "이메일이 성공적으로 전송되었습니다.";
	} catch (Exception $e) {
		echo "이메일 전송 중 오류가 발생했습니다. 오류 메시지: {$mail->ErrorInfo}";
	}
}
