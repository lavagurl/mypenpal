<?php
session_start();
if(!isset($_SESSION['id'])){
  header("Location: connexion.php");
}else{
include ('connexionBDD.php');
 $j="UPDATE notifications SET status=0 WHERE id_notif='{$_GET['id']}' AND id_receveur='{$_SESSION['id']}'";
$req=$bdd->prepare($j);
$req->execute();
}
