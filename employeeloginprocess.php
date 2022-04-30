<?php

if($_SERVER['REQUEST_METHOD']=="POST"){

    
    if(
        isset($_POST['eemail']) &&
        isset($_POST['epass'])  &&
        
        !empty($_POST['eemail']) &&
        !empty($_POST['epass'])
    )
    {
        $email=$_POST['eemail'];
        $pass=$_POST['epass'];
        
        try{
            $conn=new PDO('mysql:host=localhost:3306;dbname=h_r_m_project;','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sqlquerystring="SELECT Email,Password FROM employee WHERE Email='$email' and Password='$pass'";
            
            $returnobj=$conn->query($sqlquerystring);
            
            if($returnobj->rowCount()==1){
                ///login successful
                session_start();
                $_SESSION['empemail']=$email;
                
                ?>
                    <script>location.assign('employeehome.php')</script>
                <?php
            }
            else{
                ///invalid user
                ?>
                    <script>location.assign('employeelogin.php')</script>
                <?php
            }
        }
        catch (PDOException $ex){
            ?>
                <script>location.assign('employeelogin.php')</script>
            <?php
        }
    }
    else{
        //otherwise
        ?>
        <script>location.assign('employeelogin.php')</script>
        <?php
    }
}
else{
    echo "<script>location.assign('employeelogin.php')</script>";
}
?>