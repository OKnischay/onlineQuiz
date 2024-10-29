<?php

session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: index.php");
    exit;
}

include 'E:\xampp\htdocs\onlineQuiz\db_connection.php';
$id = $_GET['id'];

$exam_category = '';
$res = mysqli_query($con, "SELECT * FROM category WHERE category_ID = $id");
while ($row = mysqli_fetch_array($res)) {
    $exam_category = $row["category_name"];
}

if (isset($_POST['submit'])) {
    $question = mysqli_real_escape_string($con, $_POST['question']);
    $opt1 = mysqli_real_escape_string($con, $_POST['opt1']);
    $opt2 = mysqli_real_escape_string($con, $_POST['opt2']);
    $opt3 = mysqli_real_escape_string($con, $_POST['opt3']);
    $opt4 = mysqli_real_escape_string($con, $_POST['opt4']);
    $answer = isset($_POST['Answer']) ? $_POST['Answer'] : '';

    // Check if the required fields are empty
    if (empty($question) || empty($opt1) || empty($opt2) || empty($opt3) || empty($opt4) ||empty($answer)) {
        echo "<script>alert('Question ,Option  and answer must not be empty');</script>";
    } else {
        $loop = 0;
        $res = mysqli_query($con, "SELECT * FROM questions WHERE category_name = '$exam_category' ORDER BY questionNo ASC") or die(mysqli_error($con));
        $count = mysqli_num_rows($res);
        if ($count == 0) {
            // No existing questions
        } else {
            while ($row = mysqli_fetch_array($res)) {
                $loop ++;
                mysqli_query($con, "UPDATE questions SET questionNo = '$loop' WHERE id = $row[id]");
            }
        }
        $loop = $loop + 1;

        // Escape the question, options, and answer values

        // Insert the escaped values into the query
        mysqli_query($con, "INSERT INTO questions VALUES (NULL, '$loop', '$question', '$opt1', '$opt2', '$opt3', '$opt4', '$answer', '$exam_category')") or die(mysqli_error($con));

        echo "<script>alert('Question added'); window.location.href = window.location.href;</script>";

        $availableOptions = array('opt1', 'opt2', 'opt3', 'opt4');
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin:0;
            padding:0
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .navbar {
            background-color: #333;
            color: #fff;
            padding: 10px;
        }

        .navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        .navbar li {
            float: left;
        }

        .navbar li a {
            display: block;
            color: #fff;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navbar li a:hover {
            background-color: #555;
        }
		
        form div {
            margin-bottom: 10px;
            text-align: center;
        }

        label {
            display: inline-block;
            width: 100px;
            font-weight: bold;
            text-align: right;
        }

        input[type="text"],
        select {
            width: 300px;
            padding: 5px;
        }

        input[type="submit"] {
            padding: 8px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f5f5f5;
        }

        a {
            color: #333;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
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
<div class="navbar">
<ul>
<li><a href="dashboard.php">Home</a></li>
                 <li><a href="insertCategory.php">Category </a></li>
            <li><a href="selectCategory.php">Question</a></li>
            <li><a href="viewUser.php">User List</a></li>
            <li><a href="oldResult.php">History</a>  </li>
            <li><a href="logout.php">Logout</a>  </li>
        </ul>
    </div>

    <h1>Add Question in <?php echo $exam_category ?></h1>

    <form name="form1" action="" method="post">
        <div>
            <div>
                <label for="question">Question</label>
                <input type="text" name="question" id="question">
            </div>
            <div>
                <label for="opt1">Option 1</label>
                <input type="text" name="opt1" id="opt1" oninput="updateSelectOption()">
            </div>
            <div>
                <label for="opt2">Option 2</label>
                <input type="text" name="opt2" id="opt2" oninput="updateSelectOption()">
            </div>
            <div>
                <label for="opt3">Option 3</label>
                <input type="text" name="opt3" id="opt3" oninput="updateSelectOption()">
            </div>
            <div>
                <label for="opt4">Option 4</label>
                <input type="text" name="opt4" id="opt4" oninput="updateSelectOption()">
            </div>
            <div>
                <label for="Answer">Answer</label>
                <select name="Answer" id="Answer" >
                    <option value="">Select correct answer</option>
                </select>
            </div>
            <input type="submit" value="Add Question" name="submit">
        </div>
    </form>

    <br>
    <br>
    <div>
        <h1>Showing questions</h1>
        <br>
        <table>
            <tr>
                <th>no</th>
                <th>question</th>
                <th>opt1</th>
                <th>opt2</th>
                <th>opt3</th>
                <th>opt4</th>
                <th>answer</th>
                <th>edit</th>
                <th>delete</th>
            </tr>
            <?php
            $res = mysqli_query($con, "SELECT * FROM questions WHERE category_name = '$exam_category' ORDER BY questionNo ASC") or die(mysqli_error($con));
   $loop=0;
            while ($row = mysqli_fetch_array($res)) {
                $loop++;
                $question_id = $row["id"];
                mysqli_query($con, "UPDATE questions SET questionNo = $loop WHERE id = $question_id");
                echo "<tr>";
                echo "<td>" . $loop . "</td>";
                echo "<td>" . $row["questionDecs"] . "</td>";
                echo "<td>" . $row["opt1"] . "</td>";
                echo "<td>" . $row["opt2"] . "</td>";
                echo "<td>" . $row["opt3"] . "</td>";
                echo "<td>" . $row["opt4"] . "</td>";
                echo "<td>" . $row["correctAns"] . "</td>";
                echo "<td>";?><a href="editQuestion.php?id=<?php echo $row["id"]?>&id1=<?php echo $id?>">edit</a> <?php echo"</td>";
                echo "<td>";?>  <a href="deleteQuestion.php?id=<?php echo $row["id"]?>&id1=<?php echo $id?>"> delete</a>   <?php echo"</td>";
               
                echo "</tr>";
            } ?>
        </table>
    </div>
</body>
</html>
