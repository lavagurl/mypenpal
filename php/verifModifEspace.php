<?php
session_start();
include('connexionBDD.php');

if(isset($_GET['supprimerBS']) AND !empty($_GET['supprimerBS'])) {
  $idSupp = htmlspecialchars((int) $_GET['supprimerBS']);
  $modif = '0';
  $updateAnnonce = $bdd->prepare("UPDATE goods SET completer = ? WHERE id_goods = ? ");
  $updateAnnonce -> execute(array($modif,$idSupp));
  ?>
  <script type="text/javascript">
  alert("Annonce mise en ligne !");
  document.location.href = 'pageEspaceProfil.php';
  </script>
<?php  }
if(isset($_GET['supprimerBS2']) AND !empty($_GET['supprimerBS2'])) {
  $idSupp = htmlspecialchars((int) $_GET['supprimerBS2']);
  $modif = '1';
  $updateAnnonce = $bdd->prepare("UPDATE goods SET completer = ? WHERE id_goods = ? ");
  $updateAnnonce -> execute(array($modif,$idSupp));
  header("Location: pageEspaceProfil.php"); ?>
  <script type="text/javascript">
  alert("Annnonce mise hors-ligne !");
  document.location.href = 'pageEspaceProfil.php';
  </script>
<?php     }

if(isset($_GET['supprimerLocations']) AND !empty($_GET['supprimerLocations'])) {
  $idSupp = htmlspecialchars((int) $_GET['supprimerLocations']);
  $modif = '0';
  $updateAnnonce = $bdd->prepare("UPDATE lease SET completer = ? WHERE id_lease = ? ");
  $updateAnnonce -> execute(array($modif,$idSupp));
  ?>
  <script type="text/javascript">
  alert("Annonce mise en ligne !");
  document.location.href = 'pageEspaceProfil.php';
  </script>
<?php  }
if(isset($_GET['supprimerLocations2']) AND !empty($_GET['supprimerLocations2'])) {
  $idSupp = htmlspecialchars((int) $_GET['supprimerLocations2']);
  $modif = '1';
  $updateAnnonce = $bdd->prepare("UPDATE lease SET completer = ? WHERE id_lease = ? ");
  $updateAnnonce -> execute(array($modif,$idSupp));
  header("Location: pageEspaceProfil.php"); ?>
  <script type="text/javascript">
  alert("Annonce mise hors-ligne !");
  document.location.href = 'pageEspaceProfil.php';
  </script>
<?php     }
 if(isset($_GET['supprimerPosts']) AND !empty($_GET['supprimerPosts'])) {
  $idSupp = htmlspecialchars((int) $_GET['supprimerPosts']);
  $modif = '1';
  $updateAnnonce = $bdd->prepare("UPDATE forum_reponses SET statut = ? WHERE id = ? ");
  $updateAnnonce -> execute(array($modif,$idSupp));
 ?>
  <script type="text/javascript">
  alert("Réponse supprimée !");
  document.location.href = 'forum.php';
  </script>
<?php     } ?>

<!--- _____________________________________________________________________________________________________________________________ -->


<?php

if(isset($_GET['id'])){

$id_lease = $_GET['id'];
if(!(empty($_POST['name']))){
	if(!(empty($_POST['price_ini']))){
		if(!(empty($_POST['description']))){
			if(!empty($_POST['room'])){
        if(!empty($_POST['type'])){
          if(!empty($_POST['position'])){
            $name = htmlspecialchars($_POST['name']);
      			$price_ini = htmlspecialchars($_POST['price_ini']);
      			$description = htmlspecialchars($_POST['description']);
            $room = htmlspecialchars($_POST['room']);
            $type = htmlspecialchars($_POST['type']);
            $position = htmlspecialchars($_POST['position']);



      			$updateSujet = $bdd->prepare("UPDATE lease SET name = ? WHERE id_lease = '${id_lease}'");
      			$updateSujet ->execute(array
      			($name)
      		);
      		$updateMiniDesc = $bdd->prepare("UPDATE lease SET  price_ini = ? WHERE id_lease = '${id_lease}'");
      		$updateMiniDesc ->execute(array
      		($price_ini)
      	);
      	$updateDesc = $bdd->prepare("UPDATE lease SET description = ? WHERE id_lease = '${id_lease}'");
      	$updateDesc ->execute(array
      	($description)
      );
      $updateDesc = $bdd->prepare("UPDATE lease SET room = ? WHERE id_lease = '${id_lease}'");
      $updateDesc ->execute(array
      ($room)
      );
      $updateDesc = $bdd->prepare("UPDATE lease SET type = ? WHERE id_lease = '${id_lease}'");
      $updateDesc ->execute(array
      ($type)
      );
      $updateDesc = $bdd->prepare("UPDATE lease SET position = ? WHERE id_lease = '${id_lease}'");
      $updateDesc ->execute(array
      ($position)
      );
      header("Location: locations.php");


    }else{ ?>
            <script type="text/javascript">
          	alert("|| ERREUR || Vous n'avez pas mis de position!");
          	document.location.href = 'formulaireAnnoncesModifs.php?locations=<?php echo ($id_lease); ?>';
          	</script>
        <?php
          }

        }else{ ?>
          <script type="text/javascript">
        	alert("|| ERREUR || Vous n'avez pas mis de type !");
        	document.location.href = 'formulaireAnnoncesModifs.php?locations=<?php echo ($id_lease); ?>';
        	</script>
      <?php    }
    }else{ ?>
        <script type="text/javascript">
      	alert("|| ERREUR || Indiquez le nombre de personne !");
      	document.location.href = 'formulaireAnnoncesModifs.php?locations=<?php echo ($id_lease); ?>';
      	</script>
      <?php  }

} else {
	?>
	<script type="text/javascript">
	alert("|| ERREUR || Vous n'avez pas mis de titre !");
	document.location.href = 'formulaireAnnoncesModifs.php?locations=<?php echo ($id_lease); ?>';
	</script>
	<?php
}
} else {
	?>
	<script type="text/javascript">
	alert("|| ERREUR || Veuillez entrer un prix !");
	document.location.href = 'formulaireAnnoncesModifs.php?locations=<?php echo ($id_lease); ?>';
	</script>
	<?php
}
}
else {
	?>
	<script type="text/javascript">
	alert("|| ERREUR || Il n'y a pas de nom !");
	document.location.href = 'formulaireAnnoncesModifs.php?locations=<?php echo ($id_lease); ?>';
	</script>
	<?php
}

/*--------------------------------------------------------------------------------------------------------------------------------*/

}else{

$id_goods = $_GET['id'];
if(!(empty($_POST['name']))){
	if(!(empty($_POST['position']))){
		if(!(empty($_POST['titre']))){
			$name = htmlspecialchars($_POST['name']);
			$position = htmlspecialchars($_POST['position']);
			$titre = htmlspecialchars($_POST['titre']);


			$updateSujet = $bdd->prepare("UPDATE goods SET name = ? WHERE id_goods = '${id_goods}'");
			$updateSujet ->execute(array
			($name)
		);
		$updateMiniDesc = $bdd->prepare("UPDATE goods SET  position = ? WHERE id_goods = '${id_goods}'");
		$updateMiniDesc ->execute(array
		($position)
	);
	$updateDesc = $bdd->prepare("UPDATE goods SET description = ? WHERE id_goods = '${id_goods}'");
	$updateDesc ->execute(array
	($titre)
);
header("Location: services.php");


} else {
	?>
	<script type="text/javascript">
	alert("|| ERREUR || Vous n'avez pas mis de position !");
	document.location.href = 'formulaireAnnoncesModifs.php?biens=<?php echo ($id_goods); ?>';
	</script>
	<?php
}
} else {
	?>
	<script type="text/javascript">
	alert("|| ERREUR || Vous n'avez pas mis de nom !");
	document.location.href = 'formulaireAnnoncesModifs.php?biens=<?php echo ($id_goods); ?>';
	</script>
	<?php
}
}
else {
	?>
	<script type="text/javascript">
	alert("|| ERREUR || Il n'y a pas de contenu !");
	document.location.href = 'formulaireAnnoncesModifs.php?biens=<?php echo ($id_goods); ?>';
	</script>
	<?php
}

}

?>
