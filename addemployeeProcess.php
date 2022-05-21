<?php

session_start();
if(isset($_SESSION['Memail'])
&& !empty($_SESSION['Memail'])){
?>

   /// copied code from AdminLoginProcess.php

   <?php

if($_SERVER['REQUEST_METHOD']=="POST"){
    
    //empty value check, valid index check
    
    if(
        isset($_POST['email']) &&
        isset($_POST['name']) &&
        isset($_POST['password']) &&
        isset($_POST['adr']) &&
        isset($_POST['d_id']) &&
        isset($_POST['M_id'])  &&
        isset($_POST['p_no'])  &&
        //isset($_POST['jobposition'])  &&
       // isset($_POST['joiningdate'])  &&
       // isset($_POST['salary'])  &&

        !empty($_POST['email']) &&
        !empty($_POST['name']) &&
        !empty($_POST['adr']) &&
        !empty($_POST['d_id']) &&
        !empty($_POST['p_no'])&&
        //!empty($_POST['jobposition'])&&
       // !empty($_POST['joiningdate'])&&
       // !empty($_POST['salary'])&&
        !empty($_POST['M_id']) &&
        !empty($_POST['password'])
    )
    {
       $email=$_POST['email'];
       $pass=$_POST['password'];
      // $enc_pass=md5($pass);
       $name=$_POST['name'];
       $adr=$_POST['adr'];
       $p_no=$_POST['p_no'];
       $d_id=$_POST['d_id'];
       $M_id=$_POST['M_id'];
      // $jobposition=$_POST['jobposition'];
      // $joiningdate=$_POST['joiningdate'];
      // $salary=$_POST['salary'];
        
        ///tries to communicate with the database and store the data
        
        try{
            $conn=new PDO('mysql:host=localhost:3306;dbname=h_r_m_project;','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
            //database code execute, default : warning generate
            $sqlquerystring="INSERT INTO employee VALUES(NULL,'$email','$name','$pass','$adr',$d_id,$p_no,$M_id) ";
            
            ///executing the mysql code
            $conn->exec($sqlquerystring);
            ?>
                    <script>location.assign('AdminHome.php')</script>
                <?php
            
        }
        catch (PDOException $ex){
            ?>
                <script>location.assign('addemployee.php')</script>
            <?php
        }
    }
    else{
        //otherwise
        ?>
        <script>location.assign('addemployee.php')</script>
        <?php
    }
}
else{
    //we won't provide service
    echo "<script>location.assign('addemployee.php')</script>";
}
?>

   /// copied code from AdminLoginProcess.php

<?php
}else{
echo "<script>location.assign('AdminLogin.php')</script>";
}
?>
