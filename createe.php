<?php
    $servername="localhost";
    $username="root";
    $password="";
    $database="a_repart";
    $connection= new mysqli($servername, $username, $password, $database);
    $nume="";
    $prenume="";
    $functie="";
    $errorMessage="";
    $succesMessage="";
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $nume=$_POST["nume"];
        $prenume=$_POST['prenume'];
        $functie=$_POST['functie'];
        do{
            if(empty($nume) || empty($prenume) || empty($functie)){
                $errorMessage="All the fields are required";
                break;
            }
            $sql="INSERT INTO evaluatori (nume, prenume, functie) VALUES('$nume','$prenume','$functie')";
            $result=$connection->query($sql);
            if(!$result){
                $errorMessage="Invalid query: " . $connection->error;
                break;
            }
            $nume="";
            $prenume="";
            $functie="";
            $succesMessage="Client added corectly";
            header("location:formulare.php");
            exit;
        }while(false);
    }
?>
<HTML>
<HEAD>

    <title> Adauga Evaluatori </title>
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
        <h2>Evaluator nou</h2>
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
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nume</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nume" style="border-color:black" value="<?php echo $nume; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Prenume</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="prenume"  style="border-color:black" value="<?php echo $prenume; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Functie</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="functie" style="border-color:black" value="<?php echo $functie; ?>">
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
                    <button type="submit" class="btn btn-primary"> Adauga </button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="formularE.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</HTML>