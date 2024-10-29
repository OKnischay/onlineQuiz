<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
$questionNo=$_GET['questionNo'];
$value1=$_GET['value1'];
$_SESSION["answer"][$questionNo]=$value1;
echo $questionNo;
?>
