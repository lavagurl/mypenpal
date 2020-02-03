<?php
session_start();
include('connexionBDD.php');


$categorie = htmlspecialchars($_POST['category']);
if(!(empty($_POST['sujet_complet']))){
	if(!(empty($_POST['minidescription']))){
		if(!(empty($_POST['titre']))){
		$pseudo = htmlspecialchars($_GET['paramMembre']);
		$titre = htmlspecialchars($_POST['titre']);
		$minidesc = htmlspecialchars($_POST['minidescription']);
		$desc = htmlspecialchars($_POST['sujet_complet']);

		$reqtitre = $bdd->prepare("SELECT * FROM forum_sujets WHERE titre = ?");
		$reqtitre -> execute(array("$titre"));
		$titreexist = $reqtitre->rowCount();
		if($titreexist == 0){
			$reqminDesc = $bdd->prepare("SELECT * FROM forum_sujets WHERE minidescription = ?");
			$reqminDesc -> execute(array("$minidesc"));
			$minDescexist = $reqminDesc->rowCount();
			if($minDescexist == 0){
				$reqDesc = $bdd->prepare("SELECT * FROM forum_sujets WHERE sujet_complet = ?");
				$reqDesc -> execute(array("$desc"));
				$descExist = $reqDesc->rowCount();
				if($descExist == 0){
					$insertsujet = $bdd->prepare("INSERT INTO forum_sujets (auteur, titre, date_derniere_reponse, category, minidescription, sujet_complet) VALUES (:paramMembre, :titre, NOW(), :category, :minidescription,:sujet_complet)");
					$insertsujet ->execute(array
					("paramMembre" => $pseudo,
					"titre"=> $titre,
					"category"=> $categorie,
					"minidescription"=> $minidesc,
					"sujet_complet"=> $desc)
				);
				header("Location: lire_sujet.php?theme=${categorie}");
			} else {
				?>
				<script type="text/javascript">
				alert("|| ERREUR || Ce sujet existe déjà !");
				document.location.href = 'insert_sujet.php?thm=<?php echo ($categorie); ?>';
				</script>
				<?php
			}
		} else {
			?>
			<script type="text/javascript">
			alert("|| ERREUR || Cette mini description existe déjà !");
			document.location.href = 'insert_sujet.php?thm=<?php echo ($categorie); ?>';
			</script>
			<?php
		}
	} else{
		?>
		<script type="text/javascript">
		alert("|| ERREUR || Ce titre existe déjà !");
		document.location.href = 'insert_sujet.php?thm=<?php echo ($categorie); ?>';
		</script>
		<?php
	}
} else {
	?>
	<script type="text/javascript">
	alert("|| ERREUR || Vous n'avez pas mis de titre !");
	document.location.href = 'insert_sujet.php?thm=<?php echo ($categorie); ?>';
	</script>
	<?php
}
} else {
	?>
	<script type="text/javascript">
	alert("|| ERREUR || Vous n'avez pas mis de mini description !");
	document.location.href = 'insert_sujet.php?thm=<?php echo ($categorie); ?>';
	</script>
	<?php
}
}
else {
	?>
	<script type="text/javascript">
	alert("|| ERREUR || Il n'y a pas de contenu !");
	document.location.href = 'insert_sujet.php?thm=<?php echo ($categorie); ?>';
	</script>
	<?php
}
?>
