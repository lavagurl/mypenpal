<?php
session_start();
include('connexionBDD.php');
$id_sujet = htmlspecialchars($_GET['id_sujet']);
if(!(empty($_POST['message']))){
	$pseudo = htmlspecialchars($_SESSION['pseudo']);
	$message = htmlspecialchars($_POST['message']);
	$info = $bdd->query("SELECT * FROM forum_sujets where id = '$id_sujet'");
	$infos = $info -> fetch();
	$titre = $infos['titre'];

	$reqMessage = $bdd->prepare("SELECT * FROM forum_reponses WHERE message = ?");
	$reqMessage -> execute(array("$message"));
	$messageExist = $reqMessage->rowCount();
		if($messageExist == 0){
			$insertMessage= $bdd->prepare("INSERT INTO forum_reponses (auteur, message, date_reponse, correspondance_sujet) VALUES (:paramMembre, :message, NOW(), :id_sujet)");
			$insertMessage ->execute(array
			("paramMembre" => $pseudo,
			"message"=> $message,
			"id_sujet"=> $id_sujet)
		);
       
 $req=$bdd->query("SELECT member.id as id FROM member INNER JOIN forum_sujets ON forum_sujets.auteur=member.name WHERE forum_sujets.id='${id_sujet}'");
        $request=$req->fetch();
        $id_receveur=$request['id'];
        $insertnotif=$bdd->prepare("INSERT INTO notifications (id_post,id_envoi,id_receveur,status,status_vu,type,date_notif,name) VALUES (:id_post,:id_envoi,:id_receveur,1,1,'forum',NOW(),:name)");
        $insertnotif->execute(array
        ("id_post" =>$id_sujet,
	"id_envoi"=>$_SESSION['id'],
        "id_receveur"=>$id_receveur,
        "name"=>$infos['titre'],

      ));

		header("Location: lire_sujet_complet.php?id_sujet=${id_sujet}");
	} else {
		?>
 	 <script type="text/javascript">
 	 	alert("|| ERREUR || Cette réponse existe déjà  !");
 		document.location.href = 'insert_reponse.php?id_sujet=<?php echo ($id_sujet);  ?>';
 	 </script>
 	 <?php
	}
	}
	else {
	 ?>
	 <script type="text/javascript">
	 	alert("|| ERREUR || Votre message est vide !");
		document.location.href = 'insert_reponse.php?id_sujet=<?php echo ($id_sujet);  ?>';
	 </script>
	 <?php
	}
?>
