<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}
include 'db_connection.php';
unset($_SESSION["answer"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Display Category</title>
    <link rel="stylesheet" href="css/selExa.css">
</head>
<body>
    
        <div class="navbar">
            
        
                <h1>Test Your Knowledge</h1>
                    <div class = "uname">
                        <?php
                        echo "Welcome !! " . $_SESSION[ 'username'];
                        ?>
                    </div>
                
                <a href="history.php">History</a>
                <a href="logout.php">Logout</a>
            
        </div>
    <div>
        <div class="selection">
            <div class="head">
                <h2>Select Quiz subject:</h2>
            </div>
            <div class="selection-body">
                <?php
                $res = mysqli_query($con, "SELECT * FROM category order by rand();");
                while ($row = mysqli_fetch_array($res)) {
                    ?>
                    <button value="<?php echo $row["category_name"] ?>" onclick="checkQuestionsAndRedirect(this.value);"><?php echo $row["category_name"] ?></button>
                    <?php
                }
                ?>
            </div>
        </div>
        <br>
        <br>
    </div>

    <script>
    function checkQuestionsAndRedirect(category_name) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var response = xmlhttp.responseText;
                if (response === "questions_exist") {
                    setExamTypeSession(category_name);
                } else {
                    alert("No questions found for the selected category.");
                }
            }
        };
        xmlhttp.open("GET", "forAjax/checkQuestions.php?category_name=" + category_name, true);
        xmlhttp.send();
    }

    function setExamTypeSession(category_name) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                window.location.href = "dashboard.php";
            }
        };
        xmlhttp.open("GET", "forAjax/setExamTypeSession.php?category_name=" + category_name, true);
        xmlhttp.send();
    }
    </script>
</body>
</html>
