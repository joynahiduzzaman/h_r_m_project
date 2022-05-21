<?php

session_start();
if(isset($_SESSION['Memail'])
&& !empty($_SESSION['Memail'])){


    if(isset($_GET['empid']) &&
        !empty($_GET['empid'])
        ){
            $Empid=$_GET['empid'];
            try{
                
                $conn=new PDO('mysql:host=localhost:3306;dbname=h_r_m_project;','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
                
                //database code execute, default : warning generate
                $sqlquerystring =" UPDATE emp_leave SET stationleave='YES' WHERE employeeEmp_id=$Empid  ";
                
                ///executing the mysql code
                $conn->exec($sqlquerystring);
                ?>
                        <script>location.assign('empleave.php')</script>
                    <?php
                
                ?>
                        <script>location.assign('empleave.php')</script>
                    <?php
                
            }
            catch (PDOException $ex){
                ?>
                    <script>location.assign('empleave.php')</script>
                <?php
            }
        }
        else{
            echo "<script>location.assign('empleave.php')</script>" ;
        }


}else{
echo "<script>location.assign('AdminLogin.php')</script>";
}
?>
