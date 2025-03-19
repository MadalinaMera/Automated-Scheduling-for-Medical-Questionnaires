<?php  
    if(isset($_GET["id"])){
        $id=$_GET["id"];
    $servername="localhost";
    $username="root";
    $password="";
    $database="a_repart";
    $connection= new mysqli($servername, $username, $password, $database);
    $sql="DELETE FROM evaluatori WHERE id_eval='$id'";
    $connection->query($sql);
    }
header("location:formulare.php");
exit;
?>