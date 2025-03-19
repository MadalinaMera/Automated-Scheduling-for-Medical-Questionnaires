<HTML>
<HEAD>    
    <title> Pagina Principala </title>
    <link href="cssindex.css" rel="stylesheet" type="text/css">
    
</HEAD>
<BODY>
 <div id="tot" >
        <div id="sus">
            <div id="sigla">
                <img src="hospital_logo.png" width=500px height=150px style="border-radius:10px">
            </div>
        </div>
        <div id="baranav">
            <?php
                include "baranav.php";
            ?>
        </div>
        <div id="princip">
            <div id="dreapta">
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
               <div class="container my-5">
        <h2>Lista Chestionarelor</h2>
        <a class="btn btn-primary" href="create.php" role="button">Adauga Chestionar</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Denumire</th>
                    <th>Durata</th>
                    <th>Evaluator</th>
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
                    $sql=" SELECT * FROM chestionare as a INNER JOIN evaluatori as b ON a.id_ev=b.id_eval ORDER BY a.id_c";
                    $result=$connection->query($sql);
                    if(!$result){
                        die("Invalid query: ".$connection->error);
                    }
                    while($row=mysqli_fetch_array($result)){
                         echo "
                            <tr>
                                <td>$row[id_c]</td>
                                <td>$row[denumire]</td>
                                <td>$row[durata]</td>
                                <td>$row[nume] $row[prenume]</td>
                                <td>
                                    <a class='btn btn-primary btn-sm' href='edit.php?id=$row[id_c]'>Edit</a>
                                    <a class='btn btn-danger btn-sm' href='delete.php?id=$row[id_c]'>Delete</a>
                                </td>
                            </tr>
                         ";
                    }
                ?>
                
            </tbody>
        </table>
    </div>
            </div>
        </div>


    </div>  
</BODY>
</HTML>