<html>
    <head>
        <link href="afisarecss.css" rel="stylesheet" type="text/css">  
    </head>
<body>
<div class="table-wrapper">
<?php
    include "conectare.php";
    
    $sql="SELECT id_eval, nume, prenume FROM evaluatori ORDER BY nume, prenume";
    echo "<table border=1 align=center class='fl-table'><thead><tr>";
    if($q=mysqli_query($id_con,$sql))
    {
        $nr_ev=mysqli_num_rows($q);
        echo "<tr>";
        for($i=1;$i<=$nr_ev;$i++)
            echo "<th rowspan=3 align='center'>Ziua</th><th colspan=4>Nume si prenume evaluator</th>";
        echo "</tr>";
        $i=1;
        echo "<tr>";
        while($evaluator=mysqli_fetch_array($q))
        {
            $eval[$i]=$evaluator[0];
            echo "<th colspan=4 align='center'>$evaluator[1] $evaluator[2]</th>";
            $i++;
        }
        echo "</tr>";
        echo "<tr>";
        for($i=1;$i<=$nr_ev;$i++)
            echo "<th colspan=2 align='center'>Interval orar</th><th>Durata</th><th>Locatia si functia interlocutorului</th>";
        echo "</tr>";
    }
    echo "</thead>";
    ////numarul maxim de chestionare
    $maxim=0; 
    session_start();
    $nr_zile= $_SESSION['zmax'];
    $row[]=array();
    for($i=1;$i<=$nr_ev;$i++)///evaluatori
    {
        $n_q="SELECT a.data, a.ora_start, a.ora_finish, a.durata, b.denumire, a.ziua, a.nr_zile FROM repartizare as a LEFT OUTER JOIN chestionare as b ON a.id_c=b.id_c WHERE a.id_ev='$eval[$i]'";
        $newsql[$eval[$i]]=mysqli_query($id_con,$n_q);
        $numar_chestionare[$eval[$i]]=mysqli_num_rows($newsql[$eval[$i]]);
        if($numar_chestionare[$eval[$i]]>$maxim)
            $maxim=$numar_chestionare[$eval[$i]];
        for($j=1;$j<=$nr_zile;$j++)///zile
        {
            ////numarul de chestionare/zi pentru fiecare evaluator
            $n_q="SELECT COUNT(*) AS numar_chestionar FROM repartizare WHERE id_ev='$eval[$i]' AND ziua='$j'";
            $n_sql=mysqli_query($id_con,$n_q);
            $extragere=mysqli_fetch_assoc($n_sql);
            $per_zi[$eval[$i]][$j]=$extragere['numar_chestionar'];
        }
        
    }
    $ora_n = $_SESSION['ora']; 
    if($ora_n<10)
    {
        $add="0";
        $string=(string) $ora_n;
        $new=$add.$string;
    }
    else
        $new=(string) $ora_n;
    $add=":00:00";
    $ora=$new.$add;
    for($i=1;$i<=$maxim;$i++)
    {
        echo "<tr>";
        for($j=1;$j<=$nr_ev;$j++)
        {
            if($chestionar=mysqli_fetch_array($newsql[$eval[$j]]))
            {
                if($chestionar['ora_start']==$ora)///sunt la inceputul zilei
                {
                    $rowspan=$per_zi[$eval[$j]][$chestionar[5]];
                    if($chestionar['ziua']==$chestionar['nr_zile'])///sunt la inceputul ultimei zile
                    {
                        $rowspan=$maxim-$i+1;
                    }
                    echo "<td rowspan=$rowspan>$chestionar[0]</td>";
                }
                if($i==$numar_chestionare[$eval[$j]])///daca ma aflu la ultimul chestionar al evaluatorului j
                {
                    $randuri_ramase=$maxim-$i+1;
                    if($chestionar[4]==NULL)
                        echo "<td rowspan=$randuri_ramase>$chestionar[1]</td><td rowspan=$randuri_ramase>$chestionar[2]</td> <td rowspan=$randuri_ramase>$chestionar[3]</td> <td rowspan=$randuri_ramase>pauza de masa</td>";
                    else
                        echo "<td rowspan=$randuri_ramase>$chestionar[1]</td><td rowspan=$randuri_ramase>$chestionar[2]</td> <td rowspan=$randuri_ramase>$chestionar[3]</td> <td rowspan=$randuri_ramase>$chestionar[4]</td>";
                }
                else
                    if($chestionar[4]==NULL)
                        echo "<td>$chestionar[1]</td><td>$chestionar[2]</td> <td>$chestionar[3]</td> <td>pauza de masa</td>";
                    else
                        echo "<td>$chestionar[1]</td><td>$chestionar[2]</td> <td>$chestionar[3]</td> <td>$chestionar[4]</td>";
            }
        }
        echo "</tr>";
    }
    echo "</table>";
    
?>
</div>
</body>
</html>