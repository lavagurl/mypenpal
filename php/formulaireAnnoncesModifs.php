<?php
session_start();
if(!isset($_SESSION['pseudo'])){
  header("Location: connexion.php");
}else{

  include('connexionBDD.php');
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

    <title>Modifiez de votre annonce</title>
  </head>
  <body>
    <?php include('header.php'); ?>
    <?php

    if(isset($_GET['biens'])){
      $id_goods = $_GET['biens'];
      $infosAnnonces = $bdd->query("SELECT * from goods WHERE id_goods =".$id_goods);
      $infoAnnonce =  $infosAnnonces->fetch();
      if($infoAnnonce['member']==$_SESSION['id']){

      ?>

      <div class="container" style="text-align: justify;margin-top:2%;">
        <center>
        <div class="block1 col-md-7" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
          <h1  class="cursor_none"> Biens et services </h1>
        </div>
      </center>
      <?php include('not.php') ?>
      <br><br>

      <section class="block1 col-md-12" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;height:400px;">



        <p><b> Veuillez entrer l'objet et le contenu de votre requête </b></p>
        <form action="verificationServices.php" method="post" >
          Nom : <input type="text" name="name" value="<?php echo ($infoAnnonce['name']); ?>"/>
          <p>Description:</p> <textarea name="description" rows="7" cols="50"><?php echo nl2br($infoAnnonce['description']); ?></textarea> <br>
          Ville:<input type="text" name="position" value="<?php echo ($infoAnnonce['position']); ?>" />
          <input class="buttons" type="submit" value="Poster"/>
        </form>
      </section>
    </div>
    <?php
  } else {
    ?>
    <div class="block1 col-md-9" style="margin:0 auto;border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;margin-top:150px;">
      <h3>Qu'est ce que tu fais ici, petit malin ? </h3>
    </div>
    <?php
  }
  } else{

    $id_locations = $_GET['locations'];
    $infosAnnonces = $bdd->query("SELECT * FROM lease WHERE id_lease =".$id_locations);
    $infoAnnonce =  $infosAnnonces->fetch();
    if($infoAnnonce['member']==$_SESSION['id']){
    ?>


    <div class="container" style="text-align: justify;margin-top:2%;">
      <center>
        <div class="block1 col-md-7" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
          <h1  class="cursor_none"> Mise en location: </h1>
        </div>
      </center>
      <br><br>
      <div class="block1 col-md-12" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px">
        <h5> Veuillez remplir le formulaire : </h5>
        <p> N'oubliez pas de mettre un lien de redirection à votre site dans la description. Sinon, vous pourrez aussi être contacté via chat sur Mypenpal </p>
        <form action="verifModifEspace.php?id=<?php echo($infoAnnonce['id_lease']); ?>" method="post" >
          <b>Position:</b> <input type="text" name="position" value="<?php echo($infoAnnonce['position']); ?>" />
        </br></br>
        <b>Nom de l'herbergement:</b> <input type="text" name="name" value="<?php echo($infoAnnonce['name']); ?>"/></br></br>
        <b>Type d'hébergement:</b> <select name="type" id="type">
          <option value=""> </option>
          <option value="<?php echo($infoAnnonce['type']); ?>" selected="selected"><?php echo($infoAnnonce['type']); ?></option>
          <option value="Hôtel">Hôtel</option>
          <option value="Auberge de Jeunesse">Auberge de Jeunesse</option>
          <option value="B&B">B&B</option>
          <option value="Appart'Hôtel">Appart'Hôtel</option>
        </select>
      </br></br>
      <b>Nombre de personnes :</b> <select name="room" id="room">
        <option value=""> </option>
        <option value="<?php echo($infoAnnonce['room']); ?>" selected="selected"><?php echo($infoAnnonce['room']); ?></option>
        <option value="1 personne">1 personne</option>
        <option value="2 personnes">2 personnes </option>
        <option value="3 personnes">3 personnes</option>
        <option value="4 personnes">4 personnes</option>
        <option value="5 personnes ou plus">5 personnes ou plus</option>
      </select>
    </br></br>
    <b>Prix/nuit :</b> <input type="number" name="price_ini" value="<?php echo($infoAnnonce['price_ini']); ?>"></input></br></br>
    <b>Description du lieu:</b></br> <textarea cols="50" rows="5" name="description"><?php echo (nl2br($infoAnnonce['description'])); ?></textarea></br></br>
  </br></br>
  <input class="btn btn-info" type="submit" value="Modifier" />
</form>
</div>
</div>

<?php
} else {
  ?>
  <div class="block1 col-md-9" style="margin:0 auto;border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;margin-top:150px;">
    <h3>Qu'est ce que tu fais ici, petit malin ? </h3>
  </div>
  <?php
}
?>
<?php include('footer.php'); ?>
</body>
</html>

<?php
}
}
?>
