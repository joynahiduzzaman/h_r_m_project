<?php

if($_SERVER['REQUEST_METHOD']=="POST"){
    
    //empty value check, valid index check
    
    if(
        isset($_POST['Memail']) &&
        isset($_POST['Mpassword'])  &&
        
        !empty($_POST['Memail']) &&
        !empty($_POST['Mpassword'])
    )
    {
        $email=$_POST['Memail'];
        $pass=$_POST['Mpassword'];

        //session_start();
       // $_SESSION['Memail']=$email;
        //$enc_pass=md5($pass);
        
        ///tries to communicate with the database and store the data
        
        try{
            $conn=new PDO('mysql:host=localhost:3306;dbname=h_r_m_project;','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sqlquerystring="SELECT email,password FROM department WHERE email='$email' and password='$pass'";
            
            $returnobj=$conn->query($sqlquerystring);
            
            if($returnobj->rowCount()==1){
                ///login successful
                session_start();
                $_SESSION['Memail']=$email;
                
                ?>
                    <script>location.assign('AdminHome.php')</script>
                <?php
            }
            else{
                ///invalid user
                ?>
                    <script>location.assign('AdminLogin.php')</script>
                <?php
            }
        }
        catch (PDOException $ex){
            ?>
                <script>location.assign('dytdtyfu.php')</script>
            <?php
        }
    }
    else{
        //otherwise
        ?>
        <script>location.assign('AdminLogin.php')</script>
        <?php
    }
}
else{
    //we won't provide service
    echo "<script>location.assign('AdminLogin.php')</script>";
}
?>