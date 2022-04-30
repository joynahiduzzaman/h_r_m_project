<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package form</title>
    <style>
        *{
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }
        body{
            background: #DAF7A6;
        }
        .container{
           max-width: 90%;
           max-height: 100%;
           
           margin: auto;
        }
        .container h1,p,h3{
            text-align: center;

        }
        p{
            background-color: white;
            color: red;
            padding: 10px;
        }
        #ptable{
            width: 70%;
            border: 1px solid rgb(0, 0, 0);
            border-collapse: collapse;
            text-align: center;
            margin: auto;
        }
        
        #ptable th, #ptable td{
            border: 1px solid rgb(0, 0, 0);
            border-collapse: collapse;
        }
        
        #ptable tr:hover{
            background-color: lightgrey;
        }
    
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome to HR management sytem</h1>
        <br>
        <br>
        <p>HR software plays a key role in human resource planning and development function.
           Our HR management software is a software built for small and medium sized business
           which helps an organization to track their daily activities. As you know, time is more precious than gold.
           Here, we ensure best use of your time. Our software is really a profitable investment of your time.
        </p>
        <br>
        <br>
        <h3>Choose any desired package from bellow</h3>
        <br>
        <br><br>
    <table id="ptable">
        <thead>
            <tr>
                <th>Package Id</th>
                <th>Price($)</th>
                <th>Features</th>
                <th>Subscription</th>
            </tr>
        </thead>
        <tbody>
            <?php
             try{
                $conn=new PDO('mysql:host=localhost:3306;dbname=h_r_m_project;','root','');
                $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                //database code execute, default : warning generate
                $sqlquerystring="SELECT * FROM package";
                $returnobj=$conn->query($sqlquerystring); 
                 
                if($returnobj->rowCount()==0){
                    ///no data found
                     ?>
                        <tr>
                            <td colspan="6">No data found</td>
                        </tr>
                    <?php
                } 
                else{
                    ///package data found
                    $tabledata=$returnobj->fetchAll();
                    
                    foreach($tabledata AS $row){
                        
                        ?>
                         <tr>
                            <td><?php echo $row['Package_id']; ?></td>
                            <td><?php echo $row['Price']; ?></td>
                            <td><?php echo $row['Features']; ?></td>
                            <td>
                                <input type="button" value="Purchase" onclick="purchasefn(<?php echo $row['Package_id']; ?>);">
                             </td>
                        </tr>
                        <?php
                        
                    }
                    
                }
            }
            catch (PDOException $ex){
                ?>
                    <tr>
                        <td colspan="6">No data found</td>
                    </tr>
                <?php
            }
            
            ?>
            
        </tbody>
    </table>
    <script>
        function purchasefn(pid){
                    location.assign('register.php?packageid='+pid); 
                }
    </script>
    </div>
</body>
</html>