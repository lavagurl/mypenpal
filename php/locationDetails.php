<?php
session_start();
if(!isset($_SESSION['id'])){
  header("Location: connexion.php");
}else{
include ('connexionBDD.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    	<link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon" />
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
     <link rel="stylesheet" href="../css/styles2.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <title>Details de l'annonce</title>
  </head>
  <body>
    <div id="main">
      <?php include('header.php') ?>
      <?php include('not.php') ?>

      <div class="container" style="text-align: justify;margin-top:2%;">
        <center>
          <section class="block1 col-md-7" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
            <h1  class="cursor_none"> Details de l'annonce </h1>
          </section>
        </center>
    <?php
    $sql =  ('SELECT lease.id_lease as id_lease, lease.name as name, lease.description as description,
      member.name as member_id, lease.position as position, lease.type as type ,lease.room as room, lease.price_ini as price_ini,member.email as email
      FROM lease INNER JOIN member ON lease.member= member.id WHERE id_lease='.$_GET['id']);
      $reponse = $bdd->query("SELECT * FROM member WHERE name='{$_SESSION['pseudo']}'");
      $donnees = $reponse -> fetch();

      ?>
      <div id="hotels">
        <div class="row">
          <div class="container" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
        <?php
        foreach  ($bdd->query($sql) as $row) {
          echo  $row['member_id']."<br>";
          echo "<b>Ville: </b> ".$row['position']."<br>";
          echo "<b>Nom: </b> ".$row['name'] ."<br>" ;
          echo "<b>Type: </b> ".$row['type'] ."<br>" ;
          echo "<b>Pour: </b> ".$row['room'] ."<br>" ;
          if($donnees['premium']==1){
            $price = round($row['price_ini']/1.1);
            echo "<b >Prix : </b><b style ='text-decoration: line-through';>".$row['price_ini'] ." € </b> <b style='color:red'> ".$price." €</b> <br>" ;
          }else{
          echo "<b>Prix : </b> ".$row['price_ini'] ." € <br>" ;}
          echo  $row['description'] ."<br><br>";
          ?>
          <a class="btn btn-info a_hover2" style="color:white;" href="mail_location.php?id=<?php echo $row['id_lease']; ?>&nom=<?php echo $row['name']; ?>&type=location" >Je suis interessé</a>
        </div>
        </div>
        </div>
      </div>
          <br><br>
        <?php include('footer.php'); ?>
  </body>
</html>
<?php }} ?>
