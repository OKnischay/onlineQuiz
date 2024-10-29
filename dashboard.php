<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;}
include 'db_connection.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Document</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <div class="btf">
            <?php
            echo "Best Of Luck !!  " . $_SESSION['username'];
            ?>
    </div>
    <div class="time">
        Remaining Time:  
        <div id="countdowntimer" style="display: block;"></div>
        No of Questions:
        <div class="time-body">
            <div id="currentQuestion" style="float:left">0</div>
            <div style="float:left">/</div>
            <div id="totalQuestion" style="float:left">0</div>
        </div>
    </div>
    <div id="loadQuestions">
    </div>
    <br><br>
    <div class="btn">
        <input type="button" value="Previous" onclick="loadPrevious()">
        <input type="button" value="Next" onclick="loadNext();">
    </div>
</body>
<script>
         // Disable right-clicking on the dashboard page
         document.addEventListener("contextmenu", function (e) {
            e.preventDefault();
        });

        // Disable mouse click event for all links
        document.addEventListener("click", function(e) {
            if (e.target.tagName === "A") {
                e.preventDefault();
            }
            });

            document.addEventListener("visibilitychange", function(){
                if(document.visibilityState === "visible"){
                    document.title = "Active";
                }
                else{
                    window.location = "result.php";
                }
            });
    console.log("script");
    loadTotalQuestion();
    setInterval(timer, 1000);
    function timer(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function (){
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                if (xmlhttp.responseText === "00:00:01") {
                    window.location = "result.php"; }
                document.getElementById("countdowntimer").innerHTML = xmlhttp.responseText;
            } };
        xmlhttp.open("GET", "forAjax/loadTimer.php", true);
        xmlhttp.send();}
    function loadTotalQuestion(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function (){
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("totalQuestion").innerHTML = xmlhttp.responseText;
            }};
        xmlhttp.open("GET", "forAjax/loadTotalQuestion.php", true);
        xmlhttp.send();
    }
    
    var questionNo = 0;
    function loadQuestions(questionNo){
        document.getElementById("currentQuestion").innerHTML = questionNo;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function (){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                if(xmlhttp.responseText == "over") {
                    window.location = "result.php";
                }else{
                    document.getElementById("loadQuestions").innerHTML = xmlhttp.responseText;
                    loadTotalQuestion();
                }}};
        xmlhttp.open("GET", "forAjax/loadQuestions.php?questionNo=" + questionNo, true);
        xmlhttp.send(); }
    function loadPrevious(){
        if(questionNo > 1){
            questionNo--;
            loadQuestions(questionNo);
        }}
    function loadNext(){
        questionNo++;
        loadQuestions(questionNo);}
    function updateQuestionNo(questionNo) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "forAjax/updateQuestionNo.php?questionNo=" + questionNo, true);
        xmlhttp.send();}
    function radioclick(radiovalue, questionNo){
        console.log("Clicked! radiovalue: " + radiovalue + ", questionNo: " + questionNo);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            }};
        xmlhttp.open("GET", "forAjax/saveAnswerInSession.php?questionNo=" + questionNo + "&value1=" + radiovalue, true);
        console.log("Sending AJAX request...");
        xmlhttp.send();}
    loadNext();
</script>
</html>