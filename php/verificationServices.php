<?php
session_start();
	include('connexionBDD.php');

	$champs=array('name','position','description');
	$name=htmlspecialchars($_POST['name']);
  $position=htmlspecialchars($_POST['position']);
	$description=htmlspecialchars($_POST['description']);

	foreach ($champs as $value) {
		if(!isset($_POST[$value]) || empty($_POST[$value]))
		{
			header("Location:formulaireBiens.php?error=".$value);
			exit;
		}
	}

$req=$bdd->prepare('INSERT INTO goods(name,position,date_du_post,description,member) VALUES(:name,:position,NOW(),:description,'.$_SESSION["id"].')');

$req ->execute(array
		('name'=>$name,
		'position'=>$position,
    'description'=>$description,

		));

	$_SESSION['name']=$name;
  $_SESSION['description']=$description;

	header("Location:services.php");
	exit;

	?>
