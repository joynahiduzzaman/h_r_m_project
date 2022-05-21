<?php

session_start();
if(isset($_SESSION['Memail'])
&& !empty($_SESSION['Memail'])){


if($_SERVER['REQUEST_METHOD']=="POST"){
    
    //empty value check, valid index check
    
    if(
        isset($_POST['notice']) &&
        isset($_POST['title']) &&
        !empty($_POST['notice']) &&
        !empty($_POST['title']) 
         )
    
    {
        $title=($_POST['title']);
       $notice=$_POST['notice'];
       
       
        ///tries to communicate with the database and store the data
        
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
    }
    // manager id saved in managerid variable

    // this part is for getting emp id
    $sqlquerystring1="SELECT * FROM employee
    WHERE DepartmentManager_id='$managerid' ";

$returnobj=$conn->query($sqlquerystring1);
$tabledata=$returnobj->fetchAll();
foreach($tabledata AS $row){
    $empid=$row['Emp_id'];
//database code execute, default : warning generate
$sqlquerystring="INSERT INTO notice VALUES(NULL,CURDATE(),'$title','$notice',$managerid) ";
            
///executing the mysql code
$conn->exec($sqlquerystring);
}

            
            ?>
                    <script>location.assign('AdminHome.php')</script>
                <?php
            
        }
        catch (PDOException $ex){
            ?>
                <script>location.assign('noticeboard.php')</script>
            <?php
        }
    }
    else{
        //otherwise
        ?>
        <script>location.assign('noticeboard.php')</script>
        <?php
    }
}
else{
    //we won't provide service
    echo "<script>location.assign('noticeboard.php')</script>";
}

}else{
echo "<script>location.assign('AdminLogin.php')</script>";
}
?>
