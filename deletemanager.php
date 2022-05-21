<?php
session_start();

if(
        isset($_SESSION['adminemail'])
    &&  !empty($_SESSION['adminemail'])
){
    if(
            isset($_GET['manid'])
        && !empty($_GET['manid'])
    ){
        
        $deletemanagerid=$_GET['manid'];
    
        try{
            $conn=new PDO('mysql:host=localhost:3306;dbname=h_r_m_project;','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
            
            $sqlquerystring="DELETE FROM department WHERE Manager_id=$deletemanagerid";
            $conn->exec($sqlquerystring);
            
            ?>
                <script>location.assign('seemanager.php')</script>
            <?php
        }
        catch (PDOException $ex){
            ?>
                <script>location.assign('home.php')</script>
            <?php
        }
        
    }
    else{
         ?>
            <script>location.assign('home.php')</script>
        <?php
    }
}
else{
    ?>
        <script>location.assign('login.php')</script>
    <?php
}

?>