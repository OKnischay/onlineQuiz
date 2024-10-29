<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: index.php");
    exit;
}

include 'E:\xampp\htdocs\onlineQuiz\db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <style>
        * {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
}

.navbar {
            background-color: #333;
            color: #fff;
            padding: 10px;
        }

        .navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        .navbar li {
            float: left;
        }

        .navbar li a {
            display: block;
            color: #fff;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navbar li a:hover {
            background-color: #555;
        }

        .container {
  margin-top: 50px;
  text-align: center;
}

.container h1 {
  margin-bottom: 20px;
}

.container table {
  width: 80%;
  margin: 0 auto;
  border-collapse: collapse;
}

.container th,
.container td {
  padding: 8px;
  border: 1px solid #ddd;
  text-align: center;
}

.container th {
  background-color: #4caf50;
  color: white;
}

.container tr:nth-child(even) {
  background-color: #f2f2f2;
}
    </style>
</head>
<body>

<div class="navbar">
        <ul>
        <li><a href="dashboard.php">Home</a></li>
                 <li><a href="insertCategory.php">Category </a></li>
            <li><a href="selectCategory.php">Question</a></li>
            <li><a href="viewUser.php">User List</a></li>
            <li><a href="oldResult.php">History</a>  </li>
            <li><a href="logout.php">Logout</a>  </li>
        </ul>
    </div>
 
    
    <div class="container">
    <h1 align="center">User List</h1>
    
    <?php
    $res = mysqli_query($con, "SELECT * FROM user ORDER BY userId");
    
    if ($res) {
        $count = mysqli_num_rows($res);

        if ($count == 0) {
            echo "<p align='center'>No users found.</p>";
        } else {
            echo "<table>";
            echo "<tr>";
            echo "<th>Username</th>";
            echo "<th>Email</th>";
            echo "<th>Password</th>";
            echo "</tr>";

            while ($row = mysqli_fetch_array($res)) {
                echo "<tr>";
                echo "<td>" . $row["userName"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["password"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        }
    } else {
        echo "<p align='center'>Query error: " . mysqli_error($con) . "</p>";
    }
    ?>
</div>

</body>
</html>
