<?php
session_start();
if(
    isset($_SESSION['adminemail']) &&
    !empty($_SESSION['adminemail'])
){
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Home Page</title>
        <style>
    body{
        background-color: rgb(83, 161, 187);
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
        background: #478484;
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
        color: rgb(233, 230, 230);
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
            <h1>This is the Home Page</h1>
        <label>Add Manager: </label>
        <input type="button" value="Add Manager" onclick="addmanager()";>
        <br>
        <label>See managers(delete,update):</label>
        <input type="button" value="See managers" onclick="seemanager()";>
        <br>
        <label>Search managers:</label><br>
        <input type="button" value="Search managers" onclick="searchmanager()";>
        <br><br>
            <br>

            <input type="button" value="Logout" onclick="logout()";>


        <script>
            function addmanager(){
                location.assign('addmanager.php');
            }

            function seemanager(){
                location.assign('seemanager.php');
            }

            function searchmanager(){
                location.assign('searchmanager.php');
            }

            function logout(){
                location.assign('logoutadmin.php');
            }
        </script>
        </form>
    </body>
    </html>
    <?php
}
else{
    ?>
      <script>location.assign('login.php')</script>
    <?php
}
?>