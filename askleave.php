<?php
session_start();

if(
        isset($_SESSION['empemail'])
    &&  !empty($_SESSION['empemail'])
){
    $email=$_SESSION['empemail'];
    try{
        $conn=new PDO('mysql:host=localhost:3306;dbname=h_r_m_project;','root','');
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        
        $sqlquerystring="SELECT Emp_id,Departmentmanager_id FROM employee WHERE Email='$email'";
        $returnobj=$conn->query($sqlquerystring);
        $tabledata=$returnobj->fetchAll();
        foreach($tabledata AS $row){
            $empid=$row ['Emp_id'];
            $manid=$row ['Departmentmanager_id'];
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
            <title>Leave Ask</title>
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
            </style>
        </head>
        <body>
            <form action="askleaveprocess.php" method="POST">
                <h2>Ask for leave</h2>
                <br> 
                <h3>Enter your information: </h3>
                <label for="eid">Employee id: </label>
                <input type="text" name="eid" id="eid" value="<?php echo $empid ?>">
                <label for="strdate">Start date: </label>
                <input type="date" name="strdate" id="strdate" placeholder="Input start date">
                <label for="enddate">End date: </label>
                <input type="date" name="enddate" id="enddate" placeholder="Enter end date">
                <label for="reason">Reason for leave: </label>
                <input type="text" name="reason" id="reason" placeholder="Write your reason for leave">
                <label for="sl">Station leave: </label>
                <input type="text" name="sl" id="sl" placeholder="Input only Yes or No">
                <label for="Deptmentmanage_id">Enter manager id: </label>
                <input type="number" name="Deptmentmanage_id" id="Deptmentmanage_id" placeholder="Departmentmanager_id">
                <button class="btn">Enter</button>

            </form>
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