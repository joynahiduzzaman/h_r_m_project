<?php

session_start();
if(isset($_SESSION['Memail'])
&& !empty($_SESSION['Memail'])){

?>

    <!DOCTYPE html>
<html>
<head>
<meta charset ="utf-8">
<title>Employee salary</title>

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
    <h4>Employee salary details </h4>
    
    <table id="ptable">
    <thead>
    <tr>
    <th>Employee ID</th>
    <th>Employee name</th>
    <th>Base Salary</th>
    <th>Bonus</th>
    <th>Total Salary</th>
    <th>Add Bonus</th>
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
        <td colspan="6"> No data found </td>
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
           <td><?php // echo  $row['Salary'];?></td>
           <?php
          $empid=$row['Emp_id'];
           $sqlquerystring1="SELECT * FROM `salary_employee`
           JOIN job_scale ON salary_employee.Salary_salaryId=job_scale.salaryId
           WHERE employeeEmp_id= $empid
           ORDER BY `Receive date` DESC
           LIMIT 1;
           ";
           
           ///executing the mysql code
           $returnobj1=$conn->query($sqlquerystring1);
           
           if($returnobj1->rowCount()==0){
               // no data found
               ?>
              <td>
               <?php
               echo "0";
               ?>
               </td>
               <td>
               <?php
               echo $row['Salary'];
               ?>
               </td>
               <?php
           }
           else{
               // data found
               $tabledata1=$returnobj1->fetchAll();
               $row1=$tabledata1[0];
               ?>
              <td>
               <?php
               echo $row1['bonus'];  
               ?>
               </td>
               <td>
               <?php
               echo $row1['totalsalary'];
               ?>
               </td>
               <?php
                 
               
            }
          ?>
           <!-- -------------------------------- -->

           <td>
           <input type="button"value="Add bonus" onclick="bonusfn(<?php echo  $row['Emp_id'];?>,<?php echo $row['Salary'];?>);">
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
    
    function bonusfn(empid,salary){
        location.assign('bonus.php?empid='+empid+'&salary='+salary);
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

