<?php
session_start();

if(
        isset($_SESSION['empemail'])
    &&  !empty($_SESSION['empemail'])
){
    $email=$_SESSION['empemail'];
    try{
        $conn=new PDO('mysql:host=localhost:3306;dbname=h_r_m_project;','root','');
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        
        $sqlquerystring="SELECT Emp_id,Departmentmanager_id FROM employee WHERE Email='$email'";
        $returnobj=$conn->query($sqlquerystring);
        $tabledata=$returnobj->fetchAll();
        foreach($tabledata AS $row){
            $empid=$row ['Emp_id'];
            $manid=$row ['Departmentmanager_id'];
        }
        
    }
    catch (PDOException $ex){
        ?>
            <script>location.assign('employeehome.php')</script>
        <?php
    }
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Complain</title>
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
            <form action="ecomplainprocess.php" method="POST">
                <h2>This page is for do complain</h2>
                <br> 
                <h3>Enter your complain here: </h3>
                <label for="complain">Complain description: </label>
                <input type="text" name="complain" id="complain" placeholder="Enter complain">
                <label for="empid">Id: </label>
                <input type="text" name="empid" id="empid" value="<?php echo $empid ?>">

                <button type='submit'>Submit</button>

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