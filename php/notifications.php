<?php
session_start();
if(!isset($_SESSION['id'])){
  header("Location: connexion.php");
}else{
  include ('connexionBDD.php');
  ?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Mes notifications</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles2.css">
    <link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon" />

  </head>
  <body>
    <?php include('header.php'); ?>

    <div class="container" style="margin-top:2%;">
      <center>
        <section class="block1 col-md-5" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
          <h1>Notifications</h1>
        </section>
      </center>
      <br><br>

      <div id="#amis" class="block1" style="text-align:center;border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;margin-top:2%;margin-bottom:2%;">
        <?php

        $date=date("Y-m-d");
        $sql = ("SELECT notifications.id_notif as id_notif, notifications.id_post as post, notifications.name as post_name, notifications.id_envoi as envoi,
          notifications.id_receveur as receveur, notifications.status as status, notifications.status_vu as status_vu, notifications.type as type,notifications.date_notif as date_notif,
          DAY(notifications.date_notif) as day_notif, MONTH(notifications.date_notif) as month_notif, YEAR(notifications.date_notif) as year_notif, HOUR(notifications.date_notif) as hour_notif,MINUTE(notifications.date_notif) as min_notif,member.name as name,lease.name as lease FROM notifications
          INNER JOIN member ON notifications.id_envoi=member.id INNER JOIN lease ON notifications.id_post=lease.id_lease WHERE id_receveur='{$_SESSION['id']}' ORDER BY id_notif DESC ");
          $reqAmis = $bdd->query("SELECT * from notifications WHERE id_receveur= '{$_SESSION['id']}' ORDER BY id_notif DESC");

          ?>
          <h2> VOS DEMANDES D'AMITIE </h2>
          <?php

          while($notifAmis = $reqAmis->fetch()){

            if ($notifAmis['type']=="amis" && $notifAmis['status']=="1"){
              echo $notifAmis['name'].' vous a envoyé une demande d\'ami ! Voulez vous <a href="demandeAmis.php?ami_accepter='.$notifAmis['name'].'">accepter</a> ou <a href="demandeAmis.php?ami_refuser='.$notifAmis['name'].'">refuser</a> ? </br></br>';
            }
            if ($notifAmis['type']=="amis" && $notifAmis['status']=="0"){
              ?>
              <i> Vous avez reçu une demande d'ami de <?php echo $notifAmis['name'] ?> ! Voulez vous <a href="demandeAmis.php?ami_accepter=<?php echo ($notifAmis['name']);?>">accepter</a> ou <a href="demandeAmis.php?ami_refuser=<?php echo($notifAmis['name']); ?>">refuser</a> ? </i></br></br>
            <?php         }
          }

          ?>
        </div>
        <div id="#annoncesbsL" class="block1" style="text-align:center;border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;margin-top:2%;margin-bottom:2%;">
          <?php

          $reqForum = $bdd->query("SELECT * from notifications WHERE id_receveur= '{$_SESSION['id']}' AND type='forum' ORDER BY id_notif DESC");

          ?>
          <h2> REPONSES FORUM </h2>
          <?php

          while($notifForum=$reqForum->fetch()){
            ?><?php
            if ($notifForum['type']=='forum' && $notifForum['status']==1){
              echo 'Il y a une réponse à votre sujet '.$notif['name'].' dans la rubrique forum ' ?><a href="forum.php"><u> Allez voir !</u></a><br><br><?php
            }


            if ($notifForum['type']=='forum' && $notifForum['status']==0){
              ?><i> Il y a eu une réponse à votre sujet <?php echo $notif['name'] ?> dans la rubrique forum le </i> <a href="forum.php"><u> Allez voir! </u></a><br><br>

            <?php }
          }

          ?>
        </div>
        <div id="#annoncesbsL" class="block1" style="text-align:center;border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;margin-top:2%;margin-bottom:2%;">
          <h2> REPONSES A VOS ANNONCES </h2>
          <?php
          foreach($bdd->query($sql) as $notif) {
            if($notif['min_notif']<10){
              $min='0'.$notif['min_notif'];
            } else{
              $min = $notif['min_notif'];
            }
            if($notif['month_notif']<10){
              $month= '0'.$notif['month_notif'];
            } else {
              $month= $notif['month_notif'];
            }
            if($notif['day_notif']<10){
              $day =  '0'.$notif['day_notif'];
            } else {
              $day =$notif['day_notif'];
            }
            if($notif['hour_notif']<10){
              $hour =  '0'.$notif['hour_notif'];
            } else {
              $hour =$notif['hour_notif'];
            }


            if ($notif['type']=='location' && $notif['status']==1){
              echo 'Il y a une réponse à votre annonce '.$notif['lease'].' dans la rubrique location le '.$day.'/'.$month.'/'.$notif['year_notif'].' à '.$hour.':'.$min.', vérifiez vos mails!'?> <a href="pageEspaceProfil.php"><u>N'oubliez pas de supprimer l'annonce une fois l'échange terminé </u></a><br><br></div><?php
            }
            if ($notif['type']=='location' && $notif['status']==0){
              ?><i> Il y a eu une réponse à votre annonce <?php echo $notif['lease'] ?> dans la rubrique location le <?php echo $day.'/'.$month.'/'.$notif['year_notif'].' à '.$hour.':'.$min ?>, vérifiez vos mails!</i> <a href="pageEspaceProfil.php"><u>N'oubliez pas de supprimer l'annonce une fois l'échange terminé </u></a><br><br>

              <?php
            }
            if ($notif['type']=='echange' && $notif['status']==1){
              echo 'Il y a une réponse à votre annonce de la rubrique biens et échanges le '.$day.'/'.$month.'/'.$notif['year_notif'].' à '.$hour.':'.$min.', vérifiez vos mails!'?> <a href="pageEspaceProfil.php"><u>N'oubliez pas de supprimer l'annonce une fois l'échange terminé </u></a> <br><br><?php
            }

            if ($notif['type']=='echange' && $notif['status']==0){
              ?><i>  Il y a une réponse à votre annonce de la rubrique biens et échanges le <?php echo $day.'/'.$month.'/'.$notif['year_notif'].' à '.$hour.':'.$min ?>, vérifiez vos mails!'</i> <a href="pageEspaceProfil.php"><u>N'oubliez pas de supprimer l'annonce une fois l'échange terminé </u></a> <br><br><?php
            }
            if ($notif['type']=='forum' && $notif['status']==1){
              echo 'Il y a une réponse à votre sujet '.$notif['name'].' dans la rubrique forum le '.$day.'/'.$month.'/'.$notif['year_notif'].' à '.$hour.':'.$min.'.'?> <a href="forum.php"><u> Allez voir !</u></a><br><br></div><?php
            }
            if ($notif['type']=='forum' && $notif['status']==0){
              ?><i> Il y a eu une réponse à votre sujet <?php echo $notif['name'] ?> dans la rubrique forum le <?php echo $day.'/'.$month.'/'.$notif['year_notif'].' à '.$hour.':'.$min ?></i> <a href="forum.php"><u> Allez voir! </u></a><br><br>

              <?php
            } }
            $j="UPDATE notifications SET status=0 AND status_vu=0 WHERE id_receveur='{$_SESSION['id']}'";
            $req=$bdd->prepare($j);
            $req->execute();

            ?>
          </div>
          <br><br><br>
        </div>

        <?php include('footer.php'); ?>

      </body>

      </html>
    <?php } ?>
