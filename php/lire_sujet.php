<?php
session_start();
if(!isset($_SESSION['pseudo'])){
  header("Location: connexion.php");
}else{
  include('connexionBDD.php');
  $theme = $_GET['theme'];
  $sujet = $bdd->query("SELECT id, statut, category, auteur, titre, minidescription, DAY(date_derniere_reponse) as day_sujet, MONTH(date_derniere_reponse) as month_sujet, YEAR(date_derniere_reponse) as year_sujet, HOUR(date_derniere_reponse) as hour_sujet, MINUTE(date_derniere_reponse) as minute_sujet FROM forum_sujets ORDER BY id ASC");
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
      </br>
      <center>
      <div class="block1 col-md-8 menu_forum" style="margin:0 auto;">
        <ul class="list-unstyled">
          <a href="forum.php"><li>Retour au forum</li></a>
          <a  href="insert_sujet.php?thm=<?php echo($theme); ?>"><li>Ecrire un sujet</li></a>
        </ul>
      </div>
    </center>
  </br></br></br></br></br></br></br></br>
    <?php
      while($sujets = $sujet -> fetch()){
        $id_sujet = $sujets['id'];
        $categorie = $sujets['category'];
        $auteur = $sujets['auteur'];
        $titre = $sujets['titre'];
        $minidescription = $sujets['minidescription'];

        if($sujets['minute_sujet']<10){
          $minute_sujet =  '0'.$sujets['minute_sujet'];
        } else{
          $minute_sujet = $sujets['minute_sujet'];
        }
        if($sujets['month_sujet']<10){
          $month_sujet = '0'.$sujets['month_sujet'];
        } else {
          $month_sujet = $sujets['month_sujet'];
        }
        if($sujets['day_sujet']<10){
          $day_sujet =  '0'.$sujets['day_sujet'];
        } else {
          $day_sujet = $sujets['day_sujet'];
        }
        if($sujets['hour_sujet']<10){
          $hour_sujet =  '0'.$sujets['hour_sujet'];
        } else {
          $hour_sujet = $sujets['hour_sujet'];
        }

        $year_sujet = $sujets['year_sujet'];

        $likes = $bdd->query('SELECT id from system_like WHERE id_contenu_like='.$id_sujet);
        $countLikes = $likes->rowCount();
        $dislike = $bdd->query('SELECT id from system_dislike WHERE id_contenu_dislike='.$id_sujet);
        $countDislikes = $dislike->rowCount();

        if($theme == $categorie){
          if($sujets['statut']=='0'){
        ?>
          <div class="block<?php echo $id_sujet;  ?> clo-md-6" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;height:300px;">
            <a href="lire_sujet_complet.php?id_sujet=<?php echo $id_sujet; ?>" class="a_hover"> <div class="div_hover"><h2><?php echo $titre; ?></h2></div></a>
            <div style="margin-bottom:0;">
              <div>
                <h5 style="opacity:0.5;margin-top:1%;">Description pour le sujet :</h5>
                <p style="background-color:#e3f1f2;padding:1%;"> <?php echo $minidescription; ?> </p>
                <p style="position:absolute;margin-top:4%;"><strong><a class="pageProfil" href="pageProfilAutre.php?pseudoMembre=<?php echo $auteur; ?>"> <?php echo $auteur; ?></a></strong> </p>
              </div>
              <div align="right" style="float:right;opacity:0.5;">
                <p><?php echo $hour_sujet.'h'.$minute_sujet; ?></p>
                <p><?php echo $day_sujet.'/'.$month_sujet.'/'.$year_sujet; ?></p>
              </div>
              <div align="center" style="position:absolute;margin-left:27%;">
                <?php echo $countLikes; ?> <img src="../images/like.png" width="50px" height="50px" alt="Vous pouvez voter en lisant le sujet entièrement !"/>
                <img src="../images/dislike.png" width="50px" height="50px" alt="Vous pouvez voter en lisant le sujet entièrement !"/> <?php echo ' '.$countDislikes; ?>
              </div>
            </div>
          </div>
        </br>
<?php }
}
} ?>
      </div>
      <div style="padding-bottom:50px;">
        <?php include('footer.php') ?>
      </div>
    </body>
    </html>

  <?php

}
?>
