<?php
session_start();
include('connexionBDD.php');
//  Récupération de l'utilisateur et de son pass hashé
if(isset($_POST['Connexion'])){

  $pseudo = htmlspecialchars($_POST['pseudo']);

  $req = $bdd->prepare('SELECT id, password,suppr FROM member WHERE name = :pseudo');

  $req->execute(array('pseudo' => $pseudo));

  $resultat = $req->fetch();
 

  // Comparaison du pass envoyé via le formulaire avec la base

  $isPasswordCorrect = password_verify($_POST['mdp'], $resultat['password']);

  if($resultat['suppr']!= '0'){
    ?>

    <script type="text/javascript">

    alert("Votre compte a été supprimé !");
  	document.location.href = 'connexion.php';
    </script>

  <?php }else {
  if (!$resultat)

  { ?>

    <script type="text/javascript">

    alert("Mauvais identifiant ou mot de passe !");
    document.location.href = 'connexion.php';

    </script>
    <?php
  }

  else

  {

    if ($isPasswordCorrect) {
      $_SESSION['id'] = $resultat['id'];
      $_SESSION['pseudo'] = $pseudo;

      $modif = '1';
      $statutConnexion = $bdd->prepare("UPDATE member SET status = ? WHERE id='{$_SESSION['id']}' ");
      $statutConnexion ->execute(array
      ($modif)
    );

  header("location: index.php");

}

else {

  ?>

  <script type="text/javascript">

  alert("Mauvais identifiant ou mot de passe !");
  document.location.href = 'connexion.php';

  </script>
  <?php
}
}
}}

?>
