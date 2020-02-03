<?php
session_start();
if(!isset($_SESSION['pseudo'])){
  header("Location: connexion.php");
}else{
  include('connexionBDD.php');
  if(isset($_GET['envoyeur'])){
  $pseudoEnvoyeur = htmlspecialchars($_GET['envoyeur']);
  $pseudoReceveur = $_SESSION['pseudo'];

  $msgsConv = $bdd->query("SELECT DAY(mp_time) as day_mp, MONTH(mp_time) as month_mp, YEAR(mp_time) as year_mp, HOUR(mp_time) as hour_mp, MINUTE(mp_time) as minute_mp, mp_text, mp_receveur, mp_expediteur, mp_titre FROM messagerie_privee WHERE mp_expediteur = '${pseudoEnvoyeur}' OR (mp_expediteur = '${pseudoReceveur}' AND mp_receveur = '${pseudoEnvoyeur}' ) ORDER BY mp_time ASC ");
  $reqConv = $msgsConv->rowCount();

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

    <title>Messagerie</title>
  </head>
  <body>
    <?php include('header.php')?>
    <?php include('not.php')?>
    <div class="container" style="text-align: justify;margin-top:2%;">
      <section style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
        <h1  class="cursor_none">Votre messagerie privée</h1>
      </section>
      <h3  class="cursor_none"> Votre conversation avec <?php echo $pseudoEnvoyeur; ?>: </h3>
        <div id="messagePrives">
        <?php if ($reqConv ==0) { ?>
          <div class="block col-md-7" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
            <p>Il n'y a pas de messages dans cette conversation ! Soyez la première personne à en envoyer un. </p>
          </div>

          <?php
        } else {

          while($msgConv = $msgsConv->fetch()){ ?>
          <?php if($msgConv['mp_receveur']==$_SESSION['pseudo']){
            $message_titre = $msgConv['mp_titre'];
            if($msgConv['minute_mp']<10){
              $minute_mp =  '0'.$msgConv['minute_mp'];
            } else{
              $minute_mp = $msgConv['minute_mp'];
            }
            if($msgConv['month_mp']<10){
              $month_mp = '0'.$msgConv['month_mp'];
            } else {
              $month_mp = $msgConv['month_mp'];
            }
            if($msgConv['day_mp']<10){
              $day_mp =  '0'.$msgConv['day_mp'];
            } else {
              $day_mp = $msgConv['day_mp'];
            }
            if($msgConv['hour_mp']<10){
              $hour_mp =  '0'.$msgConv['hour_mp'];
            } else {
              $hour_mp = $msgConv['hour_mp'];
            } ?>
              <div class="block col-md-7" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;margin:0 auto;">
                <b>De :</b> <?php echo $msgConv['mp_expediteur']; ?> </br>
                <b>Le :</b> <?php echo $day_mp.'/'.$month_mp.'/'.$msgConv['year_mp'].' <b>à</b>  '.$hour_mp.'h'.$minute_mp ?></br>
                <p>
                  <?php echo $msgConv['mp_text']; ?>
                </p>
              </div>
        <?php
      } else {
          if($msgConv['mp_expediteur']==$_SESSION['pseudo']){
            $message_titre = $msgConv['mp_titre'];
            if($msgConv['statut']==1){ ?>
              <div class="block col-md-7" style="border:5px solid #b1d1d0;padding:3%;background:#c4c2c2;color:black;border-radius:5px;">
                <p>Ce message a été supprimé :(</p>
              </div>
            <?php } else {
            if($msgConv['minute_mp']<10){
              $minute_mp =  '0'.$msgConv['minute_mp'];
            } else{
              $minute_mp = $msgConv['minute_mp'];
            }
            if($msgConv['month_mp']<10){
              $month_mp = '0'.$msgConv['month_mp'];
            } else {
              $month_mp = $msgConv['month_mp'];
            }
            if($msgConv['day_mp']<10){
              $day_mp =  '0'.$msgConv['day_mp'];
            } else {
              $day_mp = $msgConv['day_mp'];
            }
            if($msgConv['hour_mp']<10){
              $hour_mp =  '0'.$msgConv['hour_mp'];
            } else {
              $hour_mp = $msgConv['hour_mp'];
            } ?>
              <div class="block col-md-7" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;margin:0 auto;">
                <b>De :</b> <?php echo $msgConv['mp_expediteur']; ?> </br>
                <b>Le :</b> <?php echo $day_mp.'/'.$month_mp.'/'.$msgConv['year_mp'].' <b>à</b>  '.$hour_mp.'h'.$minute_mp ?></br>
                <p>
                  <?php echo $msgConv['mp_text']; ?>
                </p>
              </div>
          <?php
          }
        }
        }

      }
    } ?>
  </div>
        <div class="block1 col-sm-4 col-md-9" style="margin:0 auto;background-color: white;padding:3%;">
              <form class="" action="verifMP.php?envoyeur=<?php echo($pseudoEnvoyeur); ?>" method="post">
          </article>
          <article class="message">
            <h5>Répondre :</h5>
            <p><strong>À :</strong></p><input type="text" name="pseudo_rece" value="<?php echo($pseudoEnvoyeur); ?>" readonly="readonly">
            <p><strong>Objet :</strong></p><input type="text" name="message_titre" value="<?php echo($message_titre); ?>"/>
            <p><strong>Votre message :</strong></p>
            <textarea name="message_complet" rows="8" cols="55"></textarea>
            <input class="btn btn-info" type="submit" name="" value="Envoyer"/>
          </article>
            </form>
      </div>
      <script type="text/javascript">

      document.getElementById('messagePrives').scrollTop = document.getElementById('messagePrives').scrollHeight;
      </script>


    </div>
    <?php include('footer.php'); ?>
  </body>
  </html>

<?php }
}
?>
