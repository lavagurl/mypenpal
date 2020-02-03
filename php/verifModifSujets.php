<?php
session_start();
include('connexionBDD.php');

$id = $_GET['id'];
if(!(empty($_POST['sujet_complet']))){
	if(!(empty($_POST['minidescription']))){
		if(!(empty($_POST['titre']))){
			$titre = htmlspecialchars($_POST['titre']);
			$minidesc = htmlspecialchars($_POST['minidescription']);
			$desc = htmlspecialchars($_POST['sujet_complet']);


			$updateSujet = $bdd->prepare("UPDATE forum_sujets SET titre = ? WHERE id = '${id}'");
			$updateSujet ->execute(array
			($titre)
		);
		$updateMiniDesc = $bdd->prepare("UPDATE forum_sujets SET  minidescription = ? WHERE id = '${id}'");
		$updateMiniDesc ->execute(array
		($minidesc)
	);
	$updateDesc = $bdd->prepare("UPDATE forum_sujets SET sujet_complet = ? WHERE id = '${id}'");
	$updateDesc ->execute(array
	($desc)
);
header("Location: lire_sujet_complet.php?id_sujet=${id}");


} else {
	?>
	<script type="text/javascript">
	alert("|| ERREUR || Vous n'avez pas mis de titre !");
	document.location.href = 'modifs_sujet.php?id_sujet=<?php echo ($id); ?>';
	</script>
	<?php
}
} else {
	?>
	<script type="text/javascript">
	alert("|| ERREUR || Vous n'avez pas mis de mini description !");
	document.location.href = 'modifs_sujet.php?id_sujet=<?php echo ($id); ?>';
	</script>
	<?php
}
}
else {
	?>
	<script type="text/javascript">
	alert("|| ERREUR || Il n'y a pas de contenu !");
	document.location.href = 'modifs_sujet.php?id_sujet=<?php echo ($id); ?>';
	</script>
	<?php
}
?>
