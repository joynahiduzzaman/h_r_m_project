<?php

session_start();
if(isset($_SESSION['Memail'])
&& !empty($_SESSION['Memail'])){
// -------------------------------------------
if($_SERVER['REQUEST_METHOD']=="POST"){
    
        ///tries to communicate with the database and store the data
       
        try{

            foreach($_POST AS $k=>$v){
                echo $k;
                echo $v;
             
            $conn=new PDO('mysql:host=localhost:3306;dbname=h_r_m_project;','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
            $sqlquerystring1="SELECT *
            FROM employee
            WHERE Emp_id=$k;
               ";
               
               ///executing the mysql code
               $returnobj1=$conn->query($sqlquerystring1);
               
               
                   $tabledata1=$returnobj1->fetchAll();
                   $row1=$tabledata1[0];
                   
                    echo $row1['DepartmentManager_id'];   
                    $M_id= $row1['DepartmentManager_id']; 
                
            //database code execute, default : warning generate
            $sqlquerystring=" INSERT INTO attendance VALUES(CURDATE(),'09:00:00','05:00:00','$v',$M_id,$k)";
            
            ///executing the mysql code
            $conn->exec($sqlquerystring);
            ?>
                    <script>location.assign('AdminHome.php')</script>
                <?php
            }
            
        }
        catch (PDOException $ex){
            ?>
                <script>location.assign('AdminAttendance.php')</script>
            <?php
        }

        
    
    
       
       
}
else{
    //we won't provide service
    echo "<script>location.assign('AdminAttendance.php')</script>";
}
// ----------------------------------------------


}
else{
    //we won't provide service
    echo "<script>location.assign('AdminHome.php')</script>";
}
?>
