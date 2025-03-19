<HTML>
<HEAD>
    
    <title> Evaluatori </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        body{
        background-image: url(fundal.jpg);
        }
    </style>

</HEAD>
<body>
    <div class="container my-5">
        <h2>Lista Evaluatorilor</h2>
        <a class="btn btn-primary" href="create.php" role="button">Adauga Evaluator</a>
        <a class="btn btn-primary" href="index.php" role="button">Acasa</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nume</th>
                    <th>Prenume</th>
                    <th>Functie</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $servername="localhost";
                    $username="root";
                    $password="";
                    $database="a_repart";
                    $connection= new mysqli($servername, $username, $password, $database);
                    if($connection->connect_error){
                        die("Connection Failed: " . $connection->connect_error);
                    }
                    $sql=" SELECT * FROM evaluatori";
                    $result=$connection->query($sql);
                    if(!$result){
                        die("Invalid query: ".$connection->error);
                    }
                    while($row=mysqli_fetch_array($result)){
                         echo "
                            <tr>
                                <td>$row[id_eval]</td>
                                <td>$row[nume]</td>
                                <td>$row[prenume]</td>
                                <td>$row[functie]</td>
                                <td>
                                    <a class='btn btn-primary btn-sm' href='EditE.php?id=$row[id_eval]'>Edit</a>
                                    <a class='btn btn-danger btn-sm' href='DeleteE.php?id=$row[id_eval]'>Delete</a>
                                </td>
                            </tr>
                         ";
                    }
                ?>
                
            </tbody>
        </table>
    </div>
</body>
</HTML>