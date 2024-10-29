<?php
include "db_connection.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $email = $_POST['username'];
        $password = $_POST['password'];

        // Server-side validation
        $email = mysqli_real_escape_string($con, $email);
        $password = mysqli_real_escape_string($con, $password);

        if (empty($email)) {
            echo "<script>alert('Please enter an username.');</script>";
        } elseif (empty($password)) {
            echo "<script>alert('Please enter a password.');</script>";
        } else {
            $str = "SELECT * FROM user WHERE email='$email' OR userName='$email'";
            $result = mysqli_query($con, $str);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                if (password_verify($password, $row['password'])) { // Compare the entered password with the hashed password
                    $_SESSION["username"] = $_POST['username'];
                    header('Location: selectExam.php');
                    exit();
                } else {
                  //  echo $password;
                   // echo "<br>";
                //    echo $row['password'];
                    echo "<script>alert('Wrong username or password.');</script>";
                }
            } else {
              //  echo $password;
            //    echo $row['password'];
                echo "<script>alert('Wrong username or password.');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
 <link rel="stylesheet" href="css/login.css">
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var toggleIcon = document.getElementById("toggle-icon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.className = "fas fa-eye-slash";
            } else {
                passwordInput.type = "password";
                toggleIcon.className = "fas fa-eye";
            }
        }
    </script>
    <link rel="stylesheet" href="https ://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <form action="" method="post" name="loginForm" onsubmit="return validateForm()">
        <h1>LOGIN</h1>
        <hr>
        <div>
            <label for="email">Username:</label>
            <input type="text" name="username" id="username">
        </div>
        <div class="password-toggle">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
            <i id="toggle-icon" class="fas fa-eye" onclick="togglePasswordVisibility()"></i>
        </div>
        <input type="submit" value="Login" name="submit">
        <p>Don't have an account? <a href="registerPage.php">Signup</a></p>
    </form>
</body>
</html>
