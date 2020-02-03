<?php
include('connexionBDD.php');
{


  $email = htmlspecialchars($_POST['email']);
  $reqemail = $bdd->prepare("SELECT * FROM member WHERE email = ?");
  $reqemail->execute(array("$email"));
  $emailexist = $reqemail->rowCount();

  if($emailexist != 0 )
  {
    echo 'Votre email a déjà été utilisé';

  }else{
    echo 'Le mail est disponible';
  }
}

  ?>
