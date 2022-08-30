<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <?php require_once 'zaglavlje.php'; ?>
    <title>Ljubavni Kalkulator</title>
  </head>
<body>
    <div class="grid-container">
    <?php include_once 'izbornik.php'; ?>
    <div class="grid-x grid-margin-x" id="tijelo">
      <div class="cell">
        <div class="callout">
        <h3>Ljubavni kalkulator</h3>
        <?php
        include_once "unos.php";
        ?>
        <form action="" method="get">
          <label>
            Unesi prvo ime: 
            <input type="text" name="x" value="<?=$x?>">
            Unesi drugo ime:
            <input type="text" name="y" value="<?=$y?>">
            <div class="grid-x grid-margin-x">
              <div class="cell large-6 medium=6">
                <input class="success button expanded" type="submit" value="Izračunaj">
              </div>
              <div class="cell large-12 medium-12">
                <a class="alert button expanded" href="ljubavniKalkulatorIndex.php">RESET</a>
              </div>
            </div>
          </label>
        </form>         
        <?php
        include_once "ljubavniKalkulator.php";
        ?>
        </div>
      </div>
    </div>
    <?php 
    require_once 'podnozje.php'; ?>
    </div>
    <?php require_once 'jsskripte.php'; ?>
  </body>
</html>