<?php

session_start();
if(isset($_SESSION['Memail'])
&& !empty($_SESSION['Memail'])){

?>

    <!DOCTYPE html>
<html>
<head>
<meta charset ="utf-8">
<title>Rewards</title>

<style>
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
    <h4>Allocate Rewards </h4>
    
    <table id="ptable">
    <thead>
    <tr>
    <th>Employee ID</th>
    <th>Employee name</th>
    <th>Title</th>
    <th>Description</th>
    <th>Receiving Date</th>
    <th>Reward amount</th>
    <th>Add rewards</th>
  </tr>

    </thead>
  
<tbody> 
<?php

// access database code

try{
    
    //echo $_SESSION['Memail']; for viewing dept email
    $Memail=$_SESSION['Memail'];
    
    $conn=new PDO('mysql:host=localhost:3306;dbname=h_r_m_project;','root','');
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
    //database code execute, default : warning generate
    $sqlquerystring="SELECT * FROM `employee`
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
            ?>

           <tr>
           <td><?php echo  $row['Emp_id'];?></td>
           <td><?php echo  $row['Name'];?></td>
           <?php
          $empid=$row['Emp_id'];
           $sqlquerystring1="SELECT * FROM reward
           JOIN employee ON reward.employeeEmp_id=employee.Emp_id
           WHERE employeeEmp_id=$empid
           ORDER BY Receivedate DESC
           LIMIT 1;
           ";
        
           $date = date('Y-m-d');
          
           ///executing the mysql code
           $returnobj1=$conn->query($sqlquerystring1);
           
           if($returnobj1->rowCount()==0){
               // no data found
               ?>
              <td><?php echo "No Reward";?></td>
               <td><?php echo "No Reward";?></td>
               <td><?php echo "0";?></td>
               <td><?php echo $date;?></td>
               <?php
               
           }
           else{
               // data found
               $tabledata1=$returnobj1->fetchAll();
               $row1=$tabledata1[0];
               ?>
              <td style="width:300px"><?php echo $row1['Title'];  ?></td>
               <td><?php echo $row1['description'];?></td>
               <td><?php echo $row1['Receivedate'];?></td>
               <td><?php echo $row1['amount'];?></td>
               <?php
                 
               
            }
          ?>
           
           <td>
           <input type="button"value="Allocate Reward" onclick="trainingfn(<?php echo  $row['Emp_id'];?>);">
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
    <td colspan="6">No data found </td>
    </tr>
    <?php
}

?>
</tbody>

</table>
<br><br>
<input type="button"  value="Back To Home" onclick="backfn();">
    <script>
    
    function trainingfn(empid){
        location.assign('addreward.php?empid='+empid);
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

