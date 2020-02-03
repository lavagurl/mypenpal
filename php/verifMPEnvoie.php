<?php
session_start();
include('connexionBDD.php');
if(!(empty($_POST['message_complet']))){
	if(!(empty($_POST['pseudo_rece']))){
		if(!(empty($_POST['message_titre']))){
			$pseudo_exp = htmlspecialchars($_SESSION['pseudo']);
			$pseudo_rece = htmlspecialchars($_POST['pseudo_rece']);
			$message_titre = htmlspecialchars($_POST['message_titre']);
			$message_complet = htmlspecialchars($_POST['message_complet']);

			$insertsujet = $bdd->prepare("INSERT INTO messagerie_privee (mp_expediteur, mp_receveur, mp_titre, mp_text, mp_lu) VALUES (:pseudo_exp, :pseudo_rece, :message_titre, :message_complet, '0')");
			$insertsujet ->execute(array
			("pseudo_exp" => $pseudo_exp,
			"pseudo_rece"=> $pseudo_rece,
			"message_titre"=> $message_titre,
			"message_complet"=> $message_complet)
		); ?>
		<script type="text/javascript">
		alert("Votre message a été envoyé !");
		document.location.href = 'messagerie_mp.php?receveur='.<?php echo($pseudo_rece); ?>;
		</script>
		<?php
	} else {
		?>
		<script type="text/javascript">
		alert("|| ERREUR || Vous n'avez pas mis de titre !");
		document.location.href = 'messagerie_mp_nouveau.php';
		</script>
		<?php
	}
} else {
	?>
	<script type="text/javascript">
	alert("|| ERREUR || Vous n'avez pas mis de destinataire !");
	document.location.href = 'messagerie_mp_nouveau.php';
	</script>
	<?php
}
}
else {
	?>
	<script type="text/javascript">
	alert("|| ERREUR || Il n'y a pas de contenu !");
	document.location.href = 'messagerie_mp_nouveau.php';
	</script>
	<?php
}
?>
