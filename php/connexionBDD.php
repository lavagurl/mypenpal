<?php try
{    // connexion à la base de données
  //$bdd = new PDO('mysql:host=localhost;dbname=mypenpal_rattra;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
  $bdd = new PDO('mysql:host=db5000155318.hosting-data.io;dbname=dbs150393;charset=utf8', 'dbu157999', '@@19021998Mq',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
  //print_r($bdd->errorInfo());
}
catch(Exception $e)
{

  die('Erreur : '.$e->getMessage());  // En cas d'erreur, on affiche un message et on arrête tout
}
?>
