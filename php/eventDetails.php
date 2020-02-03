<?php
session_start();
if(!isset($_SESSION['id'])){
  header("Location: connexion.php");
}else{
include('connexionBDD.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon.ico" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles2.css">
    <title>Details de l'annonce</title>
  </head>
  <body>
      <?php include('header.php') ?>
      <?php include('not.php') ?>

      <div class="container" style="text-align: justify;margin-top:2%;">
        <center>
          <section class="block1 col-md-7" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
            <h1>Détails de l'événement</h1>
          </section>
        </center>
        <br><br>
    <?php
    $date=date('Y-m-d');
    $get=$_GET['id'];
    $id=$_SESSION['id'];
    $sql =  ('SELECT events.id as id, events.title as title, events.start_event as start_event, events.description as description, events.position as position,events.end_event as end_event
      FROM events WHERE id='.$_GET['id']);
$req= $bdd->prepare('SELECT name, event FROM inscriptionevent WHERE name='.$_SESSION['id'].' AND event='.$_GET['id']);

        foreach  ($bdd->query($sql) as $row) {
          echo "<div class='message design-block'><b>Ville: </b> ".$row['position']."<br>";
          echo "<b>Commence: </b> ".$row['start_event'] ."<br>" ;
          echo "<b>Nom: </b> ".$row['title'] ."<br>" ;
          echo  $row['description'] ."<br><br>";

          $req->execute();
          $ins=$req->rowCount();
          if ( $row['start_event']>$date){
            if ($ins!=0){
          ?>
              <a class="btn btn-info a_hover2" style="color:white;" > Vous êtes déjà inscrit(e) </a>
              <?php
            }else{
              ?><a class="btn btn-info a_hover2" style="color:white;" href="verifInscriptionEvent.php?id=<?php echo $row['id'];?>&name=<?php echo $row['title'];?>" >Je m'inscris! </a> <?php
            }
          }else{
          ?>    <a class="btn btn-info a_hover2" style="color:white;" > Evenement clos  </a> <?php
        } ?>
        </div>
        <?php
}
          ?>
      </div>
      <div style="padding-bottom:318px;">
        <?php include('footer.php'); ?>
      </div>
      <br><br>
    </body>
    </html>
  <?php } ?>
