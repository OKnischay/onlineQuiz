<?php
session_start();
include 'E:\xampp\htdocs\onlineQuiz\db_connection.php';

if (isset($_GET["category_name"])) {
    $category_name = $_GET["category_name"];
    $_SESSION["category_name"] = $category_name;
    $_SESSION["examTime"] = ""; // Added the assignment operator here

    $res = mysqli_query($con, "SELECT * FROM category WHERE category_name='$category_name'") or die(mysqli_error($con));
    while ($row = mysqli_fetch_array($res)) {
        $_SESSION["examTime"] = $row["time"];
        echo $row["time"];
    }

    $examTimeInMinutes = intval($_SESSION["examTime"]); // Convert the exam time to integer

    $endTime = date('Y-m-d H:i:s', strtotime('+' . $examTimeInMinutes . ' minutes')); // Calculate the end time

    $_SESSION["endTime"] = $endTime;
    $_SESSION["examStart"] = "yes";
}

?>
