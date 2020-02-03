<?php
session_start();
include('connexionBDD.php');
$modif = '0';
$statutConnexion = $bdd->prepare("UPDATE member SET status = ? WHERE id='{$_SESSION['id']}' ");
$statutConnexion ->execute(array
($modif)
);
session_destroy();
header("Location: connexion.php");

?>
