<?php

//Stranica prima 4 parametra i ispisuje umnožak zbroja prvi i drugi te treći i četvrti

//pr
//ulaz: 2 2 1 3
//izlaz: 16
$p1 = isset($_GET['p1']) ? $_GET['p1'] : 0;
$p2 = isset($_GET['p2']) ? $_GET['p2'] : 0;
$p3 = isset($_GET['p3']) ? $_GET['p3'] : 0;
$p4 = isset($_GET['p4']) ? $_GET['p4'] : 0;
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
            Unesi cetvrti broj:
            <input type="text" name="p4" value="<?=$p4?>">
        </div>
        <div class="cell large-6 medium-6">
            <input class="success button expanded" type="submit" value="Izračunaj">
            <a class="alert button expanded" href="Z04.php">RESET</a>
        </div>
    </form>
</body>
</html>

<?php

$rez = ($p1 + $p2) * ($p3 + $p4);
echo 'Rezultat je: ' . $rez, '<br>';
echo 'Koraci: ('.$p1.'+'.$p2.')*('.$p3.'+'.$p4.') = '.$p1+$p2 . '*' . $p3+$p4 . ' = '. $rez;
?>