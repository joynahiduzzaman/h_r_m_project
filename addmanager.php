<?php
session_start();

if(
        isset($_SESSION['adminemail'])
    &&  !empty($_SESSION['adminemail'])
){
    $email=$_SESSION['adminemail'];
    try{
        $conn=new PDO('mysql:host=localhost:3306;dbname=h_r_m_project;','root','');
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        
        $sqlquerystring="SELECT Representative_id FROM company WHERE Email='$email'";
        $returnobj=$conn->query($sqlquerystring);
        $tabledata=$returnobj->fetchAll();
        foreach($tabledata AS $row){
            $rid=$row ['Representative_id'];
        }
        
    }
    catch (PDOException $ex){
        ?>
            <script>location.assign('home.php')</script>
        <?php
    }
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Add manager</title>
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
            <form action="addmanagerprocess.php" method="POST">
                <h2>This page is for add manager</h2>
                <br> 
                <h3>Enter manager information here: </h3>
                <label for="mname">Manager name: </label>
                <input type="text" name="mname" id="mname" placeholder="Enter manager name">
                <label for="memail">Email: </label>
                <input type="text" name="memail" id="memail" placeholder="Enter manager email">
                <label for="pass">Password: </label>
                <input type="password" name="pass" id="pass" placeholder="Enter password">
                <label for="deptid">Department id: </label>
                <input type="text" name="deptid" id="deptid" placeholder="Enter manager's dept id">
                <label for="mnum">Phone no: </label>
                <input type="tel" name="mnum" id="mnum" placeholder="Enter phone number">
                <label for="rep">Manager's representative id: </label>
                <input type="text" name="rep" id="rep"  value="<?php echo $rid ?>">
                <button class="btn">Add info</button>

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