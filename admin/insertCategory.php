<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: index.php");
    exit;
}


if (isset($_POST['submit'])) {
    include 'E:\xampp\htdocs\onlineQuiz\db_connection.php';

    $categoryName = $_POST['categoryName'];
    $quizTime = $_POST['quizTime'];

    if (!empty($categoryName)) {
        $query = "INSERT INTO `category` VALUES (NULL, '$categoryName', '$quizTime')";

        if (mysqli_query($con, $query)) {
            echo '<script>alert("Exam added successfully");';
            echo 'window.location.href = window.location.href;</script>';
            header("refresh:0;url=registerPage.php");
        } else {
            die('Error: ' . mysqli_error($con));
        }
    } else {
        echo '<script>alert("Category name must not be empty");</script>';
    }

    mysqli_close($con);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Category</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            padding: 8px 16px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }

        /* Navigation Bar */

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
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="container">
        <table>
            <form name="form1" action="" method="post">
                <tr>
                    <td><input type="text" name="categoryName" placeholder="Quiz Name"></td>
                </tr>
                <tr>
                    <td><input type="text" name="quizTime" placeholder="Time"></td>
                </tr>
                <tr>
                    <td><input type="submit" value="Add" name="submit"></td>
                </tr>
            </form>
        </table>
        <table>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Exam Time</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <tbody>
                <?php
                $count = 0;
                include 'E:\xampp\htdocs\onlineQuiz\db_connection.php';
                $res = mysqli_query($con, 'SELECT * FROM category');

                while($row = mysqli_fetch_array($res)) {
                    $count += 1;
                    ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $row['category_name']; ?></td>
                        <td><?php echo $row['time']; ?></td>
                        <td><a href="update.php?id=<?php echo $row["category_ID"];?>">Edit</a></td>
                        <td><a href="delete.php?id=<?php echo $row["category_ID"];?>">Delete</a></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

