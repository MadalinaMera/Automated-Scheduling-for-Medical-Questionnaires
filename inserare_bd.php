<?php
    include "conectare.php";
    $perzi=array_fill(0,60,0);
    for($i=1;$i<=$nr_zile;$i++)
    {
        foreach ($c as $c1) 
            {
                if($c1->ziua==$i)
                    $perzi[$i]++;
            }
        if($pauze[$i]!=0)
            $perzi[$i]++;
    }
    $data=$d_start;
    for($i=1;$i<=$nr_zile;$i++)
    {
        $durata_curenta=$ora*60;
        for($j=1;$j<=2;$j++)
        {
            foreach ($c as $c1) 
            {
                if($c1->ziua==$i && $c1->jzi==$j)
                {
                    $ora_inceput=floor($durata_curenta/60);
                    $minut_inceput=$durata_curenta%60;
                    $inceput="$ora_inceput:$minut_inceput";
                    $durata_curenta+=$c1->durata;
                    $ora_final=floor($durata_curenta/60);
                    $minut_final=$durata_curenta%60;
                    $final="$ora_final:$minut_final";
                    $sql="INSERT INTO repartizare (id_c, id_ev, data, ora_start, ora_finish, durata, ziua, nr_zile) VALUES ('$c1->id', '$id_eval', '$data', '$inceput','$final','$c1->durata','$c1->ziua','$nr_zile')";
                    mysqli_query($id_con,$sql);
                }
            }
            if($j==1)
            {
                if($pauze[$i]!=0)
                {
                    $ora_inceput=floor($durata_curenta/60);
                    $minut_inceput=$durata_curenta%60;
                    $inceput="$ora_inceput:$minut_inceput";
                    $durata_curenta+=$pauze[$i];
                    $ora_final=floor($durata_curenta/60);
                    $minut_final=$durata_curenta%60;
                    $final="$ora_final:$minut_final";
                    $sql="INSERT INTO repartizare (id_ev, data, ora_start, ora_finish, durata, ziua, nr_zile) VALUES ('$id_eval','$data', '$inceput','$final','$pauze[$i]', $i, '$nr_zile')";
                    mysqli_query($id_con,$sql);
                }

            }

        }
        $data=strftime("%Y-%m-%d", strtotime("$data +1 day"));
        $timp_zi=$durata_curenta-$ora*60;
    }
                            
?>