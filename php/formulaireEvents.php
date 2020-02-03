<?php session_start();
$date = date("d-m-Y");
$heure = date("H:i");
include('connexionBDD.php');
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles2.css">
    <link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon" />
    <title>Evenements</title>
  </head>
  <body>
    <div class="container" style="text-align: justify;margin-top:2%;">
      <h1  class="cursor_none"> Je crée un événement </h1>

      <br><br>
      <p> Veuillez entrer l'objet et le contenu de votre requête </p>
      <form action="verificationEvents.php" method="post" >
        Objet: <input type="text" name="name" placeholder="Objet"/>
        Contenu: <input type="text" name="description" placeholder="Contenu" />
        Position:<input type="text" name="position" placeholder="Localisation" />
        <input type="submit" class="btn btn-info" value="Poster" />
      </form>
    </div>
  </body>
</html>
