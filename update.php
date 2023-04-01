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

$user_id = $_SESSION["user_id"];
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$password = $_POST["pswd"];

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

$sql = "UPDATE users SET password='$password', fname='$first_name', lname='$last_name' WHERE user_id='$user_id'";

if ($conn->query($sql) === TRUE) {
    $conn->close();
    header("Location: dashboard.php");
    exit();
} else {
    echo "Error updating user data: " . $conn->error;
    $conn->close();
}

?>