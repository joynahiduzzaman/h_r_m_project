<?php

session_start();
if(isset($_SESSION['Memail'])
&& !empty($_SESSION['Memail'])){

 
 if($_SERVER['REQUEST_METHOD']=="POST"){
     
     //empty value check, valid index check
     if(
        isset($_POST['start_date'])  &&
        isset($_POST['enddate'])  &&
        isset($_POST['description'])  &&
        isset($_POST['institute'])  &&  
        isset($_POST['employeeEmp_id']) &&
       
       !empty($_POST['star_tdate'])  &&
       !empty($_POST['enddate'])  &&
       !empty($_POST['description'])  &&
        !empty($_POST['institute'])  &&
        !empty($_POST['employeeEmp_id']) 
 
    )
    {
        $start_date=$_POST['start_date'];
        $enddate=$_POST['enddate'];
        $description=$_POST['description'];
        $institution=$_POST['institute'];
        $employeeEmp_id=$_POST['employeeEmp_id'];
        $M_email= $_SESSION['Memail'];
    
        try{
            
            $conn=new PDO('mysql:host=localhost:3306;dbname=h_r_m_project;','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            // This part is for retriving manager id from manager login email address
        $sqlquerystring0="SELECT * FROM department
        WHERE email='$M_email' ";
    
    ///executing the mysql code
    $returnobj=$conn->query($sqlquerystring0);
    $tabledata=$returnobj->fetchAll();
    $row=$tabledata[0];
        $managerid=$row['Manager_id'];
       
    
    // manager id saved in managerid variable

            
            //database code execute, default : warning generate
            $sqlquerystring1="INSERT INTO training VALUES('$start_date','$enddate','$description','$institute',$employeeEmp_id,
            $managerid) ";
            
            ///executing the mysql code
            $conn->exec($sqlquerystring1);
            
                ?>
                <script>location.assign('AdminTraining.php')</script>
                
            <?php
            
        }
        catch (PDOException $ex){
            ?>
                <script>location.assign('addtraining.php')</script>
            <?php
        }
    }
    else{
        //otherwise
        ?>
        <script>location.assign('addtraining.php')</script>
        <?php
    }
 }
 else{
     //we won't provide service
     echo "<script>location.assign('addtraining.php')</script>";
 }
 
    
}else{
echo "<script>location.assign('AdminLogin.php')</script>";
}
?>
