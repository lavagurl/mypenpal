<?php
session_start();
include('connexionBDD.php');
$pseudo = $_SESSION['pseudo'];
$target_dir = "../images/avatars/";
$type = $_FILES["avatar"]["type"];
if ($type == 'image/png') $ext = '.png';
if ($type == 'image/jpeg') $ext = '.jpeg';

$insertNb = $bdd->prepare("SELECT nbAvatars FROM member WHERE name = :pseudo");
$insertNb->execute(array('pseudo' => $pseudo));
$donnees = $insertNb->fetch();
$insertNb->closeCursor();
$nb = $donnees['nbAvatars'];
if ($nb == 0) {
  $target_file = $target_dir . $pseudo . "_avatar" . $ext;
} else {
  $target_file = $target_dir . $pseudo . "_avatar" .  $nb . $ext;
}
if($type != 'image/png' && $type != 'image/jpeg') {
  header('Location: parametresProfil.php?e=noimg');
} else if ($_FILES["avatar"]["size"] > 5000000) {
  header('Location: parametresProfil.php?e=sz');
} else if (file_exists($target_file)) {
  while(file_exists($target_file)){
    $req = $bdd->prepare('UPDATE member SET nbAvatars = nbAvatars +1 WHERE name = :pseudo');
    $req->execute(array('pseudo' => $pseudo));

    $insertNb = $bdd->prepare("SELECT nbAvatars FROM member WHERE name = :pseudo");
    $insertNb->execute(array('pseudo' => $pseudo));
    $donnees = $insertNb->fetch();
    $insertNb->closeCursor();
    $i = $donnees['nbAvatars'];

    $target_file_new = $target_dir . $pseudo . "_avatar" . $i . $ext;
  }

} else if (!(move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file_new))) {
  header('Location: parametresProfil.php?e=noup');
}
$insertmbr = $bdd->prepare("UPDATE member SET avatar= ? WHERE  id='{$_SESSION['id']}'");
$insertmbr ->execute(array
($target_file_new));

header("Location: parametresProfil.php");
?>
