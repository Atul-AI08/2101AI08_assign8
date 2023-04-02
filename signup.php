<?php
$servername = "localhost";
$username = "notroot";
$password = "mysql123";
$dbname = "dblab8";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$user_id = uniqid();
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$email = $_POST["email"];
$password = $_POST["pswd"];
$cnf_pswd = $_POST["cnfpswd"];

if (!preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)){
  echo "Error: Invalid email";
}

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  echo "Error: Email already exists";
  exit();
}

if (strlen($password) < 8) {
  echo "Error: Password must be at least 8 characters long";
  exit();
} elseif (!preg_match("#[0-9]+#", $password)) {
  echo "Error: Password must contain at least one number";
  exit();
} elseif (!preg_match("#[a-zA-Z]+#", $password)) {
  echo "Error: Password must contain at least one letter";
  exit();
}

if ($password != $cnf_pswd) {
  echo "Error: Password and Confirm Password are not same";
  exit();
}

$sql = "INSERT INTO users VALUES ('$user_id', '$first_name', '$last_name', '$email', '$password')";
if ($conn->query($sql) === TRUE) {
  echo "Account created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: login.html");
exit();
?>