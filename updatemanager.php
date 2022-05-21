<?php
session_start();

if(
        isset($_SESSION['adminemail'])
    &&  !empty($_SESSION['adminemail'])
){
    if(
        isset($_GET['manid']) &&
        !empty($_GET['manid']) 
    )
    {
        $manid=$_GET['manid'];
        try{
            $conn=new PDO('mysql:host=localhost:3306;dbname=h_r_m_project;','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
            
            $sqlquerystring="SELECT Manager_id,Name,email,Dept_id,phone_no FROM department WHERE Manager_id=$manid";
            $returnobj=$conn->query($sqlquerystring);
            $tabledata=$returnobj->fetchAll();
            foreach($tabledata AS $row){
                $name=$row ['Name'];
                $email=$row ['email'];
                $deptid=$row['Dept_id'];
                $pno=$row['phone_no'];
            }
            
        }
        catch (PDOException $ex){
            ?>
                <script>location.assign('seemanager.php')</script>
            <?php
        }
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Upadte manager</title>
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
                <form action="updatemanagerprocess.php" method="POST">
                    <h2>This page is for add manager</h2>
                    <br> 
                    <h3>Update manager information here: </h3>
                    <label for="manid">Manager id: </label>
                    <input type="text" name="manid" id="manid"  value="<?php echo $manid ?>" readonly>
                    <label for="mname">Manager name: </label>
                    <input type="text" name="mname" id="mname" value="<?php echo $name ?>">
                    <label for="memail">Email: </label>
                    <input type="text" name="memail" id="memail" value="<?php echo $email ?>">
                    <label for="deptid">Department id: </label>
                    <input type="text" name="deptid" id="deptid" value="<?php echo $deptid ?>">
                    <label for="mnum">Phone no: </label>
                    <input type="tel" name="mnum" id="mnum" value="<?php echo $pno ?>">
                    <button class="btn">Update info</button>
    
                </form>
            </body>
            </html>
    
            <?php
    }
    else{
        ?>
         <script>location.assign('home.php')</script>
        <?php
    }
}
else{
    ?>
        <script>location.assign('login.php')</script>
    <?php
}

?>










