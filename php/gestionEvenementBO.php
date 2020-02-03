<?php session_start();
$date=date('Y-m-d');
$hour=date('H:i');
ob_start();
include('connexionBDD.php');
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Evenements</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    	<link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon" />
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
     <link rel="stylesheet" href="../css/styles2.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

  </head>
  <body>
    <?php include('header.php') ?>
    <?php include('not.php') ?>

      <div class="container" style="text-align: justify;margin-top:2%;">
        <center>
          <?php include("navBarBO.php") ?>
        </center>
      <br><br>
      <section class="block1 col-md-12" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;height:700px;">

      <p> <b>Veuillez entrer l'objet et le contenu de votre requête </b></p>
      <form action="verificationEvents.php" method="post" >
        Ville/lieu:<input type="text" name="position" placeholder="Localisation" /> <br><br>
        Date de l'event: <input type="datetime-local" min = "<?php echo $date ?>T<?php echo $hour ?>" name="start_event"/><br><br>
        Fin date de l'event: <input type="datetime-local" min = "<?php echo $date ?>T<?php echo $hour ?>" name="end_event"/><br><br>
        Nom: <input type="text" name="title" placeholder="Nom de l'evenement"/><br><br>
        <p>Description de l'événement: </p><textarea name="description" rows="10" cols="50"></textarea><br><br>

        <input type="submit" class="btn btn-info a_hover2" style="color:white;" value="Poster" />
      </form>

    </section>
    <?php
    $supprime = 1;
    $req = $bdd ->query('SELECT * FROM events WHERE suppr = "0"');
    $debut_event=$bdd->query('SELECT DAY(start_event) as day_debut, MONTH(start_event) as month_debut, YEAR(start_event) as year_debut, HOUR(start_event) as hour_debut, MINUTE(start_event) as minute_debut FROM events WHERE suppr =0');
    $fin_event=$bdd->query('SELECT DAY(end_event) as day_fin, MONTH(end_event) as month_fin, YEAR(end_event) as year_fin, HOUR(end_event) as hour_fin, MINUTE(end_event) as minute_fin FROM events WHERE suppr = 0');
?>

    <section>
      <section  class="block1" style="text-align:center;border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;margin-top:2%;margin-bottom:2%;">
      <h3 style="text-align:center;border:5px solid #b1d1d0;padding:2px;background:white;border-radius:5px;"> Evenements Actifs </h3>
      <table style="width:100% ;margin:auto;border:5px solid #b1d1d0;border-radius:5px;">
        <tr style="text-align:center;border:  2px solid #b1d1d0 ; width: 50%;">
          <th style="border:  2px solid #b1d1d0 ;"> Nom Evenement</th>
          <th style="border:  2px solid #b1d1d0 ;"> Lieu Evenement </th>
          <th style="border:  2px solid #b1d1d0 ;"> Date Début </th>
          <th style="border:  2px solid #b1d1d0 ;"> Date Fin </th>
          <th style="border:  2px solid #b1d1d0 ;"> Suppression </th>
          <th style="border:  2px solid #b1d1d0 ;"> Modifier </th>
        </tr>
    </section>
    <?php while(($req1 = $req -> fetch())&&($debut=$debut_event->fetch())&&($fin=$fin_event->fetch())){ ?>
    <tr>
        <td style="border:  2px solid #b1d1d0 ;"><?php echo $req1['title'];?></td>
        <td style="border:  2px solid #b1d1d0 ;"><?php echo $req1['position'];?></td>
        <?php
        if($debut['minute_debut']<10){
          $minute_debut =  '0'.$debut['minute_debut'];
        } else{
          $minute_debut = $debut['minute_debut'];
        }
        if($debut['month_debut']<10){
          $month_debut = '0'.$debut['month_debut'];
        } else {
          $month_debut = $debut['month_debut'];
        }
        if($debut['day_debut']<10){
          $day_debut =  '0'.$debut['day_debut'];
        } else {
          $day_debut = $debut['day_debut'];
        }
        if($debut['hour_debut']<10){
          $hour_debut =  '0'.$debut['hour_debut'];
        } else {
          $hour_debut = $debut['hour_debut'];
        }?>
        <td style="border:  2px solid #b1d1d0 ;;"> Le <?php echo $day_debut.'/'.$month_debut.'/'.$debut['year_debut']; echo ' à '.$hour_debut.'h'.$minute_debut; ?></td>
        <?php
        if($fin['minute_fin']<10){
          $minute_fin =  '0'.$fin['minute_fin'];
        } else{
          $minute_fin = $fin['minute_fin'];
        }
        if($fin['month_fin']<10){
          $month_fin = '0'.$fin['month_fin'];
        } else {
          $month_fin = $fin['month_fin'];
        }
        if($fin['day_fin']<10){
          $day_fin =  '0'.$fin['day_fin'];
        } else {
          $day_fin = $fin['day_fin'];
        }
        if($fin['hour_fin']<10){
          $hour_fin =  '0'.$fin['hour_fin'];
        } else {
          $hour_fin = $fin['hour_fin'];
        }?>
        <td style="border:  2px solid #b1d1d0 ;"> Le <?php echo $day_fin.'/'.$month_fin.'/'.$fin['year_fin']; echo ' à '.$hour_fin.'h'.$minute_fin; ?></td>
        <td style="border:  2px solid #b1d1d0 ;"><a href="gestionEvenementBO.php?supprime=<?=$req1['id'];?>">Suppression </a></td>
        <?php
        if (isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
          $id = htmlspecialchars((int) $_GET['supprime']);
          $delete = $bdd->prepare('UPDATE events SET suppr = ?  WHERE id = ?');
          $delete->execute(array($supprime,$id));
          header("Location:gestionEvenementBO.php");
        } ?>
        <td style="border:  2px solid #b1d1d0 ;"><a href="gestionEvenementModifier.php?modifier=<?php echo($req1['id']);?>">Modifier </a></td>

        <?php } ?>
      </tr>
    </table>

  </section>
  <?php
  $ajoute = 0;
  $req = $bdd ->query('SELECT * FROM events WHERE suppr = "1"');
  $debut_event=$bdd->query('SELECT DAY(start_event) as day_debut, MONTH(start_event) as month_debut, YEAR(start_event) as year_debut, HOUR(start_event) as hour_debut, MINUTE(start_event) as minute_debut FROM events WHERE suppr =0');
  $fin_event=$bdd->query('SELECT DAY(end_event) as day_fin, MONTH(end_event) as month_fin, YEAR(end_event) as year_fin, HOUR(end_event) as hour_fin, MINUTE(end_event) as minute_fin FROM events WHERE suppr = 0');
?>

  <section>
    <section  class="block1" style="text-align:center;border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;margin-top:2%;margin-bottom:2%;">
    <h3 style="text-align:center;border:5px solid #b1d1d0;padding:2px;background:white;border-radius:5px;"> Evenements Supprimés </h3>
    <table style="width:100% ;margin:auto;border:5px solid #b1d1d0;border-radius:5px;">
      <tr style="text-align:center;border:  2px solid #b1d1d0 ; width: 50%;">
        <th style="border:  2px solid #b1d1d0 ;"> Nom Evenement</th>
        <th style="border:  2px solid #b1d1d0 ;"> Lieu Evenement </th>
        <th style="border:  2px solid #b1d1d0 ;"> Date Début </th>
        <th style="border:  2px solid #b1d1d0 ;"> Date Fin </th>
        <th style="border:  2px solid #b1d1d0 ;"> Ajouter </th>
      </tr>
  </section>
  <?php while(($req1 = $req -> fetch())&&($debut=$debut_event->fetch())&&($fin=$fin_event->fetch())){ ?>
  <tr>
      <td style="border:  2px solid #b1d1d0 ;"><?php echo $req1['title'];?></td>
      <td style="border:  2px solid #b1d1d0 ;"><?php echo $req1['position'];?></td>
      <?php
      if($debut['minute_debut']<10){
        $minute_debut =  '0'.$debut['minute_debut'];
      } else{
        $minute_debut = $debut['minute_debut'];
      }
      if($debut['month_debut']<10){
        $month_debut = '0'.$debut['month_debut'];
      } else {
        $month_debut = $debut['month_debut'];
      }
      if($debut['day_debut']<10){
        $day_debut =  '0'.$debut['day_debut'];
      } else {
        $day_debut = $debut['day_debut'];
      }
      if($debut['hour_debut']<10){
        $hour_debut =  '0'.$debut['hour_debut'];
      } else {
        $hour_debut = $debut['hour_debut'];
      }?>
      <td style="border:  2px solid #b1d1d0 ;;"> Le <?php echo $day_debut.'/'.$month_debut.'/'.$debut['year_debut']; echo ' à '.$hour_debut.'h'.$minute_debut; ?></td>
      <?php
      if($fin['minute_fin']<10){
        $minute_fin =  '0'.$fin['minute_fin'];
      } else{
        $minute_fin = $fin['minute_fin'];
      }
      if($fin['month_fin']<10){
        $month_fin = '0'.$fin['month_fin'];
      } else {
        $month_fin = $fin['month_fin'];
      }
      if($fin['day_fin']<10){
        $day_fin =  '0'.$fin['day_fin'];
      } else {
        $day_fin = $fin['day_fin'];
      }
      if($fin['hour_fin']<10){
        $hour_fin =  '0'.$fin['hour_fin'];
      } else {
        $hour_fin = $fin['hour_fin'];
      }?>
      <td style="border:  2px solid #b1d1d0 ;"> Le <?php echo $day_fin.'/'.$month_fin.'/'.$fin['year_fin']; echo ' à '.$hour_fin.'h'.$minute_fin; ?></td>
      <td style="border:  2px solid #b1d1d0 ;width:10%;"><a href="gestionEvenementBO.php?ajoute=<?=$req1['id'];?>">Ajouter </a></td>
      <?php
      if (isset($_GET['ajoute']) AND !empty($_GET['ajoute'])) {
        $id = htmlspecialchars((int) $_GET['ajoute']);
        $delete = $bdd->prepare('UPDATE events SET suppr = ?  WHERE id = ?');
        $delete->execute(array($ajoute,$id));
        header("Location:gestionEvenementBO.php");
      } ?>
      <?php } ?>
    </tr>
  </table>

  </div>
    <?php include('footer.php') ?>
  </body>
</html>
<?php  ob_end_flush(); ?>
