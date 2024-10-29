<?php
session_start();
include 'db_connection.php';

if (isset($_GET['questionNo'])) {
    $questionNo = $_GET['questionNo'];
    $_SESSION['questionNo'] = $questionNo;
    echo "Question number updated: " . $questionNo;
} else {
    echo "Invalid question number.";
}
?>
