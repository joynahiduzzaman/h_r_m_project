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

    <h4>Complains </h4>
    
    <table id="ptable">
    <thead>
    <tr>
    <th>Employee ID</th>
    <th>Description</th>
    <th>Date</th>
    <th>employeeEmp_id</th>
   
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
    $sqlquerystring="SELECT * FROM `complain`
    JOIN employee ON complain.employeeEmp_id=employee.Emp_id
    WHERE employee.DepartmentManager_id=(
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
           <td><?php echo  $row['Id'];?></td>
           <td><?php echo  $row['Description'];?></td>
           <td><?php echo  $row['date'];?></td>
           
           <td><?php echo  $row['employeeEmp_id'];?></td>
           
           
           

           <!-- this part is for showing comment -->
           <td>
          
          <?php
          $ID=$row['Id'];
           $sqlquerystring1="SELECT * FROM complain 
           JOIN comment_on ON complain.Id=comment_on.ComplainId
           WHERE complain.Id=$ID;
           ";
           
           ///executing the mysql code
           $returnobj1=$conn->query($sqlquerystring1);
           
           if($returnobj1->rowCount()==0){
               // no data found
               echo "No comment";
           }
           else{
               // data found
               $tabledata1=$returnobj1->fetchAll();
               foreach($tabledata1 AS $row){
                echo $row['comment'];   
               }
            }
          ?>

           </td> 
           <!-- ----------------------this is the end line----------------------------- -->
           <td>
           <input type="button"value="Comment" onclick="commentfn(<?php echo  $row['DepartmentManager_id'];?>,
           <?php echo  $row['Id'];?>);">
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
    function commentfn(managerid,complainid){
        location.assign('comment.php?managerid='+managerid+'&complainid='+complainid);
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

