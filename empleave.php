<?php

session_start();
if(isset($_SESSION['Memail'])
&& !empty($_SESSION['Memail'])){

?>

    <!DOCTYPE html>
<html>
<head>
<meta charset ="utf-8">
<title>view employee</title>

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
    <form >
    <h4>Employee Leave </h4>
    
    <table id="ptable">
    <thead>
    <tr>
    <th>Employee ID</th>
    <th>Start date</th>
    <th>End date</th>
    <th>Duration</th>
    <th>Reason</th>
    <th>Station leave</th>
    <th>Approval Status</th>
  </tr>

    </thead>
  
<tbody> 
</form>
<?php

// access database code

try{
    
    //echo $_SESSION['Memail']; for viewing dept email
    $Memail=$_SESSION['Memail'];
    
    $conn=new PDO('mysql:host=localhost:3306;dbname=h_r_m_project;','root','');
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
    //database code execute, default : warning generate
    $sqlquerystring="SELECT *,DATEDIFF(enddate,startdate) AS 'duration'
    FROM emp_leave
    WHERE DepartmentManager_id=(
    SELECT Manager_id
        FROM department
        WHERE email='$Memail'
    )
    ";
    
    ///executing the mysql code
    $returnobj=$conn->query($sqlquerystring);
    
    if($returnobj->rowCount()==0){
        // no data found
        ?>
    <tr>
    <td colspan="7"> No data found </td>
    </tr>
       <?php 
    }
    else{
        // data found
        $tabledata=$returnobj->fetchAll();
        foreach($tabledata AS $row){
           $date1=strtotime($row['startdate']);
           $date2=strtotime($row['enddate']);
            $diff=ceil(abs($date1 - $date2) / 86400);
            ?>

           <tr>
           <td><?php echo  $row['employeeEmp_id'];?></td>
           <td><?php echo  $row['startdate'];?></td>
           <td><?php echo  $row['enddate'];?></td>
           <td><?php echo  $diff;?></td>
           <td><?php echo  $row['reason'];?></td>
           <td><?php echo  $row['stationleave'];?><br>
           <input type="button"value="Yes" onclick="stationleaveyesfn(<?php echo  $row['employeeEmp_id'];?>);">
           <input type="button"value="No" onclick="stationleavenofn(<?php echo  $row['employeeEmp_id'];?>);">
           </td>
           <td><?php// echo  $row['approvalstatus'];?><br>
           <input type="button"value="Yes" onclick="approvalyesfn(<?php echo  $row['employeeEmp_id'];?>);">
           <input type="button"value="No" onclick="approvalnofn(<?php echo  $row['employeeEmp_id'];?>);">
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
    <td colspan="7">No data found </td>
    </tr>
    <?php
}

?>
</tbody>

</table>
<br><br>
<input type="button"  value="Back To Home" onclick="backfn();">
    <script>
    function stationleaveyesfn(empid){
        location.assign('stationleaveyes.php?empid='+empid);
    }
    function stationleavenofn(empid){
        location.assign('stationleaveno.php?empid='+empid);
    }
    function approvalyesfn(empid){
        location.assign('approvalstatusyes.php?empid='+empid);
    }
    function approvalnofn(empid){
        location.assign('approvalstatusno.php?empid='+empid);
    }
    function backfn(){
        location.assign('AdminHome.php');
    }

    </script>
</body>
</html>

<?php

}else{
echo "<script>location.assign('AdminLogin.php')</script>";
}
?>

