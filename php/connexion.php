<?php
if(isset($_GET['erreur'])){
  $erreur = $_GET['erreur'];
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/styles2.css">
  <link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon" />
  <title>Se connecter</title>
</head>
<body>
  <?php include('header.php')?>
  <div class="container" style="text-align: justify;margin-top:2%;">
    <div class="block1 col-md-8" style="margin:0 auto;border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
      <div style="text-align:center;">
        <h2>My Penpal n'attends que vous !</h2>
      </div>
    </br>
      <center>
      <form action="verificationConnexion.php" method="post" class="formConnexion" >
        <input type="text" name="pseudo" placeholder="Identifiant"></br>
        <input type="password" name="mdp" placeholder="Mot de passe"></br></br>
        <input class="btn btn-info" type="submit" name="Connexion" value="Se connecter">
      </form>
      <form action="inscription.php" method="post">
      </br>
      <input class="btn btn-info" type="submit" value="Je n'ai pas de compte !">
    </form>
  </center>
  </div>
</div>

  <?php include('footer.php'); ?>
</body>
</html>
