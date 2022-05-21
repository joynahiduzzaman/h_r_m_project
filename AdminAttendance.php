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
    $deptid=$row['DepartmentId'];
}
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
<title>AttendanceList </title>

</head>
<body>
    <?php
     $date = date('Y-m-d');
    ?>

    
     <form>
    <!--<label for="empid">Employee ID : </label>
    <input type="text" id="empid" name="empid" placeholder="Employee ID " >
    <br><br>
    <label for="M_id">Manager ID : </label>
    <input type="text" id="M_id" name="M_id" value="<?php echo "$managerid"?>">
    <br><br> -->
    <label for="date">Date : </label>
    <input type="date" id="date" name="date" value=<?php echo  $date;?> readonly>
    <!-- <br><br>
    <label for="starttime">Starting time : </label>
    <input type="time" id="starttime" name="starttime" >
    <br><br>
    <label for="endtime">Ending time : </label>
    <input type="time" id="endtime" name="endtime" >
    <br><br>
    <input type="submit" value="Submit"> -->
    </form>
</body>
</html>

<?php

// second part starts from here which is showing attendances details

?>

    <!DOCTYPE html>
<html>
<head>
<meta charset ="utf-8">
<title>view attendance details</title>

<style>
     body{
        background-color: #DAF7A6;
        
        justify-content: center;
        align-items:center;
        height: 100vh;
    }
    form{
        width: 500px;
        border: 2px solid #ccc;
        padding: 30px;
        background: white;
        border-radius: 15px;
        }    
    #ptable{
        width: 100%;
        border: 1px solid black;
        border-collapse: collapse;
                        
        text-align: center;
        }
                    
    #ptable th, #ptable td{
        border: 1px solid black;
        border-collapse: collapse;
        }
    input{
        display: inline-block;
        border: 2px solid #ccc;
        width: 50%;
        padding: 10px;
        margin: 10px auto;
        border-radius: 5px;
    }
    input:hover{
        opacity: .7;
    }
                #ptable{
                    width: 100%;
                    border: 1px solid blue;
                    border-collapse: collapse;
                    
                    text-align: center;
                }
                
                #ptable th, #ptable td{
                    border: 1px solid blue;
                    border-collapse: collapse;
                }
                
                #ptable tr:hover{
                    background-color: cadetblue;
                }
            </style>
</head>
<body>
   

    <form action="AdminAttendanceProcess.php" method="POST"> 
    <h4>Attendance List </h4>
    <table id="ptable">
    <thead>
    <tr>
    <th>Employee ID</th>
    <th>Employee name</th>
    <th>Starting time</th>
    <th>Ending time</th>
    <th>P/A</th>
    
  </tr>

    </thead>
  
<tbody>

<?php

// access database code

try{

    $conn=new PDO('mysql:host=localhost:3306;dbname=h_r_m_project;','root','');
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
    //database code execute, default : warning generate
     
    $Memail=$_SESSION['Memail'];
    $sqlquerystring="SELECT *
    FROM employee -- LEFT JOIN attendance ON employee.Emp_id=attendance.employeeEmp_id
    WHERE employee.DepartmentManager_id=(
    SELECT Manager_id
        FROM department
        WHERE email='$Memail'
    )";
    
    ///executing the mysql code
    $returnobj=$conn->query($sqlquerystring);
    
    if($returnobj->rowCount()==0){
        // no data found
        ?>
    <tr>
    <td colspan="5"> No data found </td>
    </tr>
       <?php 
    }
    else{
        // data found
        $tabledata=$returnobj->fetchAll();
        
        foreach($tabledata AS $row){
            ?>

           <tr>
           <td><?php echo  $row['Emp_id'];?></td>
           <td><?php echo  $row['Name'];?></td>
           <td><?php echo  '09:00:00'?></td>
           <td><?php echo  '05:00:00'?></td>
           <td>
            <input type="radio" id="present" name="<?php echo  $row['Emp_id']; ?>" value="present" checked>
            <label for="present">Present</label>
            <input type="radio" id="absent" name="<?php echo  $row['Emp_id']; ?>" value="Absent">
            <label for="absent">Absent</label>
           </td>
           </tr>

           <?php
        }
        
    }
}
catch (PDOException $ex){
    // no data found
    ?>
    <tr>
    <td colspan="5">No data found </td>
    </tr>
    <?php
}

?>


 
</tbody>




</table>
<br><br>
<input type="submit" value="Save" >
<br><br>
<input type="button"  value="Back To Home" onclick="backfn();">
    <script>
    function backfn(){
        location.assign('AdminHome.php');
    }
    
    </script>
    </form>
</body>
</html>

<?php
}else{
echo "<script>location.assign('AdminLogin.php')</script>";
}
?>

