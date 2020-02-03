<?php
session_start();
include('connexionBDD.php');

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body>
		<?php
		$pseudo_rece = htmlspecialchars($_GET['envoyeur']);
		if(!(empty($_POST['message_complet']))){
			if(!(empty($pseudo_rece))){
				if(!(empty($_POST['message_titre']))){
					$pseudo_rece = htmlspecialchars($_GET['envoyeur']);
					$pseudo_exp = htmlspecialchars($_SESSION['pseudo']);
					$message_titre = htmlspecialchars($_POST['message_titre']);
					$message_complet = htmlspecialchars($_POST['message_complet']);

					$insertsujet = $bdd->prepare("INSERT INTO messagerie_privee (mp_expediteur, mp_receveur, mp_titre, mp_text, mp_time, mp_lu) VALUES (:pseudo_exp, :pseudo_rece, :message_titre, :message_complet, NOW(), '0')");
					$insertsujet ->execute(array
					("pseudo_exp" => $pseudo_exp,
					"pseudo_rece"=> $pseudo_rece,
					"message_titre"=> $message_titre,
					"message_complet"=> $message_complet)
				);

        $req=$bdd->query("SELECT id FROM member WHERE name='${pseudo_rece}'");
        $request=$req->fetch();
        $id_receveur=$request['id'];
        $insertnotif=$bdd->prepare("INSERT INTO notifications (id_envoi,id_receveur,status,status_vu,type,date_notif,name) VALUES (:id_envoi,:id_receveur,1,1,'message',NOW(),:name)");
        $insertnotif->execute(array
        ("id_envoi"=>$_SESSION['id'],
        "id_receveur"=>$id_receveur,
        "name"=>$pseudo_exp,

      ));


        ?>
				<script type="text/javascript">
				alert("Votre message a été envoyé !");
				document.location.href = 'messagerie.php';
				</script>
				<?php
			} else {
				?>
				<script type="text/javascript">
				alert("|| ERREUR || Vous n'avez pas mis d'objet !");
				document.location.href = 'messagerie_mp.php?envoyeur=<?php echo($pseudo_rece); ?>';
				</script>
				<?php
			}
		} else {
			?>
			<script type="text/javascript">
			alert("|| ERREUR || Vous n'avez pas mis de destinataire !");
			document.location.href = 'messagerie_mp.php?envoyeur=<?php echo($pseudo_rece); ?>';
			</script>
			<?php
		}

		}
		else {
			?>
			<script type="text/javascript">
			alert("|| ERREUR || Il n'y a pas de contenu !");
			document.location.href = 'messagerie_mp.php?envoyeur=<?php echo($pseudo_rece); ?>';
			</script>
			<?php
		}
		?>

	</body>
</html>
