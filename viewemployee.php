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
    form{
        width: 500px;
        border: 2px solid #ccc;
        padding: 30px;
        background: white;
        border-radius: 15px;
        }    
    #ntable{
        width: 100%;
        border: 1px solid black;
        border-collapse: collapse;
                        
        text-align: center;
        }
                    
    #ntable th, #ntable td{
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


<form>

    <h4>Employee details </h4>
    <br>
    
    <table id="ptable">
    <thead>
    <tr>
    <th>Employee ID</th>
    <th>Employee name</th>
    <th>Email</th>
    <!-- <th>Password</th> -->
    <th>Address</th>
    <th>Department ID</th>
    <th>Phone No</th>
    
    <th>Manager ID</th>
   
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
    <td colspan="11"> No data found </td>
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
           <td><?php echo  $row['Email'];?></td>
           <!-- <td><?php echo  $row['Password'];?></td> -->
           <td><?php echo  $row['Address'];?></td>
           <td><?php echo  $row['Dept id'];?></td>
           <td><?php echo  $row['Phone no'];?></td>
          
           <td><?php echo  $row["DepartmentManager_id"];?></td>
           
           </tr>
          
           <?php

             $_SESSION["managerid"]=$row["DepartmentManager_id"];
        }
        
    }
}
catch (PDOException $ex){
    // no data found
    ?>
    <tr>
    <td colspan="11">No data found </td>
    </tr>
    <?php
}

?>
</tbody>

</table>
<br><br>
<input type="button"  value="Back To Home" onclick="backfn();">
</form>
    <script>
    
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

