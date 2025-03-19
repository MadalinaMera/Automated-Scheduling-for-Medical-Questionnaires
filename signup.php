<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "a_repart";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $check_query = "SELECT * FROM users WHERE email='$email'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "Username exista deja. Incearca un alt username.";
    } else {
        $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";

        if (mysqli_query($conn, $sql)) {
            echo "Contul a fost creat cu succes!";
            header('location:login.php');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Sign Up</title>
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
    <h2>Create an Account</h2>
    <form method="post" action="signup.php">
      <input class="textt" type="text" name="username" placeholder="Username" required>
      <input class="textt" type="password" name="password" placeholder="Password" required>
      <input class="textt" type="email" name="email" placeholder="Email" required>
      <div class="butoane">
      <button type="submit" name="signup">Sign Up</button>
          
      <a class="buton" href="index.php" role="button">Cancel</a>
        </div>
    </form>
  </div>
</body>
</html>
