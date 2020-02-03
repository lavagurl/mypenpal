<?php
session_start();
if(!isset($_SESSION['pseudo'])){
  header("Location: connexion.php");
}else{
  include('connexionBDD.php');
  ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   	<link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles2.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <title>Biens & Services</title>
  </head>
  <body>
    <?php include('header.php')?>
    <div class="container" style="text-align: justify;margin-top:2%;">
      <center>
          <h1>Formulaire de biens & services !</h1>
        </section>
      </center>
    <?php include('not.php') ?>
      <br><br>

    <section class="block1 col-md-12" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;height:400px;">



      <p><b> Veuillez entrer l'objet et le contenu de votre requête </b></p>
      <form action="verificationServices.php" method="post" >
        Objet: <input type="text" name="name" placeholder="Objet"/>
        <p>Description:</p> <textarea name="description" rows="7" cols="50"></textarea> <br>
        Ville:<input type="text" name="position" placeholder="Localisation" />
        <input class="buttons" type="submit" value="Poster"/>
      </form>
    </section>
    </div>
    <?php include('footer.php')?>
  </body>
</html>

<?php
}
?>
