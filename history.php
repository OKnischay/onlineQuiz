<?php
session_start();
include 'db_connection.php';
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <link rel="stylesheet" href="css/hist.css">
 
</head>

<body>
    <div class="navbar">
        <ul>
           <li>
                <div class="session">
                    <?php
                    echo "Your Progress !!   ".$_SESSION['username'];
                    ?>
                </div>
            </li>
            <li><a href="selectExam.php">Home</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="content">
        <h1>History</h1>

        <?php
        $res = mysqli_query($con, "SELECT * FROM result WHERE email='$_SESSION[username]' ORDER BY id DESC");
        $count = mysqli_num_rows($res);

        if ($count == 0) {
            echo "<p>No history available.</p>";
        } else {
            echo "<table>";
            echo "<tr>";
            echo "<th>SN</th>";
            echo "<th>Exam Name</th>";
            echo "<th>Total Questions</th>";
            echo "<th>Correct Answers</th>";
            echo "<th>Wrong Answers</th>";
            echo "<th>Exam Time</th>";
            echo "</tr>";
$loop=0;
            while ($row = mysqli_fetch_array($res)) {
                $loop++;
                echo "<tr>";
                echo "<td>" . $loop . "</td>";
                echo "<td>" . $row["exam_type"] . "</td>";
                echo "<td>" . $row["total_question"] . "</td>";
                echo "<td>" . $row["correct_answer"] . "</td>";
                echo "<td>" . $row["wrong_answer"] . "</td>";
                echo "<td>" . $row["exam_time"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        }
        ?>
    </div>
</body>

</html>
