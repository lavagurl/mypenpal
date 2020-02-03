<?php
session_start();
if(!isset($_SESSION['pseudo'])){
  header("Location: connexion.php");
}else{
  include('connexionBDD.php');
  $id_event = $_GET['id'];
  $evenements = $bdd->query("SELECT * FROM events where id_events = '$id_event'");
  $dates = $bdd->query("SELECT DAY(date_event) as day_event, MONTH(date_event) as month_event, YEAR(date_event) as year_event FROM events where id_events = '$id_event'");
  $evenement = $evenements -> fetch();
  $date = $dates->fetch();
  $nom_event = $evenement['name'];
  $position = $evenement['position'];
  $description = $evenement['description'];
  ?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles2.css">
    <link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon" />
    <title>Evenements </title>
  </head>
  <body>
    <?php include('header.php')?>
    <div class="container" style="text-align: justify;margin-top:2%;">
      <section class="sectionTitres">
      <h1 class="titres">Evenements</h1>
    </section>
      <br>	<br>	<br>
      <section class="form">
        <strong><?php echo $nom_event; ?></strong></br>
        <strong>Lieu : </strong><?php echo $position; ?></br>
        <strong>Date : </strong><?php echo $date['day_event'].'/'.$date['month_event'].'/'.$date['year_event']; ?></br>
        <strong>Description : </strong><?php echo $description; ?></br>
        </br>
        </br>
        <a class="buttons" href="inscriptionEvent.php">M'inscrire </a>
      </section>
      <?php
      /*$sql =  ('SELECT events.name as name, events.description as description, member.name as member_id, events.position as position FROM events INNER JOIN member ON events.member= member.id ORDER BY date_event DESC');

          foreach  ($bdd->query($sql) as $row) {
            echo('<section class="form"');
              echo $row['member_id']."<br>";
              echo "<b>Lieu:<b> ".$row['position']."<br>";
              echo $row['name'] ."<br>" ;
              echo  $row['description'] ."<br></br>"; */?>
                <br><br>
              </section><?php
          //  }
        ?>

  </div>
    <?php include('footer.php')?>

  </body>
  </html>
  <?php
}
?>
