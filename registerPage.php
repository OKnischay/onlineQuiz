<?php
include "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $userName = $_POST['userName'];

        // Server-side validation
        if (empty($email) || empty($password) || empty($userName)) {
            echo "<script>alert('All fields are required.');</script>";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Invalid email format.');</script>";
        } elseif (strlen($password) < 6) {
            echo "<script>alert('Password must be at least 6 characters long.');</script>";
        } elseif ($_POST['password'] !== $_POST['rePassword']) {
            echo "<script>alert('Passwords do not match.');</script>";
        } else {
            $email = mysqli_real_escape_string($con, $email);
            $userName = mysqli_real_escape_string($con, $userName);
            $hashedPassword = crypt($password, PASSWORD_DEFAULT); // Hash the password
            
            $checkQuery = "SELECT email FROM user WHERE email = '$email'";
            $checkResult = mysqli_query($con, $checkQuery);

            if (mysqli_num_rows($checkResult) > 0) {
                echo "<script>alert('Sorry.. This email is already registered.');</script>";
            } else {
                $insertQuery = "INSERT INTO user (email, password, userName) VALUES ('$email', '$hashedPassword', '$userName')";
                if (mysqli_query($con, $insertQuery)) {
                    echo "<script>alert('Congrats.. You have successfully registered!');</script>";
                    header('Location: index.php');
                    exit();
                } else {
                    echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/register.css">
   
</head>
<body>
    <form name="register" action="" method="post" onsubmit="return validateForm()">
        <h1>REGISTER</h1>
        <hr>
        <div>
            <label for="email">Email:</label>
            <input type="text" name="email" id="email">
        </div>
        <div>
            <label for="userName">Username:</label>
            <input type="text" name="userName" id="userName">
        </div>
        <div class="password-toggle">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
            <i id="toggle-password" class="fas fa-eye" onclick="togglePasswordVisibility('password')"></i>
        </div>
        <div class="password-toggle">
            <label for="rePassword">Confirm Password:</label>
            <input type="password" name="rePassword" id="rePassword">
            <i id="toggle-repassword" class="fas fa-eye" onclick="togglePasswordVisibility('rePassword')"></i>
        </div>
        <input type="submit" name="submit" value="Register">
        <p>Already have an account? <a href="login.php">Sign in</a></p>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script>
        function togglePasswordVisibility(inputId) {
            var passwordInput = document.getElementById(inputId);
            var toggleIcon = document.getElementById("toggle-" + inputId);

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }
    </script>
</body>
</html>
