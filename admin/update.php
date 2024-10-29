<?php
include 'E:\xampp\htdocs\onlineQuiz\db_connection.php';
$id = $_GET["id"];
$res = mysqli_query($con, "select * from category  where category_ID= $id ");
while ($row = mysqli_fetch_array($res)) {
    $exam_name = $row["category_name"];
    $exam_time = $row["time"];

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Category</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0px;
        }

        .navbar {
            background-color: #333;
            overflow: hidden;
        }

        .navbar a {
            float: left;
            color: #f2f2f2;
            text-align: center;
            /* padding: 14px 16px; */
            text-decoration: none;
            font-size: 17px;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
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
        form {
            margin: 35px;
            font-size: 19px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="submit"] {
            padding: 10px;
            width: 200px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
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

    <form name="form1" action="" method="post">
        <label for="categoryName">Quiz Name:</label>
        <input type="text" name="categoryName" id="categoryName" placeholder="Quiz Name"
               value="<?php echo $exam_name ?>">
        <br>
        <br>
        <label for="quizTime">Update Quiz Time:</label>
        <input type="text" name="quizTime" id="quizTime" placeholder="Time" value="<?php echo $exam_time ?>">
        <br>
        <br>
        <input type="submit" value="Update Exam" name="submit">
    </form>

</body>
</html>

<?php
if (isset($_POST['submit'])) {
    include 'E:\xampp\htdocs\onlineQuiz\db_connection.php';

    $categoryName = $_POST['categoryName'];
    $quizTime = $_POST['quizTime'];

    $query = "update category set category_name='$categoryName', time='$quizTime' where category_ID=$id";
    $query2 = "update questions set category_name='$categoryName' where category_name='$exam_name'";

    if (mysqli_query($con, $query) && mysqli_query($con, $query2)) {
        echo '<script>window.location.href = "insertCategory.php";</script>';
    } else {
        die('Error: ' . mysqli_error($con));
    }

    mysqli_close($con);
}
?>
