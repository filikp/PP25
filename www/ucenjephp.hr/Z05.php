<?php

// Stranica prima 3 GET parametra koji su cijeli brojevi
// stranica ispisuje najveći primljeni broj

// ulaz: 3 8 92
// izlaz: 92

// ulaz: 3 3 92
// izlaz: 3

// ulaz: -1 0 -1
// izlaz: 0

$p1 = isset($_GET['p1']) ? $_GET['p1'] : 0;
$p2 = isset($_GET['p2']) ? $_GET['p2'] : 0;
$p3 = isset($_GET['p3']) ? $_GET['p3'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Z05</title>
</head>
<body>
    <form action="" method="get">
        <div>
            Unesi prvi broj:
            <input type="text" name="p1" value="<?=$p1?>">
        </div>
        <div>
            Unesi drugi broj:
            <input type="text" name="p2" value="<?=$p2?>">
        </div>
        <div>
            Unesi treci broj:
            <input type="text" name="p3" value="<?=$p3?>">
        </div>
        <div>
            <input type="submit" value="Najveći broj je">
        </div>
    </form>
</body>
</html>

<?php
if($p1 > $p2 & $p1 > $p3){
    echo $p1;
}
else if($p2 > $p1 & $p2 > $p3){
    echo $p2;
}
else{
    echo $p3;
}