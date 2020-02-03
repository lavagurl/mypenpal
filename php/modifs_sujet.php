<?php
session_start();
if(!isset($_SESSION['pseudo'])){
  header("Location: connexion.php");
}else{
  include('connexionBDD.php');
  $id = $_GET['id'];
  $sujet = $bdd->query("SELECT * FROM forum_sujets where id = '$id'");
  $sujets = $sujet-> fetch();
  $auteur = $sujets['auteur'];
  $categorie = $sujets['category'];
  $titre = $sujets['titre'];
  $minidescription = $sujets['minidescription'];
  $description = $sujets['sujet_complet'];
  ?>
  <html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles2.css">
    <link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <title>Forum</title>
  </head>

  <body>
    <?php include('header.php') ?>
    <?php include('not.php') ?>
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
          <a href="lire_sujet_complet.php?id_sujet=<?php echo $id; ?>"><li>Retour au sujet</li></a>
          <a href="insert_sujet.php?thm=<?php echo($theme); ?>"><li> Ecrire un sujet</li></a>
        </ul>
      </div>
    </center>
    </br>
    <?php if($auteur == $_SESSION['pseudo']){ ?>
        <div class="block1 col-md-9" style="margin:0 auto;border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;margin-top:150px;">
        <form class="form" action="verifModifSujets.php?id=<?php echo ($id); ?>" method="post">
          <div class="">
            <p><strong>Auteur :</strong>
              <a href="pageProfilAutre.php?pseudoMembre=<?php echo $_SESSION['pseudo']?>" class="a_hover2"><?php echo $_SESSION['pseudo'] ?></a></p>
              <p><strong>Titre : </strong><input type="text" name="titre" maxlength="50" size="50" value="<?php echo($titre); ?>" readOnly="readOnly" style="border:none;"></input>
              </p>
              <p><strong>Catégorie : </strong><input type="text" name="category" value="<?php echo($categorie); ?>" readOnly="readOnly" style="border:none;"></input>
              </p>
              <p><strong>Faites une mini description de votre sujet :</strong></br>
                <textarea name="minidescription" cols="50" rows="4" style="width:100%;background-color:#E3F1F2;border-radius:5px;border:2px solid #B1D1D0;padding:2%;"><?php echo ($minidescription); ?></textarea>
              </p>
              <p><strong>Description de votre sujet :</strong></br>
                <textarea name="sujet_complet" cols="70" rows="20" style="width:100%;background-color:#E3F1F2;border-radius:5px;border:2px solid #B1D1D0;padding:2%;"><?php echo ($description); ?></textarea>
              </p>
              <p align="right"><input class="btn btn-info" type="submit" name="modifier" value="Modifier"></p>
            </div>
          </form>
          </div>
        <?php } else{ ?>
            <div class="block1 col-md-9" style="margin:0 auto;border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;margin-top:150px;">
              <h3>Qu'est ce que tu fais ici, petit malin ? </h3>
            </div>
        <?php } ?>
      </div>
    <?php include('footer.php') ?>
  </body>
  </html>

<?php } ?>
