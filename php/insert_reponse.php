<?php
session_start();
if(!isset($_SESSION['pseudo'])){
  header("Location: connexion.php");
}else{
  include('connexionBDD.php');
  $reponse = $bdd->query("SELECT * FROM member WHERE name='{$_SESSION['pseudo']}'");
  $donnees = $reponse -> fetch();
  ?>

  <!DOCTYPE html>

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
    <?php include('header.php')?>
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
        <a href="lire_sujet_complet.php?id_sujet=<?php echo $_GET['id_sujet']; ?>"><li>Retour au sujet</li></a>
        <a href="insert_sujet.php?thm=<?php echo($theme); ?>"><li> Ecrire un sujet</li></a>
      </ul>
    </div>
  </center>
  </br>
      <!-- on fait pointer le formulaire vers la page traitant les données -->
      <form action="verifReponse.php?id_sujet=<?php echo $_GET['id_sujet']; ?>" method="post">
        <div class="block2 col-md-9" style="margin:0 auto;border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;margin-top:150px;">
          <div class="">
            <p><strong>Auteur : </strong><?php  if($donnees['premium']==1){ echo $_SESSION['pseudo'] ;?> <img class='symboles' src="../images/premium1.png"/><?php } else {echo $_SESSION['pseudo'];} ?></p>
            <p><strong>Message :</strong></br></br>
            <textarea name="message" cols="50" rows="10" style="width:100%;background-color:#E3F1F2;border-radius:5px;border:2px solid #B1D1D0;padding:2%;" placeholder="Ecrivez ici ce que vous pensez de ce sujet !" style="color:black;opacity:0.2;"></textarea></p>
          </div>
          <p align="right"><input type="submit" class="btn btn-info" name="go" value="Poster"/></p>
        </div>
      </form>
      <?php
      if (isset($erreur)) echo '<br /><br />',$erreur;
      ?>
    </div>
    <?php include('footer.php')?>
  </body>
  </html>

  <?php
}
?>
