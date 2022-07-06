<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ciklična tablica</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    
</head>
<body>
                <h1>Ciklična tablica</h1>
                <?php
                $x = isset($_GET['x']) ? $_GET['x'] : 0;
                $y = isset($_GET['y']) ? $_GET['y'] : 0;
                ?>
                <form action="" method="get">
                    <label>
                        Unesi broj redaka:
                        <input type="text" name="x" value="<?=$x?>">
                        <br>
                        Unesi broj stupaca:
                        <input type="text" name="y" value="<?=$y?>">
                        <div class="grid-x grid-margin-x">
                        <br>
                        <div class="cell large-6 medium-6">
                            <input class="success button expanded" type="submit" value="Kreiraj tablicu">
                            &nbsp; &nbsp; &nbsp;
                            <a class="alert button expanded" href="index.php"><span style="color: red">RESET</span></a>
                        </div>
                        <!-- <div class="cell large-6 medium-6">
                            <a class="alert button expanded" href="index.php"><span style="color: red">RESET</span></a>
                        </div> -->
                        <br>
                    </label>
                </form>               

                <?php
                $vrijednost=1;
                $brojac=0;
                $lista=[[]];

                for ($i = 1; $i<$x+1; $i++){
                    for ($j = 1; $j<$y+1; $j++){
                        $lista[$i][$j]=0;
                    }
                }

                $i=$x;
                $j=$y;
                for($brojElem=0; $brojElem<$x*$y; $brojElem++){
                    $brojElem--;
                    while($j>0+$brojac){
                        if($brojElem==$x*$y-1){
                            break;
                        }
                        $lista[$i][$j] = $lista[$i][$j]+$vrijednost++;
                        $j--;
                        $brojElem++;
                    }
                        
                    $j++;
                    $i--;
                    while($i>0+$brojac){
                        if($brojElem==$x*$y-1){
                            break;
                        }
                        $lista[$i][$j] = $lista[$i][$j]+$vrijednost++;
                        $i--;
                        $brojElem++;
                    }
                    $i++;
                    $j++;
                    while($j<$y+1-$brojac){
                        if($brojElem==$x*$y-1){
                            break;
                        }
                        $lista[$i][$j] = $lista[$i][$j]+$vrijednost++;
                        $j++;
                        $brojElem++;
                    }
                    $j--;
                    $i++;
                    $brojac++;
                    while($i<$x+1-$brojac){
                        if($brojElem==$x*$y-1){
                            break;
                        }
                        $lista[$i][$j] = $lista[$i][$j]+$vrijednost++;
                        $i++;
                        $brojElem++;
                    }
                    $i--;
                    $j--;
                }

                echo '<table border="1">';

                for($i=1;$i<$x+1;$i++){
                    echo '<tr>';
                    for($j=1;$j<$y+1;$j++){
                        echo '<th>';
                        echo $lista[$i][$j];
                        echo '</th>';
                    }
                    echo '</tr>';
                }
                echo '</table>';

                echo '<hr />';
                ?>
</div>
</body>
</html>


