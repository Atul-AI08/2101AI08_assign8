<?php
session_start();

$servername = "localhost";
$username = "notroot";
$password = "mysql123";
$dbname = "dblab8";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

$query = "DELETE FROM users WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);
$conn->close();

session_destroy();

header("Location: login.html");
exit();
?>