<?php
session_start();
include('connexionBDD.php');

//	$champs=array('name','event');
$name=htmlspecialchars($_GET['name']);
$id=htmlspecialchars($_GET['id']);
$type='event';
$bool=1;
$req=$bdd->prepare('INSERT INTO inscriptionevent(event,name) VALUES (:data,:id)');

$sql=$bdd->prepare('INSERT INTO notifications(id_post,id_envoi,id_receveur,status,status_vu,type,date_notif,name)
VALUES(:id_post,:id_envoi,:id_receveur,:status,:status_vu,:type,NOW(),:name)');

$sql ->execute(array(
  "id_post"=>$id,
  "id_envoi"=>$_SESSION["id"],
  "id_receveur"=>$_SESSION["id"],
  "status"=>$bool,
  "status_vu"=>$bool,
  "type"=>$type,
  "name"=>$name,
));

$req ->execute(array
		('data'=>$id,
    'id'=>$_SESSION['id']
		));

	header("Location:mercievent.php");
	exit;

	?>
