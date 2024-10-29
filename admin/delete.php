<?php
include 'E:\xampp\htdocs\onlineQuiz\db_connection.php';
$id = $_GET["id"];
mysqli_query($con, "DELETE FROM category WHERE category_id = $id");
?>

<script>
window.location = "insertCategory.php";
</script>
