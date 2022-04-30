<?php
session_start();
if(
    isset($_SESSION['empemail']) &&
    !empty($_SESSION['empemail'])
){
    $email=$_SESSION['empemail'];
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Attendance</title>
    <style>
    body{
        background-color: rgb(83, 161, 187);
        display: flex;
        justify-content: center;
        align-items:center;
        height: 100vh;
    }
    form{
        width: 500px;
        border: 2px solid #ccc;
        padding: 30px;
        background: #478484;
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
    </style>
    </head>
    <body>
    <form>
    <h2>Absent:</h2><br>
            <table id='ntable'>
                    <thead>
                        <tr>
                           <th>Month no</th>
                            <th>absent count</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    try{
                        $conn=new PDO('mysql:host=localhost:3306;dbname=h_r_m_project;','root','');
                        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                        
                        $sqlquerystring="SELECT MONTH(Date), count(*) FROM attendance WHERE P_A='absent' AND employeeEmp_id= (
                                                                                            SELECT Emp_id
                                                                                            FROM employee
                                                                                            WHERE Email= '$email'
                                                                                            )
                                        GROUP BY MONTH(Date)";
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
                                    <td><?php echo $row ['MONTH(Date)']?></td>
                                    <td><?php echo $row ['count(*)']?></td>
                                </tr>
                                <?php
                            }
                        }
                    }
                    catch(PDOExeption $ex){
                        ?>
                        <script>location.assign('employeehome.php')</script>
                      <?php
                    }
                    ?>
                    </tbody>
                </table>
                <input type="button" value="Go back" onclick="goback()";>
            </form>   
            <script>
                function goback(){
                    location.assign('employeehome.php');
                }
            </script>
    </body>
    </html>
    <?php
}
else{
    ?>
      <script>location.assign('employeelogin.php')</script>
    <?php
}
?>