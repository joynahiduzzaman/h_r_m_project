<?php

session_start();
if(isset($_SESSION['Memail'])
&& !empty($_SESSION['Memail'])){
    // This part is for retriving manager id and dept id from manager login email address
    try{
            
        $M_email= $_SESSION['Memail'];
        $conn=new PDO('mysql:host=localhost:3306;dbname=h_r_m_project;','root','');
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
// This part is for retriving manager id from manager login email address
$sqlquerystring0="SELECT * FROM department
WHERE email='$M_email' ";

///executing the mysql code
$returnobj=$conn->query($sqlquerystring0);
$tabledata=$returnobj->fetchAll();
foreach($tabledata AS $row){
    $managerid=$row['Manager_id'];
    $deptid=$row['Dept_id'];
}
$_SESSION["managerid"]=$managerid;
// manager id saved in managerid variable
        
    }
    catch (PDOException $ex){
        ?>
            <script>location.assign('addemployee.php')</script>
        <?php
    }



?>

    <!DOCTYPE html>
<html>
<head>
<meta charset ="utf-8">
<title>ADD EMPLOYEE </title>
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
   
    <form action="addemployeeProcess.php" method="POST">
    <h4>Employee info </h4>
    <label for="name">Full name : </label>
    <input type="text" id="name" name="name" placeholder="Full name " >
    <br>
    <label for="email">Email : </label>
    <input type="email" id="email" name="email" placeholder="Enter email address" >
    <br>
    <label for="password">Password : </label>
    <input type="password" id="password" name="password" placeholder="Enter password">
    <br>
    <label for="p_no">Phone no : </label>
    <input type="text" id="p_no" name="p_no">
    <br>
    <label for="adr">Full Address : </label>
    <input type="text" id="adr" name="adr"  >
    <br>
    <label for="d_id">department ID : </label>
    <input type="text" id="d_id" name="d_id" value="<?php echo "$deptid"?>" readonly>
    <br>
    <label for="M_id">Manager ID : </label>
    <input type="text" id="M_id" name="M_id" value="<?php echo "$managerid"?>" readonly>
    <br>
    <input type="submit" value="Submit">
    
    </form>
</body>
</html>

<?php


}else{
echo "<script>location.assign('AdminLogin.php')</script>";
}
?>

