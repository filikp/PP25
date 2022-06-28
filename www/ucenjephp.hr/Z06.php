<?php
// Stranica prima cijeli broj.
// Ako je broj paran, boja stranice treba biti zelena, inače treba biti crvena.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zadatak 6</title>
    <?php require_once 'zaglavlje.php'; ?>
</head>
<body>
<div class="grid-container">
    <?php include_once 'izbornik.php'; ?>
    <div class="grid-x grid-margin-x" id="tijelo">
        <div class="cell">
            <div class="callout">
                Zadatak 6
                <p>Parni broj daje <span style="color: green">zelenu</span> pozadinu, a neparni <span style="color: red">crvenu</span> pozadinu.</p> 
                <?php $a = isset($_GET['a']) ? $_GET['a'] : 0; ?>
                <form action="" method="get">
                    <label>
                        Unesi broj:
                        <input type="text" name="a" value="<?=$a?>">
                    </label>
                </form>
                <?php
                    if($a%2==0){
                        echo '<body style="background-color: green">';
                        echo '<br>Broj ', $a, ' je <span style="color: green">paran</span>.<br>';
                    }else{
                        echo '<body style="background-color: red">';
                        echo '<br>Broj ', $a, ' je <span style="color: red">neparan</span>.<br>';
                    }
                ?>
            </div>
        </div>
    </div>
    <?php require_once 'podnozje.php'; ?>
</div>
<?php require_once 'jsskripte.php'; ?>
</body>
</html>



