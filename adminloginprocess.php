<?php

if($_SERVER['REQUEST_METHOD']=="POST"){

    
    if(
        isset($_POST['uemail']) &&
        isset($_POST['upass'])  &&
        
        !empty($_POST['uemail']) &&
        !empty($_POST['upass'])
    )
    {
        $email=$_POST['uemail'];
        $pass=$_POST['upass'];
        $enc_pass=md5($pass);
        
        try{
            $conn=new PDO('mysql:host=localhost:3306;dbname=h_r_m_project;','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sqlquerystring="SELECT Email,password FROM company WHERE Email='$email' and password='$enc_pass'";
            
            $returnobj=$conn->query($sqlquerystring);
            
            if($returnobj->rowCount()==1){
                ///login successful
                session_start();
                $_SESSION['adminemail']=$email;
                
                ?>
                    <script>location.assign('home.php')</script>
                <?php
            }
            else{
                ///invalid user
                ?>
                    <script>location.assign('login.php')</script>
                <?php
            }
        }
        catch (PDOException $ex){
            ?>
                <script>location.assign('login.php')</script>
            <?php
        }
    }
    else{
        //otherwise
        ?>
        <script>location.assign('login.php')</script>
        <?php
    }
}
else{
    echo "<script>location.assign('login.php')</script>";
}
?>