<HTML>
<HEAD>    
    <title> Repartizare </title>
    <link href="cssindex.css" rel="stylesheet" type="text/css">
    <style>
        body{
        background-image: url(fundal.jpg);
            zoom:100%;
        }
    </style>
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
        <ul>
     
        </ul>
        <div id="main">
            <div id="dreapta">
                <form action="" method="post">
                    Introduceti data de la care doriti sa inceapa repartizarea chestionarelor: <input type="date" name="data"><br>
                    Introduceti ora de la care doriti sa inceapa repartizarea in fiecare zi: <input type="number" name="ora" value="9" min="7" max="12" step="1"><br>
                    <input type="submit" name="buton" value="Repartizeaza" class="btn btn-primary">
                </form>
                <?php
                    if(isset($_POST['buton']))
                    {
                        include "conectare.php";
                        $sql="TRUNCATE TABLE repartizare";
                        mysqli_query($id_con,$sql);
                        $sql="ALTER TABLE repartizare AUTO_INCREMENT = 1";
                        mysqli_query($id_con,$sql);
                        $d_start=$_POST['data'];
                        $ora=$_POST['ora'];
                        session_start();
                        $_SESSION['ora'] = $ora; 
                        $sql="SELECT id_eval, nume, prenume FROM evaluatori ORDER BY nume, prenume";
                        if($q=mysqli_query($id_con,$sql))
                        {
                            if(mysqli_num_rows($q)>0)
                            {
                                 class structura {
                                    public $id;
                                    public $denumire;
                                    public $durata;
                                    public $ziua;
                                    public $jzi;
                                }
                                $c=array();
                                $x=array();
                                $pauze=array();
                                $zmax=0;
                                while($evaluator=mysqli_fetch_array($q))
                                {
                                    $id_eval=$evaluator[0];
                                    $n_sql="SELECT id_c, denumire, durata FROM chestionare WHERE id_ev=$id_eval";
                                    if($p=mysqli_query($id_con,$n_sql))
                                    {
                                        $nr_chest=mysqli_num_rows($p);
                                        if($nr_chest>0)
                                        {

                                          $i=1;
                                              while($linie=mysqli_fetch_array($p))
                                                {
                                                    $c[$i] = new structura();
                                                    $c[$i]->id=$linie[0];
                                                    $c[$i]->denumire=$linie[1];
                                                    $c[$i]->durata=$linie[2];
                                                    $i++;
                                                }

                                            require_once "functii.php";
                                            $durata_totala=suma($nr_chest,$c);
                                            ////de modificat daca se doreste acest lucru
                                            $nr_zile=floor($durata_totala/540)+1;
                                            if($nr_zile>$zmax)
                                                $zmax=$nr_zile;
                                            $start=(14-$ora)*60+30;
                                            $finish=$start+30;
                                            bkt_1($c,$nr_chest,$start,$finish,1,$cop_k,$x,$nr_zile,$pauze);
                                            $final_vec=$nr_chest;
                                            sortare($c,$final_vec);
                                            $t1=$cop_k;
                                            $final_vec=$final_vec-$t1;
                                            bkt_1($c,$final_vec,180,240,2,$cop_k,$x,$nr_zile,$pauze);
                                            sortare($c,$final_vec);
                                            $t1=$cop_k;
                                            $final_vec=$final_vec-$t1;
                                            bkt_2($c,$final_vec,$start,$finish,1,$cop_k,$x,$nr_zile,$pauze);
                                            if($final_vec!=0)
                                            {
                                                sortare($c,$final_vec);
                                                $t1=$cop_k;
                                                $final_vec=$final_vec-$t1;
                                                fin($c,$final_vec,$nr_zile);
                                            }
                                            require "inserare_bd.php";
                                        }
                                    }
                                    $c=(array) null;
                                    $x=array_fill(0,80,0);
                                    $pauze=array_fill(0,80,0);
                                }
                            }
                        }
                        $_SESSION['zmax'] = $zmax;                         
                    header("location:afisare.php");
                    exit; 
                }
            ?>
        </div>
    </div>


    </div>  
</BODY>
</HTML>