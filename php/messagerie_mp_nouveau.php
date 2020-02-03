<?php
session_start();
if(!isset($_SESSION['pseudo'])){
  header("Location: connexion.php");
}else{

  include('connexionBDD.php');
  $amis = $bdd ->query("SELECT * FROM amis WHERE pseudo_membre1='{$_SESSION['pseudo']}'");
  $messages = $bdd->query("SELECT * FROM messagerie_privee WHERE mp_id ='${id_message}'");
  $message = $messages->fetch();
  $expediteur = $message['mp_expediteur'];
  $message_complet = $message['mp_text'];
  $message_titre = $message['mp_titre'];

  ?>

  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles2.css">
    <link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon" />
    <title>Mon profil</title>
  </head>
  <body>
    <?php include('header.php')?>
    <div class="container" style="text-align: justify;margin-top:2%;">
      <center>
      <section class="block1 col-md-7" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
        <h1>Votre messagerie privée</h1>
      </section>
    </center>
    </br>
      <div class="block1 col-md-11" style="border:2px solid #a2d8d6;background-color:white;margin:0.5px;">
        <div>
          <h3> Envoyez un mp : </h3>
            <form class="" action="verifMP.php" method="post">
        <article class="message">
          <h4>Répondre :</h4>
          <p><strong>À :</strong></p><input type="text" name="pseudo_rece" value="<?php echo ($_GET['receveur']); ?>" readonly="readonly">
          <p><strong>Objet :</strong></p><input type="text" name="message_titre" value="<?php echo ($message_titre); ?>"/>
          <p><strong>Votre message :</strong></p>
          <textarea name="message_complet" rows="8" cols="55"></textarea>
          <input class="btn btn-info" type="submit" name="" value="Envoyer"/>
        </article>
          </form>
        </br>
    </div>
</div>


</div>
<?php include('footer.php')?>
</body>
</html>

<?php
}
?>
