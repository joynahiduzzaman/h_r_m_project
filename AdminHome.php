<?php

session_start();
if(isset($_SESSION['Memail'])
&& !empty($_SESSION['Memail'])){
?>

    <!DOCTYPE html>
<html>
<head>
<meta charset ="utf-8">
<title>Manager Home Page</title>

<style>
    body{
        background-color: #DAF7A6;
        display: flex;
        justify-content: center;
        align-items:center;
        height: 100vh;
    }
    *{
        font-family:  sans-serif;
        box-sizing: border-box;
    }
    form{
        width: 500px;
        border: 2px solid #ccc;
        padding: 30px;
        background: white;
        border-radius: 15px;
    }
    h1{
        text-align: center;
        margin-bottom: 40px;
    }
    input{
        display: inline-block;
        border: 2px solid #ccc;
        width: 50%;
        padding: 10px;
        margin: 10px auto;
        border-radius: 5px;
    }
    label{
        color: black;
        font-size: 18px;
        padding: 10px;
    }
    button {
        float: right;
        background: #555;
        padding: 10px 15px;
        color: #fff;
        border-radius: 5px;
        margin-right: 10px;
        border:none;
    }
    button:hover{
        opacity: .7;
    }
    input:hover{
        opacity: .7;
    }
    </style>
</head>
<body>
    <form>
    <h1>Welcome Home !</h1>
    <input type="button" value="Add employee" onclick="addemployeefn();">
    <br>
    <input type="button" value="View employee" onclick="viewemployeefn();">
    <br>
    <input type="button" value="Attendance" onclick="attendancefn();">
    <br>
    <input type="button" value="Notice board" onclick="noticefn();">
    <br>
    <input type="button" value="Employee Leave" onclick="empleavefn();">
    <br>
    <input type="button" value="Salary" onclick="salaryfn();">
    <br>
    <input type="button" value="Complains" onclick="complainfn();">
    <br>
    <input type="button" value="Add training" onclick="trainingfn();">
    <br>
    <input type="button" value="Allocate Reward" onclick="rewardfn();">
    <br>
    <input type="button" value="Log out" onclick="logoutfn();">

    <script>
    function logoutfn(){
        location.assign('logout.php');
    }
    function addemployeefn(){
location.assign('addemployee.php');
    }
    function viewemployeefn(){
        location.assign('viewemployee.php');
    }
    function attendancefn(){
        location.assign('AdminAttendance.php');
    }
    function noticefn(){
        location.assign('noticeboard.php');
    }
    function empleavefn(){
        location.assign('empleave.php');
    }
    function salaryfn(){
        location.assign('AdminSalary.php');
    }
    function complainfn(){
        location.assign('complain.php');
    }
    function trainingfn(){
        location.assign('AdminTraining.php');
    }
    function rewardfn(){
        location.assign('AdminReward.php');
    }
    </script>
    </form>
</body>
</html>

<?php
}else{
echo "<script>location.assign('AdminLogin.php')</script>";
}
?>

