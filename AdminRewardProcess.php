<?php

session_start();
if(isset($_SESSION['Memail'])
&& !empty($_SESSION['Memail'])){

 
 if($_SERVER['REQUEST_METHOD']=="POST"){
     
     //empty value check, valid index check
     if(
        isset($_POST['empid']) &&
        isset($_POST['title'])  &&
        isset($_POST['description'])  &&
        isset($_POST['amount'])  &&
        !empty($_POST['empid']) &&
        !empty($_POST['title'])  &&
        !empty($_POST['description'])  &&
        !empty($_POST['amount'])   
    )
    {
            $empid=$_POST['empid'];
            $title=$_POST['title'];
            $description=$_POST['description'];
            $amount=$_POST['amount']  ;
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
            $sqlquerystring1="INSERT INTO reward VALUES('$title','$description',$amount,$empid,$managerid,CURDATE()) ";
            
            ///executing the mysql code
            $conn->exec($sqlquerystring1);
            
                ?>
                <script>location.assign('AdminReward.php')</script>
                
            <?php
            
        }
        catch (PDOException $ex){
            ?>
                <script>location.assign('addreward.php')</script>
            <?php
        }
    }
    else{
        //otherwise
        ?>
        <script>location.assign('addreward.php')</script>
        <?php
    }
 }
 else{
     //we won't provide service
     echo "<script>location.assign('addreward.php')</script>";
 }
 
    
}else{
echo "<script>location.assign('AdminLogin.php')</script>";
}
?>
