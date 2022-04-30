<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(
        isset($_POST['manid']) &&
        isset($_POST['mname']) &&
        isset($_POST['memail']) &&
        isset($_POST['deptid']) &&
        isset($_POST['mnum']) &&
        
        !empty($_POST['manid']) &&
        !empty($_POST['mname']) &&
        !empty($_POST['memail']) &&
        !empty($_POST['deptid']) &&
        !empty($_POST['mnum'])  
    )
    {
        $manid=$_POST['manid'];
        $name=$_POST['mname'];
        $email=$_POST['memail'];
        $deptid=$_POST['deptid'];
        $number=$_POST['mnum'];

        try{
            $conn= new PDO('mysql:host=localhost:3306;dbname=h_r_m_project','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sqlquerystring="UPDATE department
                             SET Name='$name', email='$email', Dept_id='$deptid', phone_no='$number'
                             WHERE Manager_Id=$manid";

            $conn->exec($sqlquerystring);

            ?>
              <script>location.assign('home.php')</script>
            <?php
        }
        catch(PDOException $ex){
            ?>
                <script>location.assign('updatemanager.php')</script>
            <?php
        }
    }
    else{
        ?>
            <script>location.assign('updatemanager.php')</script>
        <?php
    }
}
else{
    ?>
     <script>location.assign('updatemanager.php')</script>;
     <?php
}
?>