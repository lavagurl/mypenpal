<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <script type="text/javascript">

    $(document).ready(function(){
      var off=0;

    $("#button").click(function () {
    $.ajax({
      type:"GET",
      url:"getNotif.php",
     data:{
        'offset': off,
        'limit':10
      },
      success:
      function(data){
        console.log("chala");
        $('body').append(data);
        off=off+10;
    }
    });


    });
    });

    </script>

  </body>
</html>

<?php
session_start();
if(!isset($_SESSION['id'])){
  header("Location: connexion.php");
}else{
include ('connexionBDD.php');
if(isset($_GET['offset']) && isset($_GET['limit'])){
  $date=date('d-m-Y');
  $limit=$_GET['limit'];
  $offset=$_GET['offset'];
  $sql = ("SELECT notifications.id_notif as id_notif, notifications.id_post as post, notifications.name as post_name, notifications.id_envoi as envoi,
    notifications.id_receveur as receveur, notifications.status as status, notifications.status_vu as status_vu, notifications.type as type,notifications.date_notif as date_notif,member.name as name,lease.name as lease FROM notifications
    INNER JOIN member ON notifications.id_envoi=member.id INNER JOIN lease ON notifications.id_post=lease.id_lease WHERE id_receveur='{$_SESSION['id']}' ORDER BY id_notif DESC LIMIT {$limit} OFFSET {$offset}");
  foreach($bdd->query($sql) as $notif) {

    if ($notif['type']=='location' && $notif['status']==1){
      echo ' Il y a une réponse à votre annonce '.$notif['lease'].' dans la rubrique location , vérifiez vos mails!'?> <a href="pageEspaceProfil.php"><u>N'oubliez pas de supprimer l'annonce une fois l'échange terminé </u></a> <br><br><?php
    }
    if ($notif['type']=='location' && $notif['status']==0){
      ?><i> Il y a une réponse à votre annonce <?php echo $notif['lease'] ?> dans la rubrique location , vérifiez vos mails!</i> <a href="pageEspaceProfil.php"><u>N'oubliez pas de supprimer l'annonce une fois l'échange terminé </u></a> <br><br>
    <?php }


    if ($notif['type']=='echange' && $notif['status']==1){
      echo 'Il y a une réponse à votre annonce de la rubrique biens et échanges, vérifiez vos mails!'?> <a href="pageEspaceProfil.php"><u>N'oubliez pas de supprimer l'annonce une fois l'échange terminé </u></a> <br><br><?php
    }

  if ($notif['type']=='echange' && $notif['status']==0){
      ?><i>  Il y a une réponse à votre annonce de la rubrique biens et échanges, vérifiez vos mails!'</i> <a href="pageEspaceProfil.php"><u>N'oubliez pas de supprimer l'annonce une fois l'échange terminé </u></a> <br><br><?php
    }

/*
    if ($notif['type']=='message' && $notif['status']==1){
      echo 'Vous avez reçu un message de '.$notif['name']; ?> <br>
      <a href="messagerie_mp.php?id_message=<?php $notif['post'] ?>">Lire le message</a>
      <br> <?php

    }

      if ($notif['type']=='message' && $notif['status']==0){
            echo 'ANCIEN Vous avez reçu un message de '.$notif['name']; ?> <br>
            <a href="messagerie_mp.php?id_message=<?php $notif['post'] ?>">Lire le message</a>
            <br> <?php
        }*/
    if($notif['date_notif']=$date && $notif['type']=='event'&& $notif['status']==1){
      echo "N'oubliez pas demain votre event ".$notif['post_name']?> <a href="eventDetails.php?id=<?php echo $notif['post']?>"> UYaha </a> <br><br> <?php
    }
    if( $notif['type']=='event'&& $notif['status']==0){
      ?><i>Vous avez un event </i> <a href="eventDetails.php?id=<?php echo $notif['post']?>"> <?php echo $notif['post_name'] ?> </a> <br><br> <?php
    }

}
  $j="UPDATE notifications SET status=0 AND status_vu=0 WHERE id_receveur='{$_SESSION['id']}'";
$req=$bdd->prepare($j);
$req->execute();

}}
?>
