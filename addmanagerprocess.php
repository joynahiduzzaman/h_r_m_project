<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(
        isset($_POST['mname']) &&
        isset($_POST['memail']) &&
        isset($_POST['pass']) &&
        isset($_POST['deptid']) &&
        isset($_POST['mnum']) &&
        isset($_POST['rep']) &&
        
        !empty($_POST['mname']) &&
        !empty($_POST['memail']) &&
        !empty($_POST['pass']) &&
        !empty($_POST['deptid']) &&
        !empty($_POST['mnum']) &&
        !empty($_POST['rep'])  
    )
    {
        $name=$_POST['mname'];
        $email=$_POST['memail'];
        $pass=$_POST['pass'];
        //$encpass=md5($pass);
        $deptid=$_POST['deptid'];
        $number=$_POST['mnum'];
        $repid=$_POST['rep'];

        try{
            $conn= new PDO('mysql:host=localhost:3306;dbname=h_r_m_project','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sqlquerystring="INSERT INTO department VALUES(NULL,'$name','$email','$pass','$deptid','$number','$repid')";

            $conn->exec($sqlquerystring);

            ?>
              <script>location.assign('home.php')</script>
            <?php
        }
        catch(PDOException $ex){
            ?>
                <script>location.assign('addmanager.php')</script>
            <?php
        }
    }
    else{
        ?>
            <script>location.assign('addmanager.php')</script>
        <?php
    }
}
else{
    ?>
     <script>location.assign('addmanager.php')</script>;
     <?php
}
?>