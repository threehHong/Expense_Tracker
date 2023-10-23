<?php

require 'config.php';

$servername = "localhost";
$username = $config['db_username_dev'];
$password = $config['db_password_dev'];
$database = $config['db_database_dev'];

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
  echo "DB 연결에 실패했습니다";
  echo $conn->connect_error;
  exit;
}
