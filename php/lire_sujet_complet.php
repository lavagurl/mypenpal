<?php
session_start();
if(!isset($_SESSION['pseudo'])){
  header("Location: connexion.php");
}else{
  include('connexionBDD.php');
  $id_sujet = $_GET['id_sujet'];
  $info = $bdd->query("SELECT id, titre, category, auteur, minidescription, sujet_complet, DAY(date_derniere_reponse) as day_sujet, MONTH(date_derniere_reponse) as month_sujet, YEAR(date_derniere_reponse) as year_sujet, HOUR(date_derniere_reponse) as hour_sujet, MINUTE(date_derniere_reponse) as minute_sujet FROM forum_sujets where id = '$id_sujet'");
  $infos = $info -> fetch();
  $id = $infos['id'];
  $titre = $infos['titre'];
  $categorie = $infos['category'];
  $auteur = $infos['auteur'];
  $titreSujet = $infos['titre'];
  $minidescription = $infos['minidescription'];
  $description = $infos['sujet_complet'];

  if($infos['minute_sujet']<10){
    $minute_sujet =  '0'.$infos['minute_sujet'];
  } else{
    $minute_sujet = $infos['minute_sujet'];
  }
  if($infos['month_sujet']<10){
    $month_sujet = '0'.$infos['month_sujet'];
  } else {
    $month_sujet = $infos['month_sujet'];
  }
  if($infos['day_sujet']<10){
    $day_sujet =  '0'.$infos['day_sujet'];
  } else {
    $day_sujet = $infos['day_sujet'];
  }
  if($infos['hour_sujet']<10){
    $hour_sujet =  '0'.$infos['hour_sujet'];
  } else {
    $hour_sujet = $infos['hour_sujet'];
  }

  $year_sujet = $infos['year_sujet'];
  //-----------------------------------------------------------------------------

  $info_reponse = $bdd->query("SELECT auteur, id, statut, message, DAY(date_reponse) as day_reponse, MONTH(date_reponse) as month_reponse, YEAR(date_reponse) as year_reponse, HOUR(date_reponse) as hour_reponse, MINUTE(date_reponse) as minute_reponse FROM forum_reponses where correspondance_sujet = '$id_sujet' ORDER BY id ASC");

  $likes = $bdd->query('SELECT id from system_like WHERE id_contenu_like='.$id);
  $countLikes = $likes->rowCount();
  $dislike = $bdd->query('SELECT id from system_dislike WHERE id_contenu_dislike='.$id);
  $countDislikes = $dislike->rowCount();

  ?>
  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles2.css">
    <link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <title>Forum</title>
  </head>
  <body>
    <?php include('header.php')?>
    <?php include('not.php')?>
    <div class="container" style="text-align: justify;margin-top:2%;">
        <center>
          <section class="block1 col-md-5" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
            <h1  class="cursor_none">Forum</h1>
          </section>
        </center>
        <center>
        <div class="block1 col-md-8 menu_forum" style="margin:0 auto;">
          <ul class="list-unstyled">
            <a href="forum.php"><li>Retour au forum</li></a>
            <a href="lire_sujet.php?theme=<?php echo ($categorie); ?>"><li>Retour à la section <?php echo($categorie); ?></li></a>
            <a  href="insert_reponse.php?id_sujet=<?php echo($id_sujet); ?>"><li>Répondre au sujet</li></a>
          </ul>
        </div>
      </center>
      <?php if($id_sujet == $id){ ?>
        <div class="block1 col-md-9" style="margin:0 auto;border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;margin-top:170px;">
          <div class="div_hover"><h2><?php echo $titre ?></h2></div>
          </br>
          <?php if($auteur == $_SESSION['pseudo']){ ?>
            <form class="boutons_modif_suppression" action="" method="post">
              <p style="float:right;"><input class="btn btn-info" id="mod" type="submit" name="supprimer" value="Supprimer mon sujet"></input></p>
            </form>
            <?php
            if(isset($_POST['supprimer'])) {
              $modif = '1';
              $updateSujet = $bdd->prepare("UPDATE forum_sujets SET statut = ? WHERE titre='{$titre}' ");
              $updateSujet ->execute(array
              ($modif)
            );
            header("Location: lire_sujet.php?theme={$categorie}");
          } ?>
          <form class="boutons_modif_suppression" action="modifs_sujet.php?id=<?php echo ($id); ?>" method="post">
            <p style="align:left;"><input class="btn btn-info" type="submit" name="lien" value="Modifier le sujet"></input></p>
          </form>
          <?php
        } ?>
        <div>
          <h5 align="right"><a id="pageProfil" href="pageProfilAutre.php?pseudoMembre=<?php echo $auteur ?>" class="a_hover3"> <?php echo $auteur ?></a></h5>
          <h6 style="opacity:0.5;">Description du sujet :</h6>
          <p style="background-color:#e3f1f2;padding:2%;"> <?php echo  nl2br($minidescription) ?> </p>
          <h6 style="opacity:0.5;">Sujet :</h6>
          <p style="background-color:#e3f1f2;padding:2%;"><?php echo  nl2br($description); ?></p>
        </div>
        <div>
          <p style="opacity:0.5;margin-left:88%;text-align:center;"><?php echo $hour_sujet.'h'.$minute_sujet; ?></br><?php echo $day_sujet.'/'.$month_sujet.'/'.$year_sujet; ?></p>
        </div>
        <div align="right">
        <strong><a  href="insert_reponse.php?id_sujet=<?php echo($id_sujet); ?> " class="btn btn-info a_hover2" style="color:white;">Répondre au sujet</a></strong>
      </div>
      <div align="center" style="position:absolute;margin-left:38%;margin-top:-8%;">
        <?php echo $countLikes; ?> <a href="action.php?t=1&id=<?php echo $id; ?>"> <img src="../images/like.png" width="50px" height="50px" alt=""/> </a>
        <a href="action.php?t=2&id=<?php echo $id; ?>"><img src="../images/dislike.png" width="50px" height="50px" alt=""/></a><?php echo ' '.$countDislikes; ?>
      </div>
    </div>
  </br>
</br>
<?php } ?>
<?php while($infos_reponse = $info_reponse->fetch()){
  if($infos_reponse['statut']==0){
  if($infos_reponse['minute_reponse']<10){
    $minute_reponse =  '0'.$infos_reponse['minute_reponse'];
  } else{
    $minute_reponse = $infos_reponse['minute_reponse'];
  }
  if($infos_reponse['month_reponse']<10){
    $month_reponse = '0'.$infos_reponse['month_reponse'];
  } else {
    $month_reponse = $infos_reponse['month_reponse'];
  }
  if($infos_reponse['day_reponse']<10){
    $day_reponse =  '0'.$infos_reponse['day_reponse'];
  } else {
    $day_reponse = $infos_reponse['day_reponse'];
  }
  if($infos_reponse['hour_reponse']<10){
    $hour_reponse =  '0'.$infos_reponse['hour_reponse'];
  } else {
    $hour_reponse = $infos_reponse['hour_reponse'];
  }
  $id_reponse = $infos_reponse['id'];
  $auteur_reponse = $infos_reponse['auteur'];
  //$avatars = prepare("SELECT avatar FROM member where name='${auteur_reponse}'");
  //$avatar = $avatars->fetch();
  $message_reponse = $infos_reponse['message'];
  $year_reponse = $infos_reponse['year_reponse'];
  ?>
  <div class="block2 col-md-5" style="margin:0 auto;border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;height:210px;">
    <?php if($auteur_reponse==$_SESSION['pseudo']){ ?>
    <form class="" align="right" action="verifModifEspace.php?supprimerPosts=<?php echo($id_reponse); ?>" method="post">
      <input type="submit" class="btn btn-info" value="Supprimer"/>
    </form>
    <?php } ?>
    <!--<img src="<?php //echo $avatar; ?>" alt="">-->
    <h5><strong><a id="pageProfil" href="pageProfilAutre.php?pseudoMembre=<?php echo $auteur_reponse ?>" class="a_hover3" > <?php echo $auteur_reponse ?></a></strong> : </h5>
    <p><?php echo ($message_reponse); ?> </p>
    <div style="opacity: 0.5;margin-top:-5%;margin-left:65%;"><p align="right"> <?php echo $hour_reponse.'h'.$minute_reponse; ?>
    </br><?php echo $day_reponse.'/'.$month_reponse.'/'.$year_reponse; ?></p>
  </div>
</div>
</br>
<?php }
} ?>
</div>
<?php include('footer.php') ?>
</body>
</html>

<?php

}
?>
