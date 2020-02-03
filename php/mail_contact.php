<?php
  $champs=array('name','email','message');
  $name=htmlspecialchars($_POST['name']);
  $email=htmlspecialchars($_POST['email']);
  $message=$_POST['message'];
  foreach ($champs as $value) {
    if(!isset($_POST[$value]) || empty($_POST[$value]))
    {

      header("Location: mail.php");
      exit;
    }
  }


    $header="MIME-Version: 1.0";
    $header.='From:"mypenpal.freeboxos.com"<sarah.oztas@hotmail.fr>';
    $header.='Content-Type:text/html; charset=utf8';
    $header.='Content-Transfer-Encoding: 8bit';
    $message='
    Une personne cherche à contacter MyPenpal ! 
    Expediteur: '.$name.'
    Son mail: '.$email.'
    Message: '.$message.'
    ';

mail('mypenpal.contact@gmail.com','Contact client', $message, $header);


  header("Location:index.php");



?>
