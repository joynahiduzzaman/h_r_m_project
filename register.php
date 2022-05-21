<?php
if(
    isset($_GET['packageid']) &&
    !empty($_GET['packageid'])
){
    $packageid=$_GET['packageid'];

    try{
        $conn=new PDO('mysql:host=localhost:3306;dbname=h_r_m_project;','root','');
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        
        $sqlquerystring="SELECT Price FROM package WHERE Package_id='$packageid'";
        $returnobj=$conn->query($sqlquerystring);
        $tabledata=$returnobj->fetchAll();
        foreach($tabledata AS $row){
            $price=$row ['Price'];
        }
        
    }
    catch (PDOException $ex){
        ?>
            <script>location.assign('employeehome.php')</script>
        <?php
    }
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Registration Page</title>
            <style>
            body{
                background-color: #DAF7A6;
                
                justify-content: center;
                align-items:center;
                height: 100vh;
            }
            .container{
                max-width: 90%;
                background-color: white;
                padding: 35px;
                margin: auto;
            }
            .container h2{
                    text-align: center;

            }
            input{
                display: block;
                border: 1px solid black;
                border-radius: 5px;
                font-size: 12px;
                width: 60%;
                margin: 6px 0px;
                padding: 11px;
            }
            .btn{
                margin: 7px;

            }
            button:hover{
                opacity: .7;
            }
            input:hover{
                opacity: .7;
            }
            </style>
        </head>
        <body>
            <div class="container">
            <h2>This is the Registration page</h2>
            <br> 
            <h3>Enter your information here: </h3>
            <form action="registerprocess.php" method="POST">
                <input type="text" name="cname" id="cname" placeholder="Enter company name">
                <input type="text" name="cemail" id="cemail" placeholder="Enter company email">
                <input type="password" name="pass" id="pass" placeholder="Enter your password">
                <input type="text" name="crdt" id="crdt" placeholder="Enter credit card no">
                <input type="number" name="pid" id="pid" value="<?php echo $packageid ?>">
                <input type="text" name="price" id="price" value="<?php echo $price ?>">
                <input type="date" name="strdate" id="strdate" placeholder="Enter start date">
                <input type="date" name="enddate" id="enddate" placeholder="Enter start date">
                <button class="btn">Submit</button>

            </form>
            </div>
        </body>
        </html>
        <?php
}
else{
    ?>
       <script>location.assign('package.php')</script>
    <?php
}
?>