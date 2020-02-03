<?php
include('connexionBDD.php');

if(empty($_POST['message'])){
}else{
	$req=$bdd->prepare('INSERT INTO messages_chat (content, name_user, creation_date) VALUES (:content, :name_user, NOW())');
	$req->execute(array(
					'content'=>htmlspecialchars($_POST['message']),
					'name_user'=>htmlspecialchars($_POST['name_user'])
				));

	//Redirection vers l'index
	//header('location: index.php');
}


?>
