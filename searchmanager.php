<?php
session_start();

if(
        isset($_SESSION['adminemail'])
    &&  !empty($_SESSION['adminemail'])
){
    
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Search manager</title>
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
                background: #7f9c9c;
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
            <form action="searchmanagerprocess.php" method="POST">
                <h2>This page is for search manager</h2>
                <br> 
                <h3>Enter your wanted manager name here: </h3>
                <label for="mname">Manager name: </label>
                <input type="text" name="mname" id="mname" placeholder="Enter manager name">
                <button class="btn">Search</button>
                <input type="button" value="Go back" onclick="goback()";>
            </form>
            <script>
            function goback(){
                location.assign('home.php');
            }
        </script>
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