<?php

session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: index.php");
    exit;
}

    include 'E:\xampp\htdocs\onlineQuiz\db_connection.php';

    // Get the total number of users
    $userQuery = "SELECT COUNT(*) AS totalUsers FROM user";
    $userResult = mysqli_query($con, $userQuery);
    
    if ($userResult) {
        $userData = mysqli_fetch_assoc($userResult);
        $totalUsers = $userData['totalUsers'];
    } else {
        echo "Error retrieving total number of users: " . mysqli_error($con);
        $totalUsers = 0; // Set default value if an error occurs
    }

    // Get the total number of categories
    $categoryQuery = "SELECT COUNT(*) AS totalCategories FROM category";
    $categoryResult = mysqli_query($con, $categoryQuery);

    if ($categoryResult) {
        $categoryData = mysqli_fetch_assoc($categoryResult);
        $totalCategories = $categoryData['totalCategories'];
    } else {
        echo "Error retrieving total number of categories: " . mysqli_error($con);
        $totalCategories = 0; // Set default value if an error occurs
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard | Online Quiz System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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
            color: red;
        }
        .card {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            padding: 20px;
            text-align: center;
        }

        .card h2 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <ul>
            <li><a href="dashboard.php">Home</a></li>
            <li><a href="insertCategory.php">Category</a></li>
            <li><a href="selectCategory.php">Question</a></li>
            <li><a href="viewUser.php">User List</a></li>
            <li><a href="oldResult.php">History</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>    
    </div>
    <div class="container">
        <div class="card">
            <h2>Total Number of Users:</h2>
            <h2><?php echo $totalUsers; ?></h2>
        </div>

        <div class="card">
            <h2>Total Number of Categories:</h2>
            <h2><?php echo $totalCategories; ?></h2>
        </div>
    </div>

</body>
</html>
