<?php

session_start();
if(isset($_SESSION['Memail'])
&& !empty($_SESSION['Memail'])){

 
 if($_SERVER['REQUEST_METHOD']=="POST"){
     
     //empty value check, valid index check
     if(
        isset($_POST['empid']) &&
        isset($_POST['salary'])  &&
        isset($_POST['bonus'])  &&
        
        !empty($_POST['empid']) &&
        !empty($_POST['salary'])&&
        !empty($_POST['bonus']) 
    )
    {
       $empid=$_POST['empid'];
       $salary=$_POST['salary'];
       $bonus=$_POST['bonus'];
       $M_email= $_SESSION['Memail'];
        ///tries to communicate with the database and store the data
        
        
        try{
            
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

            
            //database code execute, default : warning generate
            $sqlquerystring1="INSERT INTO job_scale VALUES('NULL',($salary+$salary*$bonus/100),$bonus,$managerid) ";
            
            ///executing the mysql code
            $conn->exec($sqlquerystring1);
            // --------------------------------------------------------------
             $sqlquerystring2="SELECT * FROM `job_scale`
             ORDER BY salaryId DESC
             LIMIT 1";
            
            ///executing the mysql code
            $returnobj=$conn->query($sqlquerystring2);
            $tabledata=$returnobj->fetchAll();
            foreach($tabledata AS $row){
                $salaryid=$row['salaryId'];
            }
            //----------------------------------------------------------------
                $sqlquerystring3="INSERT INTO salary_employee VALUES($salaryid,$empid,NOW()) ";
            
                ///executing the mysql code
                $conn->exec($sqlquerystring3);
                
                ?>
                <script>location.assign('salary.php')</script>
                
            <?php
            
        }
        catch (PDOException $ex){
            ?>
                <script>location.assign('bonus.php')</script>
            <?php
        }
    }
    else{
        //otherwise
        ?>
        <script>location.assign('bonus.php')</script>
        <?php
    }
 }
 else{
     //we won't provide service
     echo "<script>location.assign('bonus.php')</script>";
 }
 
    
}else{
echo "<script>location.assign('AdminLogin.php')</script>";
}
?>
