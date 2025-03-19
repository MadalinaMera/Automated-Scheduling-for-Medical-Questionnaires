<?php

function sortare(&$c,$final)
{
    for($i=1;$i<$final;$i++)
        for($j=$i+1;$j<=$final;$j++)
            if($c[$i]->jzi>$c[$j]->jzi)
            {
                $aux=$c[$i];
                $c[$i]=$c[$j];
                $c[$j]=$aux;
            }
}
function cont1($k, &$x)
{
    for($i=1;$i<$k;$i++)
        if($x[$k]==$x[$i])
            return 0;
    return 1;
}
function bkt_1(&$c,$finish, $mini, $maxi, $jumatate,&$cop_k,&$x,$nr_zile, &$pauze)
{
    $k=1;
    $zi=1;
    $x[$k]=0;
    $durata_curenta=0;
    while($k>0)
        if($x[$k]<$finish)
        {
            $x[$k]++;
            if(cont1($k,$x))
            {
                if($durata_curenta+$c[$x[$k]]->durata<=$maxi)
                {
                    $durata_curenta+=$c[$x[$k]]->durata;
                    $c[$x[$k]]->ziua=$zi;
                    $c[$x[$k]]->jzi=$jumatate;
                    if($durata_curenta>=$mini)
                    {
                        if($jumatate==1)
                            $pauze[$zi]=$maxi-$durata_curenta;
                        $zi++;
                        $durata_curenta=0;
                    }
                    if($zi==$nr_zile)
                    {
                        $cop_k=$k;
                        break;
                    }
                    else
                    {
                        $k++;
                        $x[$k]=0;
                    }
                }
            }
        }
        else
            $k--;

}
function bkt_2(&$c,$finish, $mini, $maxi, $jumatate, &$cop_k, &$x,$nr_zile, &$pauze)
{
    $k=1;
    $x[$k]=0;
    $durata_curenta=0;
    while($k>0)
        if($x[$k]<$finish)
        {
            $x[$k]++;
            if(cont1($k,$x))
            {
                if($durata_curenta+$c[$x[$k]]->durata<=$maxi)
                {
                    $durata_curenta+=$c[$x[$k]]->durata;
                    $c[$x[$k]]->ziua=$nr_zile;
                    $c[$x[$k]]->jzi=$jumatate;
                    if($k==$finish)
                    {
                        $pauze[$nr_zile]=0;
                        $cop_k=$k;
                        break;
                    }
                    else
                        if($durata_curenta>=$mini)
                        {
                            $pauze[$nr_zile]=$maxi-$durata_curenta;
                            $cop_k=$k;
                            break;
                        }
                        else
                        {
                            $k++;
                            $x[$k]=0;
                        }
                }
            }
        }
        else
            $k--;

}
function suma($k, &$c)
{
    $s=0;
    for($i=1;$i<=$k;$i++)
        $s=$s+$c[$i]->durata;
    return $s;
}
function fin(&$c,$final_vec, $nr_zile)
{
    for($i=1;$i<=$final_vec;$i++)
    {
        $c[$i]->ziua=$nr_zile;
        $c[$i]->jzi=2;
    }
}
?>