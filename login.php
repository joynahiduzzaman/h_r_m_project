<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        background: darkslategrey;
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
   <form action="adminloginprocess.php" method="POST">
      <h2>Admin Login</h2>
      <label for="uemail">Email: </label>
      <input type="email" id="uemail" name="uemail" placeholder="Enter your email">
      
      <label for="upass">Password: </label>
      <input type="password" id="upass" name="upass" placeholder="Enter your password">
      <button type="submit">Login</button>
      <br>
      <br>
      <input type="button" value="Employee login" onclick="elog()";>
      <input type="button" value="Manager Login" onclick="mlog()";>

      <script>
        function elog(){
            location.assign('employeelogin.php'); 
        }
        function mlog(){
            location.assign('managerlogin.php'); 
        }
    </script>
   </form>
</body>
</html>