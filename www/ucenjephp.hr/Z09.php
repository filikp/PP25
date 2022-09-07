<?php

// Ispišite tablicu 3 x 3 na način
// da u ćelijama kuteva stavite znak X

// DZ: Napraviti da radi za bilo koja dva unesena broja
//     Putem GET metode

$x = isset($_GET['x']) ? $_GET['x'] : 0;
$y = isset($_GET['y']) ? $_GET['y'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="get">
        <div>
            Unesi broj redaka: 
            <input type="text" name="x" value="<?=$x?>">
        </div>
        <div>
            Unesi broj stupaca: 
            <input type="text" name="y" value="<?=$y?>">
        </div>
        <div>
            <input type="submit" value="Prikaži">
        </div>
    </form>
</body>
</html>

<?php
echo '<table border="1">';
for($i=0;$i<$x;$i++){
    echo '<tr>';
    for($j=0;$j<$y;$j++){
        echo '<td>';
        if(
            ($i===0 && $j===0)
            ||
            ($i===0 && $j===$y-1)
            ||
            ($i===$x-1 && $j===0)
            ||
            ($i===$x-1 && $j===$y-1)
        ){
            echo 'X';
        }else{
            echo '&nbsp; &nbsp;';
        }
        echo '</td>';
    }
    echo '</tr>';
}
echo '</table>';