<?php
session_start();
include("connexionBDD.php");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/styles2.css">
  <link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon" />
  <title>Merci </title>
</head>
<body>
  <?php include('header.php'); ?>
  <div class="container" style="text-align: justify;margin-top:2%;">
    <center>
      <div class="block1 col-md-11" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
      <h1>  Nous avons bien pris en compte votre inscription ! À très bientôt! </h1></br></br>
      <form class="" action="evenements.php" method="post">
        <input type="submit"class="btn btn-info" value="Retour à la page evenement">
      </form>
      </div>
    </center>
  </div>
  <?php include('footer.php'); ?>
</body>
</html>
