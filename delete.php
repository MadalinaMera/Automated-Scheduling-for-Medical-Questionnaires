<?php  
    if(isset($_GET["id"])){
        $id=$_GET["id"];
    $servername="localhost";
    $username="root";
    $password="";
    $database="a_repart";
    $connection= new mysqli($servername, $username, $password, $database);
    $sql="DELETE FROM chestionare WHERE id_c='$id'";
    $connection->query($sql);
    }
header("location:formularc.php");
exit;
?>