<?php
session_start();
if(!isset($_SESSION['id'])){
  header("Location: connexion.php");
}else{
  include ('connexionBDD.php');
  $champs=array('name','email','message');
  $name=htmlspecialchars($_POST['name']);
  $email=htmlspecialchars($_POST['email']);
  $message=$_POST['message'];
  $type=htmlspecialchars($_GET['type']);
  echo $type;
  $nom=htmlspecialchars($_GET['nom']);
  echo $type;
  $id=htmlspecialchars($_GET['id']);
  echo $id;
  $bool=1;
  foreach ($champs as $value) {
    if(!isset($_POST[$value]) || empty($_POST[$value]))
    {

      header("Location: mail_location.php?id=$id&type=$type&nom=$nom");
      exit;
    }
  }


  if ($type=='location'){

    $lease='SELECT lease.id_lease as id_lease, lease.name as subject, lease.member as member , member.email as email,member.name as pseudo FROM lease INNER JOIN member ON member.id=lease.member WHERE id_lease='.$_GET['id'];
    $header="MIME-Version: 1.0";
    $header.='From:"Mypenpal.freeboxos.com"<sarah.oztas@hotmail.fr>';
    $header.='Content-Type:text/html; charset="utf8"';
    $header.='Content-Transfer-Encoding: 8bit';
    $message='
    Nous vous contactons à propos de votre annonce '.$nom.'   
    Expediteur: '.$name.'
    Son mail: '.$email.'
    Message: '.$message.'
    ';
    foreach  ($bdd->query($lease) as $row) {
      mail($row['email'],'Reponse a votre annonce location '.$row['subject'], $message , $header);
      //mail('sarah.oztas75@gmail.com','Reponse a votre annonce location ', $message , $header);


      $req=$bdd->prepare('INSERT INTO notifications(id_post,id_envoi,id_receveur,status,status_vu,type,date_notif,name)
      VALUES(:id_post,:id_envoi,:id_receveur,:status,:status_vu,:type,NOW(),:name)');

      $req ->execute(array(
        "id_post"=>$row['id_lease'],
        "id_envoi"=>$_SESSION["id"],
        "id_receveur"=>$row['member'],
        "status"=>$bool,
        "status_vu"=>$bool,
        "type"=>$type,
        "name"=>$row['pseudo']
      )
    );
  }
  header("Location:merci.php");

}

else{

  $goods='SELECT goods.id_goods as id_goods, goods.name as subject, goods.member as member , member.email as email, member.name as pseudo FROM goods INNER JOIN member ON member.id=goods.member WHERE id_goods='.$id;
  $header="MIME-Version: 1.0";
  $header.='From:"Mypenpal.freeboxos.com"<sarah.oztas@hotmail.fr>';
  $header.='Content-Type:text/html; charset="utf8"';
  $header.='Content-Transfer-Encoding: 8bit';
  $message='
  Nous vous contactons à propos de votre annonce
  Expediteur: '.$name.';
  Son mail: '.$email.';
  Message: '.$message.'
  ';
  foreach  ($bdd->query($goods) as $row) {
    mail($row['email'],'Reponse a votre annonce '.$row['subject'], $message , $header);
    //mail('sarah.oztas75@gmail.com','Votre annonce goods ', $message , $header);


    $req=$bdd->prepare('INSERT INTO notifications(id_post,id_envoi,id_receveur,status,status_vu,type,date_notif,name)
    VALUES(:id_post,:id_envoi,:id_receveur,:status,:status_vu,:type,NOW(),:name)');

    $req ->execute(array(
      "id_post"=>$row['id_goods'],
      "id_envoi"=>$_SESSION["id"],
      "id_receveur"=>$row['member'],
      "status"=>$bool,
      "status_vu"=>$bool,
      "type"=>$type,
      "name"=>$row['pseudo']
    )
  );
}
header("Location:merci.php");

}

}

?>
