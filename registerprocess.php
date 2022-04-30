<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(
        isset($_POST['cname']) &&
        isset($_POST['cemail']) &&
        isset($_POST['pass']) &&
        isset($_POST['crdt']) &&
        isset($_POST['pid']) &&
        isset($_POST['price']) &&
        isset($_POST['strdate']) &&
        isset($_POST['enddate']) &&
        
        !empty($_POST['cname']) &&
        !empty($_POST['cemail']) &&
        !empty($_POST['pass']) &&
        !empty($_POST['crdt']) &&
        !empty($_POST['pid']) &&
        !empty($_POST['price']) &&
        !empty($_POST['strdate']) &&
        !empty($_POST['enddate']) 
    )
    {
        $name=$_POST['cname'];
        $email=$_POST['cemail'];
        $pass=$_POST['pass'];
        $encpass=md5($pass);
        $credtNo=$_POST['crdt'];
        $packageId=$_POST['pid'];
        $price=$_POST['price'];
        $startdate=$_POST['strdate'];
        $enddate=$_POST['enddate'];

        try{
            $conn= new PDO('mysql:host=localhost:3306;dbname=h_r_m_project','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sqlquerystring="INSERT INTO company VALUES(NULL,'$name','$email','$encpass','$price','$startdate','$enddate','$credtNo','$packageId')";

            $conn->exec($sqlquerystring);

            ?>
              <script>location.assign("login.php")</script>
            <?php
        }
        catch(PDOException $ex){
            ?>
                <script>location.assign(register.php)</script>
            <?php
        }
    }
    else{
        ?>
            <script>location.assign(register.php)</script>
        <?php
    }
}
else{
    echo "<script>location.assign('register.php')</script>";
}
?>