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
      <h1>Welcome <?php echo $fname; ?> <?php echo $lname; ?> </h2>
        <p>Email:
          <?php echo $email; ?>
        </p>
        <form method="post" action="logout.php">
          <input type="submit" value="Sign Out">
        </form>
        <form method="get" action="edit.php">
          <input type="submit" value="Edit Profile">
        </form>
        <form method="post" action="delete.php" onsubmit="return confirm('Are you sure you want to delete account');">
          <input type="submit" value="Delete Account">
        </form>
    </div>
  </div>
</body>

</html>