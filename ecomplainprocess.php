<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(
        isset($_POST['complain']) &&
        isset($_POST['empid']) &&
       
        
        !empty($_POST['complain']) &&
        !empty($_POST['empid'])
    )
    {
        $complain=$_POST['complain'];
        $empid=$_POST['empid'];
        

        try{
            $conn= new PDO('mysql:host=localhost:3306;dbname=h_r_m_project','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sqlquerystring="INSERT INTO complain VALUES(NULL,'$complain',NOW(),'$empid')";

            $conn->exec($sqlquerystring); 
            
            ?>
              <script>location.assign('employeehome.php')</script>
            <?php
        }
        catch(PDOException $ex){
            ?>
                <script>location.assign('docomplain.php')</script>
            <?php
        }
    }
    else{
        ?>
            <script>location.assign('docomplain.php')</script>
        <?php
    }
}
else{
    ?>
     <script>location.assign('docomplain.php')</script>;
     <?php
}
?>