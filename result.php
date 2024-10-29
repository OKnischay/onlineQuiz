<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

$date = date("Y-m-d H:i:s");
$_SESSION["endTime"] = date("Y-m-d H:i:s", strtotime($date . "+$_SESSION[examTime] minutes"));
include 'E:\xampp\htdocs\onlineQuiz\db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
  <link rel="stylesheet" href="css/result.css">
</head>

<body>
    <div class="navbar">
        <a href="selectExam.php">Home</a>
        <a href="history.php">History</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <?php
        $correct = 0;
        $wrong = 0;

        if (isset($_SESSION["answer"])) {
            for ($i = 1; $i <= sizeof($_SESSION["answer"]); $i++) {
                $answer = "";
                $res = mysqli_query($con, "SELECT * FROM questions WHERE category_name='{$_SESSION['category_name']}' AND questionNo=$i") or die(mysqli_error($con));
                while ($row = mysqli_fetch_array($res)) {
                    $answer = $row["correctAns"];
                }

                $_SESSION["questionAnswer"][$i] = $answer;
                if (isset($_SESSION["answer"][$i])) {
                    if ($answer == $_SESSION["answer"][$i]) {
                        $correct = $correct + 1;
                    }else {
                       $wrong = $wrong + 1;
                   }
                } else {
                    $wrong = $wrong + 1;
                }
            }
        }
        $count = 0;
        $res = mysqli_query($con, "SELECT * FROM questions WHERE category_name='{$_SESSION['category_name']}' LIMIT 10");
        $count = mysqli_num_rows($res);
        $wrong = $count - $correct;

        ?>

        <h2>Quiz Results</h2>
        <div class="result">
            <p>Total Questions: <?php echo $count; ?></p>
            <p>Correct Answers: <?php echo $correct; ?></p>
            <p>Wrong Answers: <?php echo $wrong; ?></p>
        </div>
    </div>

    <?php
    if (isset($_SESSION["examStart"])) {
        $date = date("Y-m-d");
        mysqli_query($con, "INSERT INTO result (id, email, exam_type, total_question, correct_answer, wrong_answer, exam_time) VALUES (NULL, '$_SESSION[username]', '$_SESSION[category_name]', '$count', '$correct', '$wrong', '$date') ");
    }

    if (isset($_SESSION["examStart"])) {
        unset($_SESSION["examStart"]);
    ?>
        <script>
            // Reload the page after unsetting the session
            window.location.href = window.location.href;
        </script>
    <?php
    }
    ?>
    <a href="selectexam.php" class="play-again-button">Play Again?</a>
</body>

</html>
