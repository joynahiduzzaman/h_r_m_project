<?php

session_start();
if(isset($_SESSION['Memail'])
&& !empty($_SESSION['Memail'])){

    if(isset($_GET['empid']) &&
        !empty($_GET['empid'])
        )
        
        {
            $Empid=$_GET['empid'];
            
            ?>

    <!DOCTYPE html>
<html>
<head>
<meta charset ="utf-8">
<title>ADD Training </title>
</head>
<body>
    <h4>ADD Training</h4>
    <form action="AdminTrainingProcess.php" method="POST">
    <label for="empid">Employee ID : </label>
    <input type="text" id="empid" name="empid" value="<?php echo "$Empid"?>" readonly>
    <br><br>
    <label for="CourseName">Course Name : </label>
    <input type="text" id="CourseName" name="CourseName">
    <br><br>
    <label for="institution">Institution Name : </label>
    <input type="text" id="institution" name="institution" >
    <br><br>
    <label for="description">Course description: </label>
    <textarea name="description" id="description" cols="30" rows="10"></textarea>
    <br><br>
    <label for="startdate">Starting date : </label>
    <input type="date" id="startdate" name="startdate" >
    <br><br>
    <label for="enddate">Ending date : </label>
    <input type="date" id="enddate" name="enddate" >
    <br><br>
    <label for="totalclass">Total Class : </label>
    <input type="number" id="totalclass" name="totalclass" >
    <br><br>
    <input type="submit" value="Save">
    
    </form>
</body>
</html>

<?php
            
        }
        else{
            echo "<script>location.assign('AdminTraining.php')</script>" ; //problem???
        }

  
}else{
echo "<script>location.assign('AdminLogin.php')</script>";
}
?>
