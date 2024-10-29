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
    <title>History</title>
    <style>
                * {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            margin: 20px 0;
        }
        
        table th,
        table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        
        table th {
            background-color: #333;
            color: #fff;
        }
        
        table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        
        table tbody tr:hover {
            background-color: #ddd;
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
    <div>

<?php

include 'E:\xampp\htdocs\onlineQuiz\db_connection.php';
$res=mysqli_query($con,"select * from result order by id Asc");
$count=mysqli_num_rows($res);
if($count==0){

    echo" <center><H1>History</H1></center>";
 
}
else
{
    echo" <center><H1>History</H1></center>";
    echo "<table>";
    echo "<tr>";
    echo"<th>"; echo"username";  echo"</th>";
    echo"<th>"; echo"examName"; echo"</th>";
    echo"<th>"; echo"TotalQuestion"; echo"</th>";
    echo"<th>"; echo"CorrectAnswer"; echo"</th>";
    echo"<th>"; echo"WrongAnswer"; echo"</th>";
    echo"<th>"; echo"ExamTime"; echo"</th>";
    echo "</tr>";

    while($row=mysqli_fetch_array($res)){
        echo "<tr>";
        echo"<td>"; echo $row["email"];  echo"</td>";
        echo"<td>"; echo $row["exam_type"]; echo"</td>";
        echo"<td>"; echo $row["total_question"]; echo"</td>";
        echo"<td>"; echo $row["correct_answer"];;echo"</td>";
        echo"<td>"; echo $row["wrong_answer"]; echo"</td>";
        echo"<td>"; echo $row["exam_time"]; echo"</td>";
        echo "</tr>";     
    }

    echo "</table>";
}
?>

</div>
</body>
</html>
