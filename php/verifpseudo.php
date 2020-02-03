<?php
include('connexionBDD.php');
{

	$pseudo = htmlspecialchars($_POST['pseudo']);
	$reqpseudo = $bdd->prepare("SELECT * FROM member WHERE name = ? ");
	$reqpseudo->execute(array("$pseudo"));
	$pseudoexist = $reqpseudo->rowCount();
	if($pseudoexist != 0)
	{
		echo 'Pseudo indisponible';

	}else {
		echo 'Pseudo disponible';

	}
}


 ?>
