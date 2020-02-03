<?php
session_start();
include('connexionBDD.php');
$articles=$bdd -> query ('SELECT  member.name as member_id, goods.position as position , goods.name as name,goods.completer as completer ,goods.description as description FROM goods INNER JOIN member ON goods.member= member.id WHERE completer=0 ORDER BY date_du_post DESC '); //la fonction concat permet de concatener deux attributs de la bdd

if(isset($_GET['search']) AND !empty($_GET['search'])){

  $search = htmlspecialchars($_GET['search']);


  $articles=$bdd -> query ('SELECT  member.name as member_id, goods.position as position , goods.name as name ,goods.description as description,goods.completer as completer, goods.date_du_post as date_du_post FROM goods INNER JOIN member ON goods.member= member.id WHERE CONCAT(goods.name,goods.description,goods.position) LIKE "%'.$search.'%" ORDER BY date_du_post DESC');

}
if($articles ->rowCount() > 0 ) {
  ?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles2.css">
    <link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <title>Recherche</title>
  </head>
  <body>
    <?php include('header.php')?>
    <?php include('not.php') ?>
    <div class="container" style="text-align: justify;margin-top:2%;">
      <center>
        <section  class="block1 col-md-7" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
          <h1  class="cursor_none"> Voici ce que nous avons trouvé </h1>
        </section>
      </br>
      <form class="form block1 col-md-9" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;" action="recherche.php" method="get">
        Recherche: <input type="text" name="search" placeholder="Recherche"/>
        <input type="submit" value="Rechercher" /><br><br>
       <a class="btn btn-info" href='services.php'>Retour</a>
      </form>
    </center>
    <?php
    while($a=$articles->fetch()){
	if($a['completer']==0){
 ?>
	      <div class="block col-md-3 design-block"><?php
      echo '<b>'.$a['member_id']."</b><br>";
      echo "<b>Lieu: </b>" . $a['position']."<br>";
      echo "<b>Objet: </b>" . $a['name']."<br>";
      echo "<b>Description: </b>".$a['description']."<br>";
      ?>
    </br>
    <input class="btn btn-info" type="submit" value="Je suis interessé(e)" onclick="notifications.php"/>
    <br> <br></div>
<?php }} ?>  
</div>

  <?php include('footer.php'); ?>
  </body>
  </html>

  <?php 
} else { ?>

  <!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
      <link rel="stylesheet" href="../css/styles2.css">
      <link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon" />
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

      <title>Recherche</title>
    </head>
    <body>
      <?php include('header.php')?>
      <?php include('not.php') ?>
      <div class="container" style="text-align: justify;margin-top:2%;">
<form class="form block1 col-md-9" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;" action="recherche.php" method="get">
        Recherche: <input type="text" name="search" placeholder="Recherche"/>
        <input type="submit" value="Rechercher" /><br><br>
       <a class="btn btn-info" href='services.php'>Retour</a>
      </form>

      <div class="block col-md-5 design-block">
        <p>Nous n'avons pas trouvé ce que vous recherchez  :(</p>
      </div>
    </div>
    <?php include('footer.php'); ?>
    </body>
  </html>

<?php } ?>
