<?php
session_start();
include 'E:\xampp\htdocs\onlineQuiz\db_connection.php';
$totalQuestion= 0;
$res1 = mysqli_query($con, "SELECT * FROM questions WHERE category_name='{$_SESSION['category_name']}' limit 10");
$totalQuestion = mysqli_num_rows($res1);
echo $totalQuestion;
?>
