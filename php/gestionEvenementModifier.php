<?php session_start();
$date=date('Y-m-d');
$hour=date('H:i');
ob_start();
include('connexionBDD.php');
$id = $_GET['modifier'];
$req = $bdd ->query("SELECT * FROM events WHERE id = '${id}'");
$req1 =$req ->fetch();
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
      <?php     $fin_event=$bdd->query('SELECT DAY(end_event) as day_fin, MONTH(end_event) as month_fin, YEAR(end_event) as year_fin, HOUR(end_event) as hour_fin, MINUTE(end_event) as minute_fin FROM events WHERE suppr = 0');
      $fin=$fin_event->fetch();
      $debut_event=$bdd->query('SELECT DAY(start_event) as day_debut, MONTH(start_event) as month_debut, YEAR(start_event) as year_debut, HOUR(start_event) as hour_debut, MINUTE(start_event) as minute_debut FROM events WHERE suppr =0');
      $debut=$debut_event->fetch();?>
    </center>
    <br><br>
    <section class="block1 col-md-12" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;height:700px;">
      <h3 style="text-align:center;border:5px solid #b1d1d0;padding:2px;background:white;border-radius:5px;"> Modifier un Evenement </h3>
        <form action="verificationEventsModif.php?modifier=<?php echo $id?>" method="post" >
          Ville/lieu:<input type="text" name="position" placeholder="Localisation" value="<?php echo $req1['position'];  ?>" />  <br><br>
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
            <p>Veuillez réentrer les dates de début et de fin de votre évènement ! :<p>
          Date de l'event: <input type="datetime-local" value="<?php echo($req1['start_event']);?>" name="start_event"/> Votre date de début d'évènement est le :  <?php echo $day_debut.'/'.$month_debut.'/'.$debut['year_debut']; echo ' à '.$hour_debut.'h'.$minute_debut; ?><br><br>
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
          Fin date de l'event: <input type="datetime-local" value="" name="end_event"/> Votre date de fin d'évènement est le : <?php echo $day_fin.'/'.$month_fin.'/'.$fin['year_fin']; echo ' à '.$hour_fin.'h'.$minute_fin; ?> <br><br>
          Nom: <input type="text" name="title" placeholder="Nom de l'evenement" value="<?php echo $req1['title'];?>"/><br><br>
          <p>Description de l'événement: </p><textarea name="description" rows="10" cols="50"><?php echo($req1['description']);?></textarea>
          <input type="submit" class="btn btn-info a_hover2" style="color:white;" name="Modifier" value="Modifier" />
        </form>
      </section>

  </div>
  <?php include('footer.php') ?>
</body>
</html>
<?php  ob_end_flush(); ?>
