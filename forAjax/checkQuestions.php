<?php
include '../db_connection.php';

$category_name = $_GET['category_name'];

$res = mysqli_query($con, "SELECT * FROM questions WHERE category_name = '$category_name'");

if (mysqli_num_rows($res) > 0) {
    echo "questions_exist";
} else {
    echo "no_questions";
}
?>
