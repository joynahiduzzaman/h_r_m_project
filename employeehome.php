<?php
session_start();
if(
    isset($_SESSION['empemail']) &&
    !empty($_SESSION['empemail'])
){
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Employee Home Page</title>
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
            <h1>This is the Employee Home Page</h1>
        <label>Ask for leave: </label><br>
        <input type="button" value="Ask leave" onclick="askleave()";>
        <input type="button" value="Approval??" onclick="approval()";>
        <br>
        <label>Do complain:</label><br>
        <input type="button" value="Complain" onclick="complain()";>
        <input type="button" value="Comment on complain" onclick="comment()";>
        <br>
        <label>View noticeboard:</label>
        <input type="button" value="Notice board" onclick="notice()";>
        <br>
        <label>Reward:</label>
        <input type="button" value="Reward" onclick="reward()";>
        <br>
        <label>Salary:</label>
        <input type="button" value="Salary" onclick="salary()";>
        <br>
        <label>View attendance:</label>
        <input type="button" value="Attendance" onclick="attendance()";>
        <br>
        <label>Training status:</label>
        <input type="button" value="Training" onclick="training()";>
        <br><br>
            <br>

            <input type="button" value="Logout" onclick="logout()";>


        <script>
            function askleave(){
                location.assign('askleave.php');
            }

            function approval(){
                location.assign('approval.php');
            }

            function complain(){
                location.assign('docomplain.php');
            }

            function comment(){
                location.assign('comment.php');
            }
            
            function notice(){
                location.assign('viewnoticeboard.php');
            }

            
            function reward(){
                location.assign('reward.php');
            }
            
            function salary(){
                location.assign('salary.php');
            }
            
            function attendance(){
                location.assign('attendance.php');
            }

            function training(){
                location.assign('training.php');
            }

            function logout(){
                location.assign('logoutemployee.php');
            }
        </script>
        </form>
    </body>
    </html>
    <?php
}
else{
    ?>
      <script>location.assign('employeelogin.php')</script>
    <?php
}
?>