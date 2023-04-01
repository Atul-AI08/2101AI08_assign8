<?php
session_start();
if (!isset($_SESSION["user_id"])) {
  header("Location: login.html");
  exit();
}
$servername = "localhost";
$username = "notroot";
$password = "mysql123";
$dbname = "dblab8";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$user_id = $_SESSION["user_id"];
$sql = "SELECT * FROM users WHERE user_id='$user_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$fname = $row["fname"];
$lname = $row["lname"];
$email = $row["email"];
?>

<html>

<head>
  <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>
  <div class="container" onclick="onclick">
    <div class="top"></div>
    <div class="bottom"></div>
    <div class="center">
      <form method="post" action="update.php">
        <input type="text" placeholder=<?php echo $fname ?> name="first_name" required>
        <input type="text" placeholder=<?php echo $lname ?> name="last_name" required>
        <input type="password" placeholder="Password" name="pswd" required>
        <input type="submit" value="Save Changes">
      </form>
    </div>
  </div>
</body>

</html>