<?php
session_start();
if(!isset($_SESSION['pseudo'])){
  header("Location: connexion.php");
}else{

  include('connexionBDD.php');

  $evenements = $bdd->query("SELECT events.title as event, events.id as id_event FROM inscriptionevent INNER JOIN events ON events.id = inscriptionevent.event WHERE name='{$_SESSION['id']}'");
  $reqEvent = $evenements->rowCount();

  $sujets = $bdd->query("SELECT id, auteur, titre, DAY(date_derniere_reponse) as day_sujet, MONTH(date_derniere_reponse) as month_sujet, YEAR(date_derniere_reponse) as year_sujet, HOUR(date_derniere_reponse) as hour_sujet, MINUTE(date_derniere_reponse) as minute_sujet, category, minidescription, statut FROM forum_sujets WHERE auteur='{$_SESSION['pseudo']}'");
  $reqSujet = $sujets->rowCount();

  $biens = $bdd->query("SELECT * FROM goods WHERE member='{$_SESSION['id']}'");
  $reqBien = $biens->rowCount();

  $locations = $bdd->query("SELECT * FROM lease WHERE member='{$_SESSION['id']}'");
  $reqLocation = $locations->rowCount();
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

    <title>Mon espace</title>
  </head>
  <body>
    <?php include('header.php')?>
    <?php include('not.php') ?>
    <div class="container" style="text-align: justify;margin-top:2%;">
      <div class="row">
        <div class="block1 col-md-12" style="border:2px solid #a2d8d6;background-color:white;margin:0.5px;">
          <h1 style="text-align:center;">Mes sujets</h1>
          <?php if($reqSujet == 0){ ?>
            <div style="border-top:1px solid #A2D8D6;padding:1%;">
              <p>Vous n'avez pas encore de sujets ! Allez sur le <a href="forum.php"><b>forum</b></a> pour pouvoir en écrire !</p>
            </div>

            <?php
          } else {
            while($sujet = $sujets->fetch()){
              if($sujet['month_sujet']<10){
                $month_sujet = '0'.$sujet['month_sujet'];
              } else {
                $month_sujet = $sujet['month_sujet'];
              }
              if($sujet['day_sujet']<10){
                $day_sujet =  '0'.$sujet['day_sujet'];
              } else {
                $day_sujet = $sujet['day_sujet'];
              }
              if($sujet['minute_sujet']<10){
                $minute_sujet =  '0'.$sujet['minute_sujet'];
              } else {
                $minute_sujet = $sujet['minute_sujet'];
              }
              if($sujet['hour_sujet']<10){
                $hour_sujet =  '0'.$sujet['hour_sujet'];
              } else {
                $hour_sujet = $sujet['hour_sujet'];
              }
              ?>
              <ul class="list-unstyled" style="border-top:1px solid #A2D8D6;padding:1%;">
                <li><strong>Titre : </strong> <a class="pageProfil" href="lire_sujet_complet.php?id_sujet=<?php echo $sujet['id']; ?>"><?php echo ($sujet['titre']);  ?></a></li>
                <li><strong>Description : </br></strong><?php echo ($sujet['minidescription']);  ?></li>
                <li><strong>Date : </strong><?php echo'Le '.$day_sujet.'/'.$month_sujet.'/'.$sujet['year_sujet'].' à '.$hour_sujet.'h'.$minute_sujet;  ?></li>
              </ul>
            <?php }
          } ?>
        </div>
      </div>
      <div class="row">
        <div class="block2 col-md-12" style="border:2px solid #a2d8d6;background-color:white;margin:0.5px;">
          <h1 style="text-align:center;">Mes events</h1>
          <?php
          if($reqEvent==0){ ?>
            <div style="border-top:1px solid #A2D8D6;padding:1%;">
              <p>Vous n'êtes inscris à aucun evenement, rendez vous sur votre page pour consulter les <a href="evenements.php"><b>evenements</b></a> à venir ! </p>
            </div>
            <?php
          }else{
            while($evenement = $evenements->fetch()){
              ?>
              <ul class="list-unstyled" style="border-top:1px solid #A2D8D6;padding:1%;">
                <li> <strong>Nom : </strong> <a href="eventDetails.php?id=<?php echo($evenement['id_event']); ?>"> <?php echo ($evenement['event']); ?> </a> </li>
              </ul>
            <?php } } ?>
          </div>
        </div>
        <div class="row">
          <div class="block3 col-md-12" style="border:2px solid #a2d8d6;background-color:white;margin:0.5px;">
            <h1 style="text-align:center;">Location</h1>

            <?php if ($reqLocation==0) {
              ?>
              <div style="border-top:1px solid #A2D8D6;padding:1%;">
                <p>Vous disposez d'un appartement magnifique et souhaitez le louer ? Ou alors vous recherchez un hotel pour vos vacances ? Vous retrouvrez tout votre bonheur sur la page de <a href="locations.php"><b>locations</b></a>! </p>
              </div>
              <?php
            }  while($location = $locations->fetch()){ ?>
              <?php
              if($message['month_post']<10){
                $month_creation = '0'.$message['month_post'];
              } else {
                $month_creation = $message['month_post'];
              }
              if($message['day_post']<10){
                $day_creation =  '0'.$message['day_post'];
              } else {
                $day_creation = $message['day_post'];
              }
              if($message['minute_post']<10){
                $minute_creation =  '0'.$message['minute_post'];
              } else {
                $minute_creation = $message['minute_post'];
              }
              if($message['hour_post']<10){
                $hour_creation =  '0'.$message['hour_post'];
              } else {
                $hour_creation = $message['hour_post'];
              }
              ?>
              <ul class="list-unstyled" style="border-top:1px solid #A2D8D6;padding:1%;">
                <li> <strong>Nom : </strong><?php echo ($location['name']); ?></li>
                <li> <strong>Description : </br></strong><?php echo ($location['description']); ?> </li>
                <li> <strong>Date : </strong><?php echo ($location['date_post']); ?> </li>
                <li> <strong>Statut : </strong> <?php if($location['completer']=='1'){ ?>
                  Annonce hors-ligne !
                  <li style="display:inline-block;">
                    <p align="right">
                      <form action="formulaireAnnoncesModifs.php?locations=<?php echo($location['id_lease']); ?>" method="post">
                        <p style="align:left;"><input class="btn btn-info" type="submit" name="lien" value="Modifier l'annonce"></input></p>
                      </form>
                    </p>
                    <p style="float:right;">
                      <a href="verifModifEspace.php?supprimerLocations=<?php echo($location['id_lease']); ?>"><button type="button" class="btn btn-info" name="button">La mettre en ligne</button></a>
                    </p>
                  </li>
                <?php } else { ?>
                  Annonce en ligne !
                  <li>
                    <li style="display:inline-block;">
                      <p align="right">
                        <form action="formulaireAnnoncesModifs.php?locations=<?php echo($location['id_lease']); ?>" method="post">
                          <p style="align:left;"><input class="btn btn-info" type="submit" name="lien" value="Modifier l'annonce"></input></p>
                        </form>
                      </p>
                      <p style="float:right;">
                        <a href="verifModifEspace.php?supprimerLocations2=<?php echo($location['id_lease']); ?>"><button type="button" class="btn btn-info" name="button">La mettre hors-ligne</button></a>
                      </p>
                    </li>
                  </li>
                <?php } ?>
              </li>
            </ul>
          <?php } ?>
        </div>
      </div>
      <div class="row">
        <div class="block4 col-md-12" style="border:2px solid #a2d8d6;background-color:white;">
          <h1 style="text-align:center;">Biens & Services</h1>
          <?php if($reqBien==0) {
            ?>
            <div style="border-top:1px solid #A2D8D6;padding:1%;">
              <p>Vous recherchez ou souhaitez offrir des biens ainsi que des services, rendez-vous sur la plage <a href="services.php"><b>biens & services</b></a>. </p>
            </div>

            <?php
          } else {

            while($bien = $biens->fetch()){

              if($message['month_post']<10){
                $month_creation = '0'.$message['month_post'];
              } else {
                $month_creation = $message['month_post'];
              }
              if($message['day_post']<10){
                $day_creation =  '0'.$message['day_post'];
              } else {
                $day_creation = $message['day_post'];
              }
              if($message['minute_post']<10){
                $minute_creation =  '0'.$message['minute_post'];
              } else {
                $minute_creation = $message['minute_post'];
              }
              if($message['hour_post']<10){
                $hour_creation =  '0'.$message['hour_post'];
              } else {
                $hour_creation = $message['hour_post'];
              } ?>
                <ul class="list-unstyled" style="border-top:1px solid #A2D8D6;padding:1%;">
                  <li> <strong>Nom : </strong><?php echo ($bien['name']); ?></li>
                  <li> <strong>Description : </br></strong><?php echo ($bien['description']); ?> </li>
                  <li> <strong>Date : </strong><?php echo ($bien['date_du_post']); ?> </li>
                  <li><strong>Satut : </strong><?php if($bien['completer']=='1'){ ?>
                    Annonce hors-ligne ! </li>
                    <li style="display:inline-block;">
                      <p align="right">
                        <form   action="formulaireAnnoncesModifs.php?biens=<?php echo($bien['id_goods']); ?>" method="post">
                          <p style="align:left;"><input class="btn btn-info" type="submit" name="lien" value="Modifier l'annonce"></input></p>
                        </form>
                      </p>
                      <p style="float:right;">
                        <a href="verifModifEspace.php?supprimerBS2=<?php echo($bien['id_goods']); ?>"><button type="button" class="btn btn-info" name="button">La mettre en ligne</button></a>
                      </p>
                    </li>
                  </ul>
                <?php } else { ?>
                  Annonce en ligne ! </li>
                  <li style="display:inline-block;">
                    <p align="right">
                      <form   action="formulaireAnnoncesModifs.php?biens=<?php echo($bien['id_goods']); ?>" method="post">
                        <p style="align:left;"><input class="btn btn-info" type="submit" name="lien" value="Modifier l'annonce"></input></p>
                      </form>
                    </p>
                    <p style="float:right;">
                      <a href="verifModifEspace.php?supprimerBS=<?php echo($bien['id_goods']); ?>"> <button type="button" class="btn btn-info" name="button">La mettre hors-ligne</button></button></a>
                    </p>
                  </li>
                </ul>
            <?php } ?>
          <?php } ?>
        <?php } ?>
      </div>

    </div>
  </div>
  <?php include('footer.php'); ?>
</body>
</html>

<?php
}
?>
