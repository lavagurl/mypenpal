<?php
session_start();
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
  <title>Locations</title>
</head>
<body>
  <?php include('header.php')?>
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
      <form action="verificationLocation.php" method="post" >
        <b>Position:</b> <input type="text" name="position" placeholder="Localisation" />
      </br></br>
      <b>Nom de l'herbergement:</b> <input type="text" name="name" placeholder="Objet"/></br></br>
      <b>Type d'hébergement:</b> <select name="type" id="type">
        <option value=""> </option>
        <option value="Hôtel">Hôtel</option>
        <option value="Auberge de Jeunesse">Auberge de Jeunesse</option>
        <option value="B&B">B&B</option>
        <option value="Appart'Hôtel">Appart'Hôtel</option>
      </select>
    </br></br>
    <b>Nombre de personnes :</b> <select name="room" id="room">
      <option value=""> </option>
      <option value="1 personne">1 personne</option>
      <option value="2 personnes">2 personnes </option>
      <option value="3 personnes">3 personnes</option>
      <option value="4 personnes">4 personnes</option>
      <option value="5 personnes ou plus">5 personnes ou plus</option>
    </select>
  </br></br>
  <b>Prix/nuit :</b> <input type="number" name="price_ini" value=""></input></br></br>
  <b>Description du lieu:</b></br> <textarea cols="50" rows="5" name="description" placeholder="Contenu de votre description"></textarea></br></br>
</br></br>
<input class="btn btn-info" type="submit" value="Poster" />
</form>
</div>
</div>
<?php include('footer.php'); ?>
</body>
</html>
