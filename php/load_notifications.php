<?php
session_start();
if(!isset($_SESSION['id'])){
  header("Location: connexion.php");
}else{
include ('connexionBDD.php');
           $sql=$bdd->query('SELECT COUNT(id_notif) as number FROM notifications WHERE notifications.status=1 AND (notifications.type="location" OR notifications.type="echange" OR notifications.type="forum" OR notifications.type="amis") AND id_receveur='.$_SESSION['id']);
while($notif = $sql -> fetch()){
  echo $notif['number'];
}}
 ?>
