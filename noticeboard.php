<?php

session_start();
if(isset($_SESSION['Memail'])
&& !empty($_SESSION['Memail'])){
    
?>

<!DOCTYPE html>
<html>
<head>
<meta charset ="utf-8">
<title>Notice Board</title>
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
    h2{
        text-align: center;
        margin-bottom: 40px;
    }
    input{
        display: block;
        border: 2px solid #ccc;
        width: 95%;
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

    
    <form action="noticeboardprocess.php" method="POST">
    <h3>Post a notice here !!!</h3>
    
    <br>
    <label for="title">Notice Title :</label>
    <input type="text" id ="title" name="title">
    <br><br>
    <textarea rows="8" cols="50" name="notice" ></textarea>
    <br><br>
    <input type="submit" value="Post" >
    <br><br>
    <input type="button"  value="Back To Home" onclick="backfn();">
    
    </form>
    <script>
    function backfn(){
        location.assign('AdminHome.php');
    }
    </script>
</body>
</html>

<?php
}else{
echo "<script>location.assign('AdminLogin.php')</script>";
}
?>

