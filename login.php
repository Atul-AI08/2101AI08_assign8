<?php
$servername = "localhost";
$username = "notroot";
$password = "mysql123";
$dbname = "dblab8";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$email = $_POST["email"];
$password = $_POST["pswd"];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
  echo "Error: Email does not exist";
  exit();
}

$row = $result->fetch_assoc();
$user_password = $row["password"];
if ($password != $user_password) {
  echo "Error: Invalid password";
  exit();
}

session_start();
$_SESSION["user_id"] = $row["user_id"];

header("Location: dashboard.php");
$conn->close();
exit();
?>