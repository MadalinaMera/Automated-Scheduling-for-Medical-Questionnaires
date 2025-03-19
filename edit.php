<?php
    $servername="localhost";
    $username="root";
    $password="";
    $database="a_repart";
    $connection= new mysqli($servername, $username, $password, $database);
    $id="";
    $denumire="";
    $durata="";
    $evaluator="";
    $errorMessage="";
    $succesMessage="";
    if($_SERVER['REQUEST_METHOD']=='GET'){
        if(!isset($_GET["id"])){
            header("location:formularc.php");
            exit; 
        }
        $id=$_GET["id"];
        $sql="SELECT * FROM chestionare WHERE id_c=$id";
        $result=$connection->query($sql);
        $row=$result->fetch_assoc();
        if(!$row){
            header("location:formularc.php");
            exit;
        }
        $denumire=$row["denumire"];
        $durata=$row["durata"];
        $evaluator=$row["id_ev"];
    }
    else{
        $id_d=$_POST["doctori"];
        $id=$_POST["id"];
        $denumire=$_POST["denumire"];
        $durata=$_POST["durata"];
        $evaluator=filter_input(INPUT_POST, 'doctori', FILTER_SANITIZE_STRING);
        do{
            if(empty($id) ||empty($denumire) ||empty($durata) ||empty($evaluator)){
                $errorMessage="All the fields are required";
                break;
            }
            $sql="UPDATE chestionare SET denumire='$denumire',durata='$durata',id_ev=$id_d WHERE id_c='$id'";
            $result=$connection->query($sql);
            if(!$result){
                $errorMessage="Invalid query: ".$connection->error;
                break;
            }
            $succesMessage="Client updated correctly";
            header("location:formularC.php");
            exit; 
        }While(true);
    }
?>
<HTML>
<HEAD>
   
    <title> Modificare Chestionare </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body{
        background-image: url(fundal.jpg);
        }
    </style>
</HEAD>
<body>
    <div class="container my-5">
        <h2>Modifica Chestionarul</h2>
        <?php
            if(!empty($errorMessage)){
                echo"
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            }
        ?>
        
        <form method="post">
            <input type="hidden" name="id"  value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Denumire</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="denumire" style="border-color:black" value="<?php echo $denumire; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Durata</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="durata" style="border-color:black" value="<?php echo $durata; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Evaluator</label>
                <div class="col-sm-6">
                   <?php
                    include "conectare.php";
                    $sql="SELECT id_eval, nume, prenume FROM evaluatori ORDER BY nume, prenume";
                    $sql1="SELECT nume,prenume FROM evaluatori WHERE id_eval=$evaluator";
                    $q1=mysqli_query($id_con,$sql1);
                    $row1=mysqli_fetch_array($q1);
                    if($q = mysqli_query($id_con,$sql))
                    {
                        echo "<select name='doctori'>";
                        echo "<option value='$evaluator'> $row1[0] $row1[1] </option>";
                        while ($row = mysqli_fetch_array($q)) 
                        {
                            echo "<option value=$row[id_eval]> $row[nume] $row[prenume]</option>";
                        }
                        echo "</select>";
                    }
                    else
                    {
                    echo "eroare ".mysqli_error($id_con);
                    }
              ?>
                </div>
            </div>
            
            <?php
                if(!empty($succesMessage)){
                  echo"
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$succesMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            }
            ?>
            
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary"> Modifica </button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="formularc.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</HTML>