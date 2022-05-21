<?php
session_start();
if(
    isset($_SESSION['adminemail']) &&
    !empty($_SESSION['adminemail'])
){
    $email=$_SESSION['adminemail'];
    ?>
       <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager info</title>
<style>
body{
    background-color:  #DAF7A6;
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
#mtable{
    width: 100%;
    border: 1px solid black;
    border-collapse: collapse;
                    
    text-align: center;
    }
                
#mtable th, #mtable td{
    border: 1px solid black;
    border-collapse: collapse;
    }
input{
    display: inline-block;
    border: 2px solid #ccc;
    padding: 10px;
    margin: 10px auto;
    border-radius: 5px;
}
input:hover{
    opacity: .7;
}
</style>
</head>
<body>
<form>
<h2>All manager:</h2><br>
        <table id='mtable'>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Dept id</th>
                        <th>phone no</th>
                        <th>update/Delete</th>

                    </tr>
                </thead>
                <tbody>
                   <?php
                   try{
                    $conn=new PDO('mysql:host=localhost:3306;dbname=h_r_m_project;','root','');
                    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                    
                
                    $sqlquerystring="SELECT Manager_id,Name,email,Dept_id,phone_no
                                     FROM department
                                     WHERE CompanyRepresentative_id = (
                                                                        SELECT Representative_id
                                                                        FROM company
                                                                        WHERE Email= '$email'
                                                                        )";
                    $returnobj=$conn->query($sqlquerystring);

                    if($returnobj->rowCount()==0){
                        ?>
                          <tr>
                            <td colspan="6">No data found</td>
                          </tr>
                        <?php
                    }
                    else{
                        $tabledata=$returnobj->fetchAll();

                        foreach($tabledata AS $row){
                            ?>
                              <tr>
                                 <td><?php echo $row ['Manager_id']?></td>
                                 <td><?php echo $row ['Name']?></td>
                                 <td><?php echo $row ['email']?></td>
                                 <td><?php echo $row ['Dept_id']?></td>
                                 <td><?php echo $row ['phone_no']?></td>
                                 <td>
                                     <input type="button" value="Update" onclick="updatem(<?php echo $row['Manager_id']; ?>);"> <br>
                                     <input type="button" value="Delete" onclick="deletem(<?php echo $row['Manager_id']; ?>);">
                                 </td>
                              </tr>
                            <?php
                        }
                    }
                   }
                   catch(PDOExeption $ex){
                        ?>
                           <tr>
                              <td colspan="6">No data found</td>
                           </tr>
                        <?php
                   }
                   ?>
                </tbody>
            </table>
            <input type="button" value="Go back" onclick="goback()";>
         </form>   
        <script>
            function updatem(mid){
                location.assign('updatemanager.php?manid='+mid);
            }

            function deletem(mid){
                location.assign('deletemanager.php?manid='+mid);
            }

            function goback(){
                location.assign('home.php');
            }
        </script>
</body>
</html>
    <?php
}
else{
    ?>
      <script>location.assign('login.php')</script>
    <?php
}
?>