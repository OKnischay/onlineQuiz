<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: index.php");
    exit;
}

include 'E:\xampp\htdocs\onlineQuiz\db_connection.php';
$id = $_GET['id'];
$category_id = $_GET['id1'];

// Get the question number of the question being deleted
$res = mysqli_query($con, "SELECT questionNo FROM questions WHERE id = $id");
$row = mysqli_fetch_array($res);
$deletedQuestionNo = $row["questionNo"];
$category_name = $row["category_name"];

// Delete the question
mysqli_query($con, "DELETE FROM questions WHERE id = $id");

// Renumber the remaining questions
$res = mysqli_query($con, "SELECT id FROM questions WHERE category_name = '$category_name' ORDER BY questionNo ASC");
$loop = 0;
while ($row = mysqli_fetch_array($res)) {
    $loop++;
    $question_id = $row["id"];
    mysqli_query($con, "UPDATE questions SET questionNo = $loop WHERE id = $question_id");
}

header("Location: addEditQuestion.php?id=$category_id"); // Redirect back to the question list
exit;
?>
