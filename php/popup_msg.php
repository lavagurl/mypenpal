<?php
session_start();
if(!isset($_SESSION['id'])){
  header("Location: connexion.php");
}else{
include ('connexionBDD.php');
/*$lease=("SELECT notifications.id_notif as id_notif, notifications.id_post as post, notifications.name as post_name, notifications.id_envoi as envoi,
  notifications.id_receveur as receveur, notifications.status as status,  notifications.status_vu as status_vu, notifications.type as type,notifications.date_notif as date_notif,member.name as name,lease.name as lease FROM notifications
  INNER JOIN member ON notifications.id_envoi=member.id INNER JOIN lease ON notifications.id_post=lease.id_lease WHERE id_receveur='{$_SESSION['id']}'"); ?>
*/
$not=("SELECT * FROM notifications WHERE id_receveur='{$_SESSION['id']}'"); ?>

<?php

   foreach($bdd->query($not) as $notif) {
     if($notif['status_vu']==1){


if ($notif['type']=='message' && $notif['status']==1 && $notif['status_vu']==1){

  ?>
  <script type="text/javascript">
  $("#alert_msg").fadeTo(4000, 500).slideUp(500, function(){
});
function vu(){
$.ajax({
url:"vu.php?id=<?php echo $notif['id_notif'] ?>",
method:"GET",
success:function()
{
console.log('success')   }
})}

  </script>

  <div class="alert alert-warning alert-dismissible" id=alert_msg role="alert">
    <?php
    echo 'Vous avez reçu un message'?><a href="messagerie.php"><u> Passez voir votre messagerie privée </u></a>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="vu()" >
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php
}

$j="UPDATE notifications SET status_vu=0 WHERE id_notif='{$notif['id_notif']}' AND id_receveur='{$_SESSION['id']}'";
$req=$bdd->prepare($j);
$req->execute();
}}} ?>
