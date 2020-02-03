<?php
session_start();
include('connexionBDD.php');
$sql =  ('SELECT name FROM events ORDER BY date_event DESC');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/styles2.css">
  <link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon" />
  <title>S'inscrire à un événement</title>
</head>
<body>
  <?php include('header.php')?>
  <div class="container" style="text-align: justify;margin-top:2%;">
    <section class="sectionTitres">
  <h1  class="cursor_none"> S'inscrire à un événement </h1></section>
  <br>
  <p> Veuillez sélectionner l'événement auquel vous souhaitez participer </p>
  <form action="verifInscriptionEvent.php" method="POST">
    <select name="data" >
      <option value="bla" ></option>

      <?php
      foreach  ($bdd->query($sql) as $row) {
        ?>
        <option value='<?php echo $row['name'] ?>' ><?php echo $row['name'] ?> </option>

      <?php  } ?>
    </select>
    <input type="submit" class="btn btn-info" name="submit" value="Je participe !"/>
  </form>
</div>
<?php include('footer.php')?>
</body>
</html>
