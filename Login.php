<?php
session_start();
$servername = "localhost";
$username= "root";
$password = "";
$dbname = "a_repart";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['login'])) {
$username = $_POST['username'];
$password = $_POST['password'];
$login_query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$login_result = mysqli_query($conn, $login_query);

if (mysqli_num_rows($login_result) == 1) {
    session_unset();
    session_destroy();
    session_start();
    $_SESSION['username'] = $username;
    header("Location: index.php");
} else {
    echo "Invalid username or password.";
}
}

mysqli_close($conn);
?>



<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body{
        background-image: url(fundal.jpg);
            zoom:100%;
        }
        
    </style>
</head>
<body>
  <div class="container">
    <h2>Login</h2>
    <form method="post" action="login.php">
    <input class="textt" type="text" name="username" placeholder="Username" required>
    <input class="textt" type="password" name="password" placeholder="Password" required>
        <div class="butoane">
      <button type="submit" name="login">Log In</button>
      <a class="buton" href="index.php" role="button">Cancel</a>
        </div>
            </form>
  </div>
</body>
</html>
