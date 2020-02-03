<?php session_start();
$date = date("d-m-Y");
$heure = date("H:i");
include('connexionBDD.php');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>BackOffice</title>
  <link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon.ico" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/styles2.css">
  <link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon.ico" />
</head>
<body>
  <?php include('header.php'); ?>

  <div id="main">
    <?php include("navBarBO.php") ?>
    <div class="container" style="text-align: center;margin-top:2%;margin-bottom:2%;">
      <section class="block1" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;padding:5px;">
        <h1 class="titres"> Bienvenue sur le BackOffice de myPenpal </h1>

        <article>
        </br>
        Gérez votre site en toute simplicité !
        <br><br>
        L'onglet Gestion vous permet d'avoir un apérçue et de gérer tous les membres du site.
        <br><br>
        L'onglet Gestion Évènement vous permet d'ajouter, de modifier ou de supprimer un évènement.
        <br><br>
        L'onget Administrateur vous permet d'avoir accès a tous les administrateurs de la page, vous pourez modifier les administrateurs.
    </article>
    </section>
  </div>
  <?php include('footer.php'); ?>
</body>
</html>
