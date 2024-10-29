<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: index.php");
    exit;
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty List</title>
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
        }
		
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        table th,
        table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        
        table th {
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
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <table>
        <tr>
            <th>sn</th>
            <th>name</th>
            <th>time</th>
            <th>select</th>
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
                    <td><a href="addEditQuestion.php?id=<?php echo $row["category_ID"]; ?>">select</a></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</body>
</html>
