<?php

// CIKLIČKA TABLICA
// 1. podatkovno
// 2. crtice
// 3. vizualno

$x = isset($_GET['x']) ? $_GET['x'] : 1;
$y = isset($_GET['y']) ? $_GET['y'] : 1;

$vrijednost=1;
$brojac=0;
$lista=[[]];

for ($i = 0; $i<$x; $i++){
    for ($j = 0; $j<$y; $j++){
        $lista[$i][$j]=$vrijednost++;
    }
}


echo '<hr />';

// ISPIS niza -----------------
for ($i = 0; $i<$x; $i++){
    for ($j = 0; $j<$y; $j++){
        echo $lista[$i][$j];
    }
}
//-----------------------------

echo '<hr />';


echo '<table border="1">';
for($i=0;$i<$x;$i++){
    echo '<tr>';
    for($j=0;$j<$y;$j++){
        echo '<th>';
        echo $lista[$i][$j];
        echo '</th>';
    }
    echo '</tr>';
}
echo '</table>';


echo '<hr />';