<?php
session_start();
if(!isset($_SESSION['pseudo'])){

}else{
  $pseudo = $_SESSION['pseudo'];
  include('connexionBDD.php');


  ?>
  <!DOCTYPE html>
  <html>
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles2.css">
    <link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


    <title>Membres</title>
  </head>
  <body>
    <?php include('header.php')?>
    <div class="container" style="text-align: justify;margin-top:2%;">
      <section class="sectionTitres">
        <h1  style="text-align:center;border:5px solid #b1d1d0;padding:2px;background:white;border-radius:5px;">Liste des membres :</h1>
      </section>
      <section  class="block1" style="text-align:center;border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;margin-top:2%;margin-bottom:2%;">

      <p>Selectionnez  un de vos hobbies dans la liste déroulante pour discuter avec des personnes ayant la même passion que vous </p>
      <form action="" method="get">
        <select name="donnees" id="hobby" >
          <option value="bla"></option>

          <?php
          $sql =  ('SELECT hobbies.name as hobbiesname FROM posseder INNER JOIN member ON posseder.member=member.id INNER JOIN hobbies on posseder.hobbies=hobbies.id_hobbies  WHERE posseder.member ='.$_SESSION['id']);

          foreach  ($bdd->query($sql) as $row) {

            ?>  <option><?php echo $row['hobbiesname']; ?></option>

            <?php
          }
          ?>

        </select>

        <input type="submit" onclick=listeMembres.php?donnees=<?php echo($row['hobbiesname'])?> value="Rechercher"/> <br>
      </form>

      <?php

      foreach ($bdd->query($sql) as $row) {
        if ($_GET['donnees']==$row['hobbiesname']){
          if($_GET['donnees']=='Musique'){
            $don=1;
          }
          if($_GET['donnees']=='Voyage'){
            $don=2;
          }
          if($_GET['donnees']=='Nourriture'){
            $don=3;
          }

          if($_GET['donnees']=='Sport'){
            $don=4;
          }
          if($_GET['donnees']=='Histoire'){
            $don=5;
          }
          if($_GET['donnees']=='Langues'){
            $don=6;
          }
          if($_GET['donnees']=='Lecture'){
            $don=7;
          }
          if($_GET['donnees']=='CultureAsiatique'){
            $don=8;
          }
          if($_GET['donnees']=='Technologie'){
            $don=9;
          }
          if($_GET['donnees']=='Cinématographie'){
            $don=10;
          }
          if($_GET['donnees']=='JeuxVidéo'){
            $don=11;
          }
          if($_GET['donnees']=='Art'){
            $don=12;
          }
          if($_GET['donnees']=='Nature'){
            $don=13;
          }
          if($_GET['donnees']=='Bricolage'){
            $don=14;
          }
          if($_GET['donnees']=='Beauté'){
            $don=15;
          }


          $Femme = 'Femme';
          $Homme = 'Homme';
          $query=$bdd->query ("SELECT hobbies FROM posseder WHERE member=". $_SESSION['id']); // Sélectionner tous les hobbies de l'utilisateur qui est actuellement connecté
          $members = $bdd -> query("SELECT premium,name, DAY(birth_date) as day_birthday, MONTH(birth_date) as month_birthday, YEAR(birth_date) as year_birthday, position, gender, DAY(creation_date) as day_creation, MONTH(creation_date) as month_creation, YEAR(creation_date) as year_creation FROM member INNER JOIN posseder ON member.id=posseder.member WHERE hobbies= ".$don." AND member.id <> ". $_SESSION['id']); // Sélectionner tous les membres qui possÃ¨dent le hobby que l'on parcourt

          ?>
          <section>
            <br>
            <table style="width:100% ;margin:auto;border:5px solid #b1d1d0;border-radius:5px;">
              <tr style="text-align:center;border:  2px solid #b1d1d0 ; width: 50%;">
                <th style="border:  2px solid #b1d1d0 ;"> Pseudo</th>

                <th style="border:  2px solid #b1d1d0 ;"> Date Anniversaire </th>
                <th style="border:  2px solid #b1d1d0 ;"> Position </th>
                <th style="border:  2px solid #b1d1d0 ;"> Genre </th>
                <th style="border:  2px solid #b1d1d0 ;"> Date d'arrivée </th>
                <th style="border:  2px solid #b1d1d0 ;"> Ajouter en Amis </th>
              </tr>

              <?php

              while ($member1 = $members -> fetch()){ // Récupérer les informations de chaque membre pour les afficher
                if($member1['month_creation']<10){
                  $month_creation = '0'.$member1['month_creation'];
                } else {
                  $month_creation = $member1['month_creation'];
                }
                if($member1['day_creation']<10){
                  $day_creation =  '0'.$member1['day_creation'];
                } else {
                  $day_creation = $member1['day_creation'];
                }
                if($member1['month_birthday']<10){
                  $month_birthday = '0'.$member1['month_birthday'];
                } else {
                  $month_birthday = $member1['month_birthday'];
                }
                if($member1['day_birthday']<10){
                  $day_birthday =  '0'.$member1['day_birthday'];
                } else {
                  $day_birthday = $member1['day_birthday'];
                }
                ?>

                <div name="hobbies" class="test">
                  <tr>
                    <td style="border:  2px solid #b1d1d0 ;">  <a class="pageProfil" href="pageProfilAutre.php?pseudoMembre=<?php echo $member1['name']?>"><?php  if($member1['premium']==1){ echo $member1['name'];?> <img class='symboles' src="../images/premium1.png"/><?php
                    } else { echo $member1['name'];} ?> </a> </td>
                    <td style="border:  2px solid #b1d1d0 ;">  <?php  echo $day_birthday.'/'.$month_birthday.'/'.$member1['year_birthday']; ?> </td>
                    <td style="border:  2px solid #b1d1d0 ;">  <?php echo $member1['position']; ?> </td>
                    <td style="border:  2px solid #b1d1d0 ;">  <?php  if($member1['gender']==0){echo $Femme;}
                    else{echo $Homme;} ?> </td>
                    <td style="border:  2px solid #b1d1d0 ;">  <?php  echo $day_creation.'/'.$month_creation.'/'.$member1['year_creation']; ?> </td>

			<td style="border:  2px solid #b1d1d0 ; width: 10%;">
        <?php
        $pseudoMembre2 = $member1['name'];
        $amis = $bdd ->query("SELECT * FROM amis WHERE (pseudo_membre1='{$_SESSION['pseudo']}' AND pseudo_membre2='$pseudoMembre2') OR (pseudo_membre1='$pseudoMembre2' AND pseudo_membre2='{$_SESSION['pseudo']}')");
        $reqAmis = $amis->rowCount();
          if($reqAmis>0){
            ?>
            <button class="btn btn-info">Vous êtes déjà amis !</button>
            <?php
          }else{
            $selectId = $bdd->query("SELECT * FROM member where name='$pseudoMembre2'");
            $id_membre = $selectId->fetch();
            $id_membre3 = $id_membre['id'];
            ?>
            <a href="demandeAmis.php?id_membre=<?php echo $id_membre3 ?>"><button type="button" class="btn btn-info">Demander en ami</button> </a>
            <?php
          }
         ?>
       </td>
          </div>
              <?php
                  }
                  ?>
                </tr>
              </table>
            </section>
        <?php }
      }
      ?>
    </section>
        </div>

          <?php include('footer.php'); ?>
      
      </body>
      </html>
      <?php
    }
    ?>
