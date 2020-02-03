<?php
session_start();
include('connexionBDD.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/styles2.css">
  <link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon.ico" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <title>Message envoyé</title>
</head>
<body>
  <?php include('not.php') ?>
  <?php include('header.php')?>
  <div class="container" style="text-align: justify;margin-top:2%;">
    <center>
      <section class="block1 col-md-5" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
        <h1>Merci</h1>
      </section>
      <div class="message design-block"> Un mail a bien été envoyé au propriétaire de l'annonce! Surveillez vos mails, s'il est interessé il vous contactera </div>
        </center>
      </div>
      <?php include('footer.php') ?>
    </body>
    </html>
