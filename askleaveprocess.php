<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(
        isset($_POST['eid']) &&
        isset($_POST['strdate']) &&
        isset($_POST['enddate']) &&
        isset($_POST['reason']) &&
        isset($_POST['sl']) &&
        isset($_POST['Deptmentmanage_id']) &&
        
        !empty($_POST['eid']) &&
        !empty($_POST['strdate']) &&
        !empty($_POST['enddate']) &&
        !empty($_POST['reason']) &&
        !empty($_POST['sl']) &&
        !empty($_POST['Deptmentmanage_id']) 
    )
    {
        $empid=$_POST['eid'];
        $strdate=$_POST['strdate'];
        $enddate=$_POST['enddate'];
        $reason=$_POST['reason'];
        $stationleave=$_POST['sl'];
        $Departmentmanager_id=$_POST['Deptmentmanage_id'];
        
        try{
            $conn= new PDO('mysql:host=localhost:3306;dbname=h_r_m_project','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sqlquerystring="INSERT INTO emp_leave (Token,startdate,enddate,reason,stationleave,employeeEmp_id,Departmentmanager_id) VALUES(NULL,'$strdate','$enddate','$reason','$stationleave','$empid','$Departmentmanager_id')";

            $conn->exec($sqlquerystring);

            ?>
              <script>location.assign('employeehome.php')</script>
            <?php
        }
        catch(PDOException $ex){
            ?>
                <script>location.assign('askleave.php')</script>
            <?php
        }
    }
    else{
        ?>
            <script>location.assign('askleave.php')</script>
        <?php
    }
}
else{
    ?>
     <script>location.assign('askleave.php')</script>;
     <?php
}
?>