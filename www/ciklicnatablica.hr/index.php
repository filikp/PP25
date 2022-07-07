<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'zaglavlje.php'; ?>
    <!-- <link href="minimal-table.css" rel="stylesheet" type="text/css">     -->
</head>

<body>
<div class="grid-container">
    <?php include_once 'izbornik.php'; ?>
    <div class="grid-x grid-margin-x" id="tijelo">
      <div class="cell">
        <div class="callout">
        <h3>Ciklična tablica</h3>
    <?php require_once 'unos.php'; ?>
    <form action="" method="get">
        <label>
            Unesi broj redaka:
            <input type="text" name="x" value="<?=$x?>">
            Unesi broj stupaca:
            <input type="text" name="y" value="<?=$y?>">
            <div class="grid-x grid-margin-x">
            <div class="cell large-12 medium-12">
                <input class="success button expanded" type="submit" value="Kreiraj tablicu">
                <a class="alert button expanded" href="index.php">RESET</a>
            </div>
        </label>
    </form>               
        </div>
      </div>
    </div>

    <div class="grid-container">
        <div class="grid-x grid-margin-x" id="tijelo">
            <div class="cell large-12 medium-12">
                <div class="callout">
                    <?php require_once 'samoCiklicnaTablica.php'; ?>
                </div>
            </div>
        </div>
    </div>
</div>
    
    <?php require_once 'podnozje.php'; ?>
</div>
<?php require_once 'jsskripte.php'; ?>
</body>
</html>


