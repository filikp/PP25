<?php
// CIKLIČKA TABLICA
// 1. podatkovno
// 2. crtice
// 3. vizualno
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ciklička Tablica</title>
    <link rel="stylesheet" href="ciklicnaTablica.css">
    <?php require_once 'zaglavlje.php'; ?>
</head>
<body>
<div class="grid-container">
    <?php include_once 'izbornik.php'; ?>
    <div class="grid-x grid-margin-x" id="tijelo">
        <div class="cell">
            <div class="callout">
                Ciklička tablica
                <?php
                $x = isset($_GET['x']) ? $_GET['x'] : 0;
                $y = isset($_GET['y']) ? $_GET['y'] : 0;
                ?>
                <form action="" method="get">
                    <label>
                        Unesi broj redaka:
                        <input type="text" name="x" value="<?=$x?>">
                        Unesi broj stupaca:
                        <input type="text" name="y" value="<?=$y?>">
                        <div class="grid-x grid-margin-x">
                        <div class="cell large-6 medium-6">
                            <input class="success button expanded" type="submit" value="Izračunaj">
                        </div>
                        <div class="cell large-6 medium-6">
                            <a class="alert button expanded" href="ciklicnaTablica.php">RESET</a>
                        </div>
                    </label>
                </form>               

                <?php
                $x = isset($_GET['x']) ? $_GET['x'] : 0;
                $y = isset($_GET['y']) ? $_GET['y'] : 0;
                
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
                        $lista[$i][$j] = $lista[$i][$j]+$vrijednost++ . '&#x2190';
                        $j--;
                        $brojElem++;
                    }
                        
                    $j++;
                    $i--;
                    while($i>0+$brojac){
                        if($brojElem==$x*$y-1){
                            break;
                        }
                        $lista[$i][$j] = $lista[$i][$j]+$vrijednost++. '&#x2191';
                        $i--;
                        $brojElem++;
                    }
                    $i++;
                    $j++;
                    while($j<$y+1-$brojac){
                        if($brojElem==$x*$y-1){
                            break;
                        }
                        $lista[$i][$j] = $lista[$i][$j]+$vrijednost++ . '&#x2192';
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
                        $lista[$i][$j] = $lista[$i][$j]+$vrijednost++ . '&#x2193';
                        $i++;
                        $brojElem++;
                    }
                    $i--;
                    $j--;
                }
                ?>
                <table>
                <?php
                for($i=1;$i<$x+1;$i++){
                    echo '<tr>';
                    for($j=1;$j<$y+1;$j++){
                        echo '<th class="tablica">';
                        echo $lista[$i][$j]; 
                        echo '</th>';
                    }
                    echo '</tr>';
                }
                ?>
                </table>
        </div>
            </div>
        </div>        
    </div>
    <?php require_once 'podnozje.php'; ?>
</div>
<?php require_once 'jsskripte.php'; ?>
</body>
</html>


