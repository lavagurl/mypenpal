<?php
session_start();
if(!isset($_SESSION['pseudo'])){
  header("Location: connexion.php");
}else{
  include('connexionBDD.php');
  $theme = $_GET['thm'];
  $reponse = $bdd->query("SELECT * FROM member WHERE name='{$_SESSION['pseudo']}'");
  $donnees = $reponse -> fetch();
  ?>
  <html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles2.css">
    <link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon" />
    <title>Forum</title>
  </head>

  <body>
    <?php include('header.php') ?>
    <div class="container" style="text-align: justify;margin-top:2%;">
      <center>
        <section class="block1 col-md-5" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
          <h1  class="cursor_none">Forum</h1>
        </section>
      </center>
    </br>
    <center>
      <div class="block1 col-md-8 menu_forum" style="margin:0 auto;">
        <ul class="list-unstyled">
          <a href="forum.php"><li>Retour au forum</li></a>
          <a href="lire_sujet.php?theme=<?php echo ($theme); ?>"><li>Retour à la section <?php echo($categorie); ?></li></a>
        </ul>
      </div>
    </center>
  </br></br>

      <div class="block1 col-md-9" style="margin:0 auto;border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;margin-top:150px;">
        <form class="form" action="verifSujets.php?paramMembre=<?php echo $_SESSION['pseudo']?>" method="post">
          <div class="">
            <p><strong>Auteur :</strong>
              <a class="pageProfil" href="pageProfilAutre.php?pseudoMembre=<?php echo $_SESSION['pseudo']?>" class="a_hover2"><?php if($donnees['premium']==1){ echo $_SESSION['pseudo'] ;?> <img class='symboles' src="../images/premium1.png"/><?php } else {echo $_SESSION['pseudo'];} ?></a></p>
              <p><strong>Titre : </strong> * <input type="text" name="titre" maxlength="50" size="50" value="" style="height:30px;background-color:#E3F1F2;border-radius:5px;border:2px solid #B1D1D0;padding:2%;"></input>
            </p>
              <p><strong>Catégorie : </strong><input type="text" name="category" value="<?php echo($theme); ?>" style="border:none;" readOnly="readOnly"></input>
            </p>
              <p><strong>Faites une mini description de votre sujet :</strong> * </br>
                <textarea name="minidescription" cols="50" rows="4" style="width:100%;background-color:#E3F1F2;border-radius:5px;border:2px solid #B1D1D0;padding:2%;"></textarea>
              </p>
              <p><strong>Description de votre sujet :</strong> * </br>
                <textarea name="sujet_complet" cols="50" rows="10" style="width:100%;background-color:#E3F1F2;border-radius:5px;border:2px solid #B1D1D0;padding:2%;"></textarea>
              </p>
              <p align="right"><input class="btn btn-info" type="submit" name="go" value="Poster"></p>
              <h7>*Informations obligatoires.</h7>
            </div>
          </form>
          </div>
      </div>
        <?php include('footer.php'); ?>
    </body>
    </html>

  <?php

} ?>
