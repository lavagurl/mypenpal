<?php
session_start();
if(!isset($_SESSION['id'])){
  header("Location: connexion.php");
}else{
include ('connexionBDD.php');
 $req=$bdd->query('SELECT COUNT(id_notif) as number FROM notifications WHERE notifications.status=1 AND notifications.type="message" AND id_receveur='.$_SESSION['id']);
while($msg = $req -> fetch()){
  echo $msg['number'];
}
}
   ?>
