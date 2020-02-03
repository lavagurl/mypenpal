<?php
session_start();
include('connexionBDD.php');

if(isset($_GET['id_membre']) && !empty($_GET['id_membre'])){
  $id_amis = $_GET['id_membre'];
    $insertsujet = $bdd->prepare("INSERT INTO `notifications` (`id_post`,`id_envoi`, `id_receveur`, `status`, `status_vu`, `type`, `date_notif`, `name`) VALUES (:id_post,:id_session, :id_receveur, 1, 1, 'amis', NOW(), :pseudo_envoie)");
    $insertsujet ->execute(array
    ( "id_post" => $id_amis,
      "id_session" => $_SESSION['id'],
    "id_receveur"=> $id_amis,
    "pseudo_envoie"=> $_SESSION['pseudo'])
  );
  ?>
  <script type="text/javascript">
  alert("Demande d'ami envoyée !");
  document.location.href = 'listeMembres.php';
  </script>
  <?php
}

if (isset($_GET['ami_accepter']) && !empty($_GET['ami_accepter'])) {
  $pseudoAmi = $_GET['ami_accepter'];

  $insertAmi = $bdd->prepare("INSERT INTO `amis` (`pseudo_membre1`, `pseudo_membre2`) VALUES (:pseudo_moi, :pseudo_lautre)");
  $insertAmi -> execute(array
  ( "pseudo_moi"=>$_SESSION['pseudo'],
    "pseudo_lautre"=>$pseudoAmi)
  );

  $insertAmi2 = $bdd->prepare("INSERT INTO `amis` (`pseudo_membre1`, `pseudo_membre2`) VALUES (:lautre, :moi)");
  $insertAmi2 -> execute(array
  ( "lautre"=>$pseudoAmi,
    "moi"=>$_SESSION['pseudo'])
  );
  header("Location: pageProfilAutre.php?pseudoMembre=".$pseudoAmi);
}

if (isset($_GET['ami_refuser']) && !empty($_GET['ami_refuser'])){
  ?>
  <script type="text/javascript">
    alert('Vous avez refusé la demande d\'ami de <?php echo $_GET['ami_refuser'];  ?>');
    document.location.href = 'index.php';
  </script>
  <?php
}
 ?>
