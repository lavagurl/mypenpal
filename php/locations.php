<?php
session_start();
if(!isset($_SESSION['pseudo'])){
  header("Location: connexion.php");
}else{
  include('connexionBDD.php');
  $pos =  ('SELECT DISTINCT lease.position as position, lease.completer as completer FROM lease ORDER BY date_post DESC');
  $reponse = $bdd->query("SELECT * FROM member WHERE name='{$_SESSION['pseudo']}'");
  $donnees = $reponse -> fetch();
  ?>


  <!DOCTYPE html>
  <html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles2.css">
    <title>Locations</title>
  </head>
  <body>
    <script type="text/javascript" src="../js/filtre.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <style media="screen">
    body{
      color:#258784;
      background-color: #C3D7D7;
      position: relative;
    }
  </style>
  <?php include('header.php')?>
  <?php include('not.php') ?>
  <?php include('msg.php') ?>

  <div class="container" style="text-align: justify;margin-top:2%;">
    <center>
      <section class="block1 col-md-7" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
        <h1  class="cursor_none">Je cherche un logement</h1>
      </section>
    </center>
    <br>
    <br>

    <section class="block1 col-md-12" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;height:300px;">

      <p> Recherche avancé </p>

      <label>Position</label>
      <select id="position" name="position" >
        <option value="0"></option>
        <?php
        foreach  ($bdd->query($pos) as $row) {
          if($row['completer']==0){
            ?>
            <option value='<?php echo $row['position'] ?>' ><?php echo $row['position'] ?> </option>

          <?php  }
        }
        ?>
      </select>
      <form>
        <label>Type d'hébergement: </label>
        <select name="type" id="type" onchange="">
          <option value="0"></option>
          <option value="Hôtel" >Hôtel</option>
          <option value="Auberge de Jeunesse">Auberge de Jeunesse</option>
          <option value="B&B">B&B</option>
          <option value="Appart'Hôtel">Appart'Hôtel</option>
        </select>
        <label>Nombre de personnes : </label>
        <select name="room" id="room" onchange="">
          <option value="0"></option>
          <option value="1 personne">1 personne</option>
          <option value="2 personnes">2 personnes </option>
          <option value="3 personnes">3 personnes</option>
          <option value="4 personnes">4 personnes</option>
          <option value="5 personnes ou plus">5 personnes ou plus</option>
        </select>
        <label>Prix/nuit : </label>
        <select name="price" id="price" onchange="">
          <option value="0"></option>
          <option value="0-50€">0-50€</option>
          <option value="50-100€">50-100€</option>
          <option value="100-150€">100-150€</option>
          <option value="150-200€">150-200€</option>
          <option value="200€ et plus">200€ et plus</option>

        </select>
        <button  class="btn btn-info" onclick="event.preventDefault(); filtre()" >Recherche </button> <!-- Empeche l'envoi du formulaire -->
      </form>
      <br> <br> <br>		<a href="formulaireLocations.php" class="btn btn-info a_hover2" style="color:white;" > Créer ma propre annonce</a>
      <br>
    </section>
    <br><br>
    <p>
      <?php
      include('connexionBDD.php');
      $sql =  ('SELECT lease.id_lease as id_lease, lease.name as name, lease.description as description,
        member.name as member_id, lease.position as position, lease.type as type ,lease.room as room, lease.price as price, lease.price_ini as price_ini, member.email as email, lease.completer as completer
        FROM lease INNER JOIN member ON lease.member= member.id ORDER BY date_post DESC');
        ?>
        <div id="hotels">
          <?php
          foreach  ($bdd->query($sql) as $row) {
            if($row['completer']=='0'){
              echo '<div class="block col-md-3 design-block" room="'.$row['room'].'" price="'.$row['price'].'" type="'.$row['type'].'" position="'. $row['position'] .'">'; //Creation de div afin de pouvoir filtrer par es attributs
              echo "<b>Ville: </b> ".$row['position']."<br>";
              echo "<b>Nom:</b> ".$row['name'] ."<br>" ;
              echo "<b>Type:</b> ".$row['type'] ."<br>" ;
              echo "<b>Nombre de personne:</b> ".$row['room'] ."<br>" ;
              if($donnees['premium']==1){
                $price = round($row['price_ini']/1.1);
                echo "<b >Prix :</b><b style ='text-decoration: line-through';>".$row['price_ini'] ." € </b> <b style='color:red'> ".$price." €</b> <br>" ;
              }else{
              echo "<b>Prix :</b> ".$row['price_ini'] ." € <br>" ;}
              echo  nl2br($row['description']) ."<br><br>";
              ?>
              <a class="btn btn-info a_hover2" style="color:white;" href="locationDetails.php?id=<?php echo $row['id_lease']; ?>&nom=<?php echo $row['name'] ?>">Plus de détails</a>
            </div>

            <br><br>
            <?php
          }
        }
        ?>
      </p>
    </div>
  </div>
  <?php include('footer.php')?>

</body>
</html>


<?php } ?>
