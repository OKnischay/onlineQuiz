<?php
session_start();
include 'E:\xampp\htdocs\onlineQuiz\db_connection.php';

$questionNo="";
$question = "";
$opt1 = "";
$opt2 = "";
$opt3 = "";
$opt4 = "";
$answer="";
$count=0;
$ans = "";

$queNo=$_GET["questionNo"];

if(isset($_SESSION["answer"][$queNo])){
    $ans=$_SESSION["answer"][$queNo];
}


$res = mysqli_query($con, "SELECT * FROM questions WHERE category_name='{$_SESSION['category_name']}' && questionNo='$queNo'  ") or die(mysqli_error($con));

$count = mysqli_num_rows($res);
if ($count == 0 || $queNo > 10) {
    echo "over";
} else {
    if ($row = mysqli_fetch_array($res)) {
        $questionNo=$row["questionNo"];
        $question = $row["questionDecs"];
        $opt1 = $row["opt1"];
        $opt2 = $row["opt2"];
        $opt3 = $row["opt3"];
        $opt4 = $row["opt4"];
    }
?>
    <br>
    <table>
        <tr>
            <th><?php echo $questionNo.".".$question; ?></th>
        </tr>
    </table>    
    <table>
        <tr>
            <td>
            <input type="radio" name="r1" id="r1" value="<?php echo $opt1; ?>" onclick="radioclick(this.value, <?php echo $questionNo; ?>)" 
            <?php if ($ans == $opt1) { echo "checked"; } ?>>

                <?php echo $opt1; ?>
            </td>
        </tr>
        <tr>
            <td>
            <input type="radio" name="r1" value="<?php echo $opt2; ?>" onclick="radioclick(this.value, <?php echo $questionNo; ?>)" 
            <?php if ($ans == $opt2) { echo "checked"; } ?>>
                <?php echo $opt2; ?>
            </td>
        </tr>
        <tr>
            <td>
            <input type="radio" name="r1" value="<?php echo $opt3; ?>" onclick="radioclick(this.value, <?php echo $questionNo; ?>)" 
            <?php if ($ans == $opt3) { echo "checked"; } ?>>

                <?php echo $opt3; ?>
            </td>
        </tr>
        <tr>
            <td>
            <input type="radio" name="r1" value="<?php echo $opt4; ?>" onclick="radioclick(this.value, <?php echo $questionNo; ?>)" 
            <?php if ($ans == $opt4) { echo "checked"; } ?>>


                <?php echo $opt4; ?>
            </td>
        </tr>
    </table>
<?php
}
?>