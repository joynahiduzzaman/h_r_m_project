<!DOCTYPE html>
<html>
<head>
<meta charset ="utf-8">
<title>Manager login page</title>

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
    
    <form action="Admin_Login_Process.php" method="POST">
    <h4>Manager Login</h4>
    <br>
    <label for="Memail">Email : </label>
    <input type="email" id="Memail" name="Memail" placeholder="Enter your email" >
    <br>
    <label for="Mpassword">Password : </label>
    <input type="password" id="Mpassword" name="Mpassword" placeholder="Enter your password">
    <br>
    <input type="submit" value="Login" >
    
    </form>
    
</body>
</html>
