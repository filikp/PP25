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


echo '<table border= "3">';

$kik=1;
for($i=1;$i<$x+1;$i++){
    echo '<tr>';
    for($j=1;$j<$y+1;$j++){
        echo '<th style="background-color: rgb(200,200,120); width: 20px">';
        echo $lista[$i][$j]; 
        echo '</th>';
    }
    echo '</tr>';
}
echo '</table>';
?>