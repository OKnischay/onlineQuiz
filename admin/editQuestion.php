<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: index.php");
    exit;
}

include 'E:\xampp\htdocs\onlineQuiz\db_connection.php';
$id = $_GET["id"];
$id1 = $_GET["id1"];

$question = '';
$opt1 = '';
$opt2 = '';
$opt3 = '';
$opt4 = '';
$answer = '';

$res = mysqli_query($con, "SELECT * FROM questions WHERE id =$id");
while ($row = mysqli_fetch_array($res)) {
    $question = $row["questionDecs"];
    $opt1 = $row["opt1"];
    $opt2 = $row["opt2"];
    $opt3 = $row["opt3"];
    $opt4 = $row["opt4"];
    $answer = $row["correctAns"];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        select {
            padding: 10px;
            margin-bottom: 10px;
        }

        select {
            width: 100%;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
    <script>
        function updateSelectOption() {
            var opt1Value = document.getElementById('opt1').value;
            var opt2Value = document.getElementById('opt2').value;
            var opt3Value = document.getElementById('opt3').value;
            var opt4Value = document.getElementById('opt4').value;
            var selectBox = document.getElementById('Answer');

            // Remove existing options
            selectBox.innerHTML = '';

            // Create new options based on input values
            var option1 = document.createElement('option');
            option1.value = opt1Value;
            option1.textContent = 'Option 1';
            selectBox.appendChild(option1);

            var option2 = document.createElement('option');
            option2.value = opt2Value;
            option2.textContent = 'Option 2';
            selectBox.appendChild(option2);

            var option3 = document.createElement('option');
            option3.value = opt3Value;
            option3.textContent = 'Option 3';
            selectBox.appendChild(option3);

            var option4 = document.createElement('option');
            option4.value = opt4Value;
            option4.textContent = 'Option 4';
            selectBox.appendChild(option4);
        }
    </script>
</head>
<body>
    <h1>Update Question</h1>

    <form name="form1" action="" method="post">
        <div>
            <div>
                <label for="question">Question</label>
                <input type="text" name="question" id="question" value="<?php echo $question ?>" required>
            </div>
            <div>
                <label for="opt1">Option 1</label>
                <input type="text" name="opt1" id="opt1" value="<?php echo $opt1 ?>" oninput="updateSelectOption()" required>
            </div>
            <div>
                <label for="opt2">Option 2</label>
                <input type="text" name="opt2" id="opt2" value="<?php echo $opt2 ?>" oninput="updateSelectOption()" required>
            </div>
            <div>
                <label for="opt3">Option 3</label>
                <input type="text" name="opt3" id="opt3" value="<?php echo $opt3 ?>" oninput="updateSelectOption()" required>
            </div>
            <div>
                <label for="opt4">Option 4</label>
                <input type="text" name="opt4" id="opt4" value="<?php echo $opt4 ?>" oninput="updateSelectOption()" required>
            </div>
            <div>
                <label for="Answer">Answer</label>
                <select name="Answer" id="Answer" required>
                    <option value="<?php echo $opt1 ?>" <?php if ($answer == $opt1) echo "selected" ?>><?php echo $opt1 ?></option>
                    <option value="<?php echo $opt2 ?>" <?php if ($answer == $opt2) echo "selected" ?>><?php echo $opt2 ?></option>
                    <option value="<?php echo $opt3 ?>" <?php if ($answer == $opt3) echo "selected" ?>><?php echo $opt3 ?></option>
                    <option value="<?php echo $opt4 ?>" <?php if ($answer == $opt4) echo "selected" ?>><?php echo $opt4 ?></option>
                </select>
            </div>
            <input type="submit" value="Update" name="submit">
        </div>
    </form>
</body>


<?php
if (isset($_POST["submit"])) {
    $question = $_POST['question'];
    $opt1 = $_POST['opt1'];
    $opt2 = $_POST['opt2'];
    $opt3 = $_POST['opt3'];
    $opt4 = $_POST['opt4'];
    $answer = $_POST['Answer'];

    if (empty($question) || empty($opt1) || empty($opt2) || empty($opt3) || empty($opt4) || empty($answer)) {
        echo "Please enter the question, options, and answer before updating.";
    } else {
        mysqli_query($con, "UPDATE questions SET questionDecs='$question', opt1='$opt1', opt2='$opt2', opt3='$opt3', opt4='$opt4', correctAns='$answer' WHERE id=$id");
        ?>
        <script>
            window.location = "addEditQuestion.php?id=<?php echo $id1 ?>";
        </script>
        <?php
    }
}
?>
