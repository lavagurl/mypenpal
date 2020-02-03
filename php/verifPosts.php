<?php
session_start();
include('connexionBDD.php');

if(isset($_POST['message_perso'])){

	if(!(empty($_POST['message_perso']))){
		if(strlen($_POST['message_perso'])<200){
			$pseudo = htmlspecialchars($_GET['pseudo']);
			$contenu = htmlspecialchars($_POST['message_perso']);

			$insertmessage = $bdd->prepare("INSERT INTO posts_perso (pseudo, date_post, contenu) VALUES ('${pseudo}', CURRENT_TIMESTAMP(), :message_perso)");
			$insertmessage ->execute(array
			("message_perso"=> $contenu)
		);
		header("Location: pageActuProfil.php");
		} else {
			?>
			<script type="text/javascript">
			alert("|| ERREUR || Il y a trop de caractères ! (200 maximum)");
			document.location.href = 'pageActuProfil.php';
			</script>
			<?php
			}
	}

	else {
		?>
		<script type="text/javascript">
		alert("|| ERREUR || Il n'y a pas de contenu !");
		document.location.href = 'pageActuProfil.php';
		</script>
		<?php
	}

}else{
	$id_post = $_GET['id_post'];
	if(isset($_POST['supprimerPost'])) {
		//$modif = '1';
		$updateSujet = $bdd->query("UPDATE `posts_perso` SET `statut` = '1' WHERE `posts_perso`.`id`='$id_post' ");
		//$updateSujet ->execute(array
		//($modif)
		//);
		?>
		<script type="text/javascript">
		alert("Post supprimé!");
		document.location.href = 'pageActuProfil.php';
		</script>
		<?php
	}

}


?>
